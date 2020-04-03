<?php

use Illuminate\Http\Request;
use\App\Post;
use\App\User;
use\App\Profile;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

    Route::post('login', 'Api\v1\UserController@login');
    Route::post('register', 'Api\v1\UserController@register');
Route::group(['prefix'=>'v1'], function(){
    // Routes for Posts
    // Route::get('users', 'Api\v1\UserController@');
    Route::get('post', 'Api\v1\PostController@index');
    Route::get('post/{id}', 'Api\v1\PostController@getPost');
    Route::post('addPost', 'Api\v1\PostController@addPost');
    Route::post('editPost/{id}', 'Api\v1\PostController@editPost');
    Route::post('delete/{id}', 'Api\v1\PostController@delete');
    // Routes for Categories
    Route::get('category', 'Api\v1\CategoryController@index');
    Route::post('addCategory', 'Api\v1\CategoryController@addCategory');
    // Routes for Profiles
    Route::get('profile', 'Api\v1\ProfileController@index');
    Route::post('addProfile','Api\v1\ProfileController@addProfile');
});

    