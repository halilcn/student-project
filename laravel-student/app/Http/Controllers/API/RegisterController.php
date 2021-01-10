<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource as UserResource;

class RegisterController extends Controller
{
    function store(RegisterRequest $request)
    {
        $avatarApiImage = 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&size=128&name=' . Str::of($request->name)->replace(' ', '+');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $avatarApiImage
        ]);
        return new UserResource($user);
    }
}
