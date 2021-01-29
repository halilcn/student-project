<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordSettingRequest;
use App\Http\Requests\ProfileSettingRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return new UserResource($request->user());
    }

    public function updateProfile(ProfileSettingRequest $request)
    {
        $imagePath = $request->user()->image;
        if ($request->hasFile('image')) {
            $imagePath = 'users/' . rand() . '.jpg';
            $image = Image::make($request->file('image'))
                ->resize(400, 400)
                ->encode('jpg', 80);
            Storage::disk('public')->put($imagePath, $image);
            $imagePath = asset($imagePath);
        }

        $request->user()->update([
            'image' => $imagePath,
            'name' => $request->input('name', $request->user()->name)
        ]);

        return response([
            'image' => $imagePath,
            'name' => $request->user()->name
        ], 200);
    }

    public function updatePassword(PasswordSettingRequest $request)
    {
        if (!(Hash::check($request->password, $request->user()->password))) {
            return response(['message' => 'Mevcut Şifre Yanlış!'], 401);
        }

        $request->user()->update(['password' => bcrypt($request->newPassword)]);
    }
}
