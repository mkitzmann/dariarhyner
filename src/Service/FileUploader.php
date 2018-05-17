<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class FileUploader
{

    public function upload(UploadedFile $file, $directory )
    {
        $fileName = $file->getClientOriginalName();

        $file->move($directory, $fileName);

        return $fileName;
    }

   
}