<?php


namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Scalar\String_;

trait StoreImage
{
    function StoreProfileImage($file): string
    {
        $imagePath = 'users/' . Str::random() . '.jpg';
        $image = Image::make($file)
            ->resize(400, 400)
            ->encode('jpg', 80);
        Storage::put($imagePath, $image);
        return asset('storage/' . $imagePath);
    }
}
