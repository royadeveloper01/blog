<?php

use Illuminate\Http\Request;
use\App\Post;

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

Route::group(['prefix' => 'v1'], function(){
    Route::post('login', 'Api\v1\PostController@login');
    Route::post('register', 'Api\v1\PostController@register');
    Route::get('post', 'Api\v1\PostController@index');
    Route::post('addPost', 'Api\v1\PostController@addPost');
    Route::post('editPost/{id}', 'Api\v1\PostController@editPost');
    Route::post('delete/{id}', 'Api\v1\PostController@delete');



});