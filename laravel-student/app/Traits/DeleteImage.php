<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeleteImage
{
    function DeleteProfileImage(string $imagePath)
    {
        if (Storage::exists('/users/'.basename($imagePath))) {
            Storage::delete('/users/'.basename($imagePath));
        }
    }
}
