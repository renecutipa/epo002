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


Route::resource('books','BookController');

Route::get('books/{id}/delete', ['uses' => 'BookController@destroy', 'as' => 'book.delete']);
Route::get('books/{id}/edit', ['uses' => 'BookController@update', 'as' => 'book.edit']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
