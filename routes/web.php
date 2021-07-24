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

Route::get('/', 'DashboardController@index')->middleware('auth')->name('dashboard');
Route::get('/login', 'LoginController@login')->middleware('guest')->name('login');
Route::post('/login', 'LoginController@credentials')->middleware('guest')->name('credentials');
Route::get('/logout', 'LoginController@logout')->middleware('auth')->name('logout');

Route::prefix('admin')->group(function () {
    
    Route::prefix('category')->group(function () {
        Route::get('/index', 'CategoryController@index')->middleware('auth')->name('admin.category.index');
        Route::post('/store', 'CategoryController@store')->middleware('auth')->name('admin.category.store');
        Route::post('/edit', 'CategoryController@edit')->middleware('auth')->name('admin.category.edit');
        Route::post('/update', 'CategoryController@update')->middleware('auth')->name('admin.category.update');
    });
});
