<?php

use Illuminate\Http\Request;

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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('testing', 'API\UserController@testing');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('profile', 'API\UserController@profile');
    Route::get('logout', 'API\UserController@logout');
});
