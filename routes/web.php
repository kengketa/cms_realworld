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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/categories', 'CategoryController@index');
// Route::get('/categories/new', 'CategoryController@create');
// Route::Post('/store-category', 'CategoryController@store');

// Route::get('/categories/{id}/edit', 'CategoryController@edit');

// Route::Post('/categories/{id}/update', 'CategoryController@update');

// Route::get('/categories/{id}/delete', 'CategoryController@destroy');

Route::resource('categories', 'CategoryController');
Route::resource('posts', 'PostController');