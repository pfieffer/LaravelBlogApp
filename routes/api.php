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

//list posts
Route::get('posts', 'Api\PostsController@index');

//specific post
Route::get('posts/{id}', 'Api\PostsController@show');

//create new post
Route::post('post', 'Api\PostsController@store');

//update
Route::put('post/{id}', 'Api\PostsController@update');

//delete
Route::delete('post/{id}', 'Api\PostsController@destroy');


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'Api\UserController@details');
});