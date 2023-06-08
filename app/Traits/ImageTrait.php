<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait ImageTrait
{
    public function storePublicImage($image, $path = 'img/family_member')
    {
        if(!File::isDirectory(public_path($path)) ) {
            File::makeDirectory($path, 493, true);
        }
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $path . "/" . $filename;
        $storagePath = public_path($path);
        Image::make($image)->fit(500, 500)->save($storagePath);

        return $path;
    }

    public function storeCCCD($imageFile)
    {
        $fileName = Str::random(10) . time() . "." .$imageFile->getClientOriginalExtension();
        $imageFile->storeAs('cccd', $fileName, 'private');

        return $fileName;
    }

    public function getCCCD($imagePath)
    {
        $path = storage_path('app/private/cccd/' . $imagePath);
        $image = Image::make($path)->response();
        
        return $image;
    }

    public function removeImage($imageFullPath)
    {
        Storage::delete($imageFullPath);
    }
}