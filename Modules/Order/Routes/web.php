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

Route::prefix('admin/order')->middleware('auth')->group(function() {
    Route::get('/', 'OrderController@index')->name('order.index');
    Route::get('create', 'OrderController@create')->name('order.create');
    Route::post('store', 'OrderController@store')->name('order.store');
    Route::get('data', 'OrderController@data')->name('order.data');
    Route::get('info', 'OrderController@info')->name('order.info');
    Route::get('bulk/{data}', 'OrderController@bulk')->name('order.bulk');
    Route::get('detail/{id}', 'OrderController@detail')->name('order.detail');
    Route::get('albumdelete/{id}', 'OrderController@albumdelete')->name('order.albumdelete');
    Route::get('approve/{id}', 'OrderController@approve')->name('order.approve');
    Route::get('decline/{id}', 'OrderController@decline')->name('order.decline');
    Route::post('update/{id}', 'OrderController@update')->name('order.update');
    Route::get('destroy/{id}', 'OrderController@destroy')->name('order.destroy');
    Route::get('restore/{id}', 'OrderController@restore')->name('order.restore');
    Route::get('forcedelete/{id}', 'OrderController@forcedelete')->name('order.forcedelete');
    Route::get('category', 'OrderController@category')->name('order.category');
});
