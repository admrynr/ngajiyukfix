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

Route::prefix('admin/page')->middleware('auth','adminonly')->group(function() {
    Route::get('/', 'PageController@index')->name('page.index');
    Route::get('data', 'PageController@data')->name('page.data');
    Route::post('store', 'PageController@store')->name('page.store');
    Route::get('edit/{id}', 'PageController@edit')->name('page.edit');
    Route::post('update', 'PageController@update')->name('page.update');
    Route::get('destroy/{id}', 'PageController@destroy')->name('page.destroy');
    Route::get('forcedestroy/{id}', 'PageController@forcedestroy')->name('page.forcedestroy');
    Route::get('approve/{id}', 'PageController@approve')->name('page.approve');
    Route::get('decline/{id}', 'PageController@decline')->name('page.decline');
    Route::get('restore/{id}', 'PageController@restore')->name('page.restore');
    Route::get('bulk/{data}', 'PageController@bulk')->name('page.bulk');
    Route::get('info', 'PageController@info')->name('page.info');
});
