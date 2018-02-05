<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['namespace' => 'API'], function () {
    Route::post('/auth', 'AuthController@login');
    Route::patch('/auth', 'AuthController@update');
    Route::delete('/auth', 'AuthController@logout');

    Route::get('login/github', 'AuthController@redirectToProvider');
    Route::get('login/github/callback', 'AuthController@handleProviderCallback');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/', function () {
            // Just acting as a ping service.
        });

        Route::get('/user', 'UserController@me')
            ->name('api.user.show');

    });
});