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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('user/{id}/posts', 'UserController@showPosts')->name('user.posts');
// Route::get('user/{id}/library', 'UserController@library')->name('user.library');

Route::resource('posts', 'PostController');
Route::get('posts/{id}/purchase', 'PostController@purchase')->name('posts.purchase');
Route::post('posts/{id}/purchase/process', 'PostController@processPurchase')
    ->name('posts.purchase.process');