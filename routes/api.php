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

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

//list all posts: Does not require any guards
Route::get('posts', 'PostsController@index');


//guarded apis
Route::middleware('auth:api')->group(function(){
    //create new post [C]
    Route::post('post', 'PostsController@store');
    //get posts of this particular user [R]
    Route::get('posts', 'UserController@getPostsOfUser');
    //update post [U]
    Route::put('posts/{id}', 'PostsController@update');
    //delete [D]
    Route::delete('posts/{id}', 'PostsController@destroy');
    //view specific post
    Route::get('posts/{id}', 'PostsController@show');
    //get user details
    Route::post('userdetails', 'UserController@details');
});

Route::get('/user', function (Request $request) {
    return $request->user() ; 
})->middleware('auth:api');
