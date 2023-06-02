<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function storePublicImage($image, $path = 'img/family_member')
    {
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $path . "/" . $filename;
        $storagePath = public_path($path);
        Image::make($image)->fit(500, 500)->save($storagePath);

        return $path;
    }

    public function removeImage($imageFullPath)
    {
        Storage::delete($imageFullPath);
    }
}