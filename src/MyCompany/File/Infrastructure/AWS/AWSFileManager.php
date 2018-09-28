<?php

namespace MyCompany\File\Infrastructure\Adapter\GCP;

use Eventviva\ImageResize;
use MyCompany\File\DomainModel\ErrorUploadingFileException;
use MyCompany\File\DomainModel\FileManagerInterface;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Storage\Bucket;
use MyCompany\File\DomainModel\FileUploaded;

class AWSFileManager implements FileManagerInterface
{
    /** @var StorageClient */
    private $storage;
    /** @var Bucket */
    private $bucket;
    /** @var string */
    private $storageUrl;
    /** @var string */
    private $tempImagesPath;

    public function __construct(string $projectId, string $rootDir, string $keyFile, string $bucketName)
    {
        $this->storage = new StorageClient([
            'projectId' => $projectId,
            'keyFilePath' => $rootDir.$keyFile
            //'keyFile' =>   json_decode(file_get_contents($rootDir.$keyFile, true))
        ]);;
        $this->bucket = $this->storage->bucket($bucketName);
        $this->storageUrl = 'https://'.$bucketName.'.storage.googleapis.com';
        $this->tempImagesPath = $rootDir.'/../var/tmpimages';
    }

    /**
     * @param string $tempFilePath
     * @param string $storageFilePath
     * @return FileUploaded
     * @throws ErrorUploadingFileException
     */
    public function upload(string $tempFilePath, string $storageFilePath) : FileUploaded
    {
        try {
            $this->bucket->upload(
                file_get_contents($tempFilePath),
                [
                    "name" => $storageFilePath
                ]
            );

            $obj =  $this->bucket->object($storageFilePath);
            $obj->acl()->add('allUsers', 'READER');

        } catch (\Exception $exception) {
            throw new ErrorUploadingFileException($exception->getMessage());
        }
        return new FileUploaded($this->storageUrl.'/'.$storageFilePath, $storageFilePath);
    }

    /**
     * @param string $filePath
     * @param string $filename
     * @param int $width
     * @return string
     */
    public function resize(string $filePath, string $filename, $width = 250) : string
    {
        $tempThumbnailPath = $this->tempImagesPath.'/temp_'.$filename;
        $image = new ImageResize($filePath);
        $image->resizeToWidth($width);
        $image->save($tempThumbnailPath);
        return $tempThumbnailPath;
    }

    /**
     * @param string $objectPath
     * @param string $downloadPath
     * @return void
     */
    public function download(string $objectPath, string $downloadPath)
    {
        try {
            $object = $this->bucket->object($objectPath);
            $object->downloadToFile($downloadPath);
        } catch (\Exception $exception) {

        }
    }

    /**
     * @param string $objectPath
     * @return void
     */
    public function delete(string $objectPath)
    {
        try {
            $this->bucket->object($objectPath)->delete();
        } catch (\Exception $exception) {

        }
    }

    /**
     * @param string|null $filePath
     * @return bool
     */
    public function doesFileExist(string $filePath = null) : bool
    {
        return (is_null($filePath)) ? false : $this->bucket->object($filePath)->exists();
    }
}