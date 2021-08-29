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

Route::get('/', 'GuestController@index')->name('guest.index');
Route::post('/get-location', 'GuestController@getLocation')->name('guest.getLocation');
Route::get('/login', 'LoginController@login')->middleware('guest')->name('login');
Route::post('/login', 'LoginController@credentials')->middleware('guest')->name('credentials');
Route::get('/logout', 'LoginController@logout')->middleware('auth')->name('logout');
Route::get('/register', 'LoginController@register')->middleware('guest')->name('register');
Route::post('/register', 'LoginController@registerStore')->middleware('guest')->name('register.store');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    // dashboard
    Route::get('/dashboard', 'DashboardController@index')->middleware('auth')->name('admin.dashboard');
    Route::post('/get-location', 'DashboardController@getLocation')->name('admin.getLocation');

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

    // role
    Route::prefix('role')->group(function () {
        Route::get('/index', 'RoleController@index')->name('admin.role.index');
        Route::post('/store', 'RoleController@store')->name('admin.role.store');
        Route::post('/edit', 'RoleController@edit')->name('admin.role.edit');
        Route::post('/update', 'RoleController@update')->name('admin.role.update');
        Route::post('/destroy', 'RoleController@destroy')->name('admin.role.destroy');
    });

    // user admin
    Route::prefix('user')->group(function () {
        Route::get('/index', 'UserController@index')->name('admin.user.index');
        Route::post('/store', 'UserController@store')->name('admin.user.store');
        Route::post('/edit', 'UserController@edit')->name('admin.user.edit');
        Route::post('/update', 'UserController@update')->name('admin.user.update');
        Route::post('/destroy', 'UserController@destroy')->name('admin.user.destroy');
    });
});
