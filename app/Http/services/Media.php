<?php

namespace App\Http\services;

use Illuminate\Http\UploadedFile;

class media{
public static function uploadImage(UploadedFile $image,string $dir):string{

    $newImageName=$image->hashName();
    $image->move(public_path($dir),$newImageName);
    return $newImageName;
}
}
