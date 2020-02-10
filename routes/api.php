<?php

use Illuminate\Http\Request;

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