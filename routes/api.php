<?php

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

// Controllers Within The "App\Http\Controllers\API" Namespace
Route::namespace ('API')->group(function () {

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::get('testing', 'UserController@testing');
    Route::get('get-token', 'UserController@getToken');
    Route::get('logout', 'UserController@logout');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', 'UserController@profile');

        Route::group(['middleware' => ['auth:api', 'scopes:admin']], function () {

            Route::resource('roles', 'Admin\RoleController');
            // Route::post('roles', 'Admin\RoleController@store');
            Route::get('test-admin', 'UserController@admin');
            Route::get('get-tree', 'General\Table1Controller@getTree');
        });

    });
});
