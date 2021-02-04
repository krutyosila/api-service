<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::post('login', ['uses' => 'AuthController@login']);
        Route::post('register', ['uses' => 'AuthController@register']);
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', ['uses' => 'AuthController@logout']);
    });
});
Route::group(['prefix' => 'user', 'middleware' => 'auth:api', 'namespace' => 'User'], function () {
    Route::get('me', ['uses' => 'UserController@me']);
    Route::post('password', ['uses' => 'UserController@updatePassword']);
});
