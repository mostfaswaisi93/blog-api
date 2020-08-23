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
Route::resource('posts', 'PostsController');
// Route::get('posts/{id}', 'PostsController@show');
// Route::get('posts', 'PostsController@index');
Route::post('posts/{id}', 'PostsController@update');
Route::get('posts/delete/{id}', 'PostsController@delete');

Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@index');

Route::middleware('auth:api')->post('logout', 'LoginController@logout');