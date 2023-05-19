<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{

    public function __construct(private $uploadDestination)
    {
    }

    public function uploadFile(UploadedFile $file): string
    {
        $newPictureName = uniqid("IMG-", true) . "." . $file->guessExtension();
        $file->move($this->uploadDestination, $newPictureName);
        return $newPictureName;
    }
}