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

Route::prefix('admin/blog')->middleware('auth','adminonly')->group(function() {
    Route::get('/', 'BlogController@index')->name('blog.index');
    Route::get('create', 'BlogController@create')->name('blog.create');
    Route::get('data', 'BlogController@data')->name('blog.data');
    Route::post('store', 'BlogController@store')->name('blog.store');
    Route::post('uploadfile', 'BlogController@uploadfile')->name('blog.uploadfile');
    Route::get('edit', 'BlogController@edit')->name('blog.edit');
    Route::post('update', 'BlogController@update')->name('blog.update');
    Route::get('destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    Route::get('forcedestroy/{id}', 'BlogController@forcedestroy')->name('blog.forcedestroy');
    Route::get('approve/{id}', 'BlogController@approve')->name('blog.approve');
    Route::get('decline/{id}', 'BlogController@decline')->name('blog.decline');
    Route::get('restore/{id}', 'BlogController@restore')->name('blog.restore');
    Route::get('bulk/{data}', 'BlogController@bulk')->name('blog.bulk');
    Route::get('info', 'BlogController@info')->name('blog.info');
});
