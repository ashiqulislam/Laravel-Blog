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
    return view('pages/index');
});
Route::get('about', function () {
    return view('pages/about');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('category','CategoryController')->only(['create', 'store', 'destroy']);
    Route::resource('posts','PostController')->except(['index', 'show']);
});


Route::resource('category','CategoryController')->only(['index', 'show', 'destroy']);
Route::resource('posts','PostController')->only(['index', 'show']);
Route::resource('comments', 'CommentController')->only(['store']);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
