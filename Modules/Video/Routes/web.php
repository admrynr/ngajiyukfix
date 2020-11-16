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

Route::prefix('admin/video')->middleware('auth','adminonly')->group(function() {
    Route::get('/', 'VideoController@index')->name('video.index');
    Route::get('data', 'VideoController@data')->name('video.data');
    Route::get('destroy/{id}', 'VideoController@destroy')->name('video.destroy');
    Route::get('info', 'VideoController@info')->name('video.info');
    Route::get('restore/{id}', 'VideoController@restore')->name('video.restore');
    Route::get('create', 'VideoController@create')->name('video.create');
});
