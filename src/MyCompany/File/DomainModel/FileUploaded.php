<?php

namespace MyCompany\File\DomainModel;

class FileUploaded
{
    /** @var string */
    private $fileUrl;
    /** @var string */
    private $filePath;

    public function __construct(string $fileUrl, string $filePath)
    {
        $this->fileUrl = $fileUrl;
        $this->filePath = $filePath;
    }

    /**
     * @return string
     */
    public function fileUrl() : string
    {
        return $this->fileUrl;
    }

    /**
     * @return string
     */
    public function filePath() : string
    {
        return $this->filePath;
    }
}