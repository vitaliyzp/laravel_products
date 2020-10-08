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


Route::get('/', 'RestfulApiController@getProduct');
Route::post('/create', 'RestfulApiController@createProduct');
Route::post('/update/{id}', 'RestfulApiController@editProduct');
Route::post('/delete/{id}', 'RestfulApiController@deleteProduct');
Route::post('/create-category', 'RestfulApiController@createCategory');
Route::post('/delete-category/{id}', 'RestfulApiController@deleteCategory');
