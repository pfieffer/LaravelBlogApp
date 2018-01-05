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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//list posts
Route::get('posts', 'PostsApiController@index');

//specific post
Route::get('posts/{id}', 'PostsApiController@show');

//create new post
Route::post('post', 'PostsApiController@store');

//update
Route::put('post', 'PostsApiController@store');

//delete
Route::delete('post/{id}', 'PostsApiController@destroy');
