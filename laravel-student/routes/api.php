<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TargetResourceController;
use App\Http\Controllers\API\UserController;
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
    Route::post('/register', [RegisterController::class, 'store']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/user', [UserController::class, 'show']);
        Route::post('/user/update', [UserController::class, 'update']);

        Route::get('/users', []);
        Route::get('/users/id', []);

        Route::resource('targets', TargetResourceController::class);

    });
});


