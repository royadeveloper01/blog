<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post', 'PostController@Post')->middleware('auth');

Route::get('/category', 'CategoryController@Category')->middleware('auth');

Route::get('/profile', 'ProfileController@Profile')->middleware('auth');

Route::post('/addCategory', 'CategoryController@addCategory')->middleware('auth');

Route::post('/addProfile', 'ProfileController@addProfile')->middleware('auth');

Route::post('/addPost', 'PostController@addPost')->middleware('auth');

Route::get('/view/{id}', 'PostController@view')->middleware('auth');

Route::get('/edit/{id}', 'PostController@edit')->middleware('auth');

Route::post('/editPost/{id}', 'PostController@editPost')->middleware('auth');

Route::get('/delete/{id}', 'PostController@delete')->middleware('auth');

Route::get('/category/{id}', 'PostController@category')->middleware('auth');

Route::get('/like/{id}' , 'PostController@like')->middleware('auth');

Route::get('/dislike/{id}' , 'PostController@dislike')->middleware('auth');

Route::post('/comment/{id}', 'PostController@comment')->middleware('auth');

Route::post('/search', 'PostController@search')->middleware('auth');