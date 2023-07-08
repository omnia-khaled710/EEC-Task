<?php

namespace App\Http\services;

use Illuminate\Http\UploadedFile;

class media{
public static function uploadImage(UploadedFile $image,string $dir):string{

    $newImageName=$image->hashName();
    $image->move(public_path($dir),$newImageName);
    return $newImageName;
}
public static function deleteImage(string $path):bool{
if(!file_exists($path)){
    unlink($path);
    return true;
}else{
    return false;
}

}

}
