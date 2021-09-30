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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users/{user}/albums', '\App\Http\Controllers\API\UserAlbumsController@index');
Route::get('albums/{album}/photos', '\App\Http\Controllers\API\AlbumPhotoController@index');
Route::resource('users', '\App\Http\Controllers\API\UsersController');
Route::resource('albums', '\App\Http\Controllers\API\AlbumsController');
Route::resource('photos', '\App\Http\Controllers\API\PhotosController');

Route::post('test', function() {
    return request()->all();
});

// Route::get('users', '\App\Http\Controllers\API\UsersController@index');
// Route::post('users', '\App\Http\Controllers\API\UsersController@store');
