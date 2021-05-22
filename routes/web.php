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

Route::get('/email', function () {
    return view('email');
})->name('email');

Route::get('/chat', function () {
    return view('chat');
})->name('chat');

Route::get('/datatable', function () {
    return view('datatable');
})->name('datatable');

Route::prefix('admin')->group(function () {
    Route::get('/login', 'LoginController@login')->middleware('guest')->name('admin.login');
    Route::post('/login', 'LoginController@credentials')->middleware('guest')->name('admin.credentials');
    Route::get('/logout', 'LoginController@logout')->middleware('auth')->name('admin.logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth')->name('admin.dashboard');
    
    Route::prefix('category')->group(function () {
        Route::get('/index', 'CategoryController@index')->middleware('auth')->name('admin.category.index');
    });
});
