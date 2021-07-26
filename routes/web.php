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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // category
    Route::prefix('category')->group(function () {
        Route::get('/index', 'CategoryController@index')->name('admin.category.index');
        Route::post('/store', 'CategoryController@store')->name('admin.category.store');
        Route::post('/edit', 'CategoryController@edit')->name('admin.category.edit');
        Route::post('/update', 'CategoryController@update')->name('admin.category.update');
        Route::post('/destroy', 'CategoryController@destroy')->name('admin.category.destroy');
    });

    // point of interest
    Route::prefix('poi')->group(function () {
        Route::get('/index', 'PointOfInterestController@index')->name('admin.poi.index');
        Route::post('/store', 'PointOfInterestController@store')->name('admin.poi.store');
        Route::post('/edit', 'PointOfInterestController@edit')->name('admin.poi.edit');
        Route::post('/update', 'PointOfInterestController@update')->name('admin.poi.update');
        Route::post('/destroy', 'PointOfInterestController@destroy')->name('admin.poi.destroy');
    });
});
