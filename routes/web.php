<?php

use Illuminate\Support\Facades\Route;

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




Auth::routes();

Route::get('/home', [\App\Http\Controllers\PagesController::class, 'index'])->name('home');
Route::get('/','App\Http\Controllers\PagesController@index');
Route::get('/products','App\Http\Controllers\PostController@index')->name('products');
Route::get('/products/create','App\Http\Controllers\PostController@create')->name('products.create');
Route::post('/products/store','App\Http\Controllers\PostController@store')->name('products.store');
Route::get('/products/{slug}','App\Http\Controllers\PostController@show')->name('products.show');
Route::put('/products/{slug}','App\Http\Controllers\PostController@update')->name('products.update');
Route::delete('/products/{slug}','App\Http\Controllers\PostController@destroy')->name('products.delete');
Route::get('/products/{slug}/edit','App\Http\Controllers\PostController@edit')->name('products.edit');
//profile
Route::get('/profile','App\Http\Controllers\ProfileController@index');
Route::get('/profile/{id}/edit','App\Http\Controllers\ProfileController@edit')->name('profile.edit');

//contact us
Route::get('/contact-us','App\Http\Controllers\PagesController@contact');



