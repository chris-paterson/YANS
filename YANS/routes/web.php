<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'PostController@index');

Route::get('/home', 'PostController@index');

Route::get('user/{id}/posts', 'UserController@showPosts')->name('user.posts');
Route::get('user/{id}/purchased', 'UserController@purchased')->name('user.purchased');

Route::resource('posts', 'PostController');
Route::get('posts/{id}/purchase', 'PostController@purchase')->name('posts.purchase');
Route::post('posts/{id}/purchase/process', 'PostController@processPurchase')
    ->name('posts.purchase.process');