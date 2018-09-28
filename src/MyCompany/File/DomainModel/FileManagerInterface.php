<?php

namespace MyCompany\File\DomainModel;

interface FileManagerInterface
{
    /**
     * @param string $tempFilePath
     * @param string $storageFilePath
     * @return FileUploaded
     */
    public function upload(string $tempFilePath, string $storageFilePath) : FileUploaded;

    /**
     * @param string $filePath
     * @param string $filename
     * @return string
     */
    public function resize(string $filePath, string $filename) : string;

    /**
     * @param string $objectPath
     * @param string $downloadPath
     * @return mixed
     */
    public function download(string $objectPath, string $downloadPath);

    /**
     * @param string $objectPath
     * @return mixed
     */
    public function delete(string $objectPath);

    /**
     * @param string $filePath
     * @return bool
     */
    public function doesFileExist(string $filePath) : bool;
}