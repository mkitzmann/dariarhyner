<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{

    public function upload(UploadedFile $file, $directory )
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($directory, $fileName);

        return $fileName;
    }

   
}