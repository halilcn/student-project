<?php

use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\TargetResourceController;
use App\Http\Controllers\API\LastTargetResourceController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UsersRatesResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => '/v1'], function () {
    //Public
    Route::post('/register', [AuthApiController::class, 'register']);

    // Auth
    Route::group(['middleware' => 'auth:api'], function () {

        // User
        Route::get('/user', [UserController::class, 'show']);
        Route::put('/user/profile', [UserController::class, 'updateProfile']);
        Route::put('/user/password', [UserController::class, 'updatePassword']);

        Route::get('/users', []);
        Route::get('/users/id', []);

        Route::resource('targets', TargetResourceController::class);
        Route::resource('last-targets', LastTargetResourceController::class);

        Route::resource('users-rates', UsersRatesResourceController::class);

        Route::post('/logout', [AuthApiController::class, 'logout']);

    });
});


