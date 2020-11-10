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

Route::prefix('admin/auction')->middleware('auth','adminonly')->group(function() {
    Route::get('/', 'AuctionController@index')->name('auction.index');
    Route::get('data', 'AuctionController@data')->name('auction.data');
    Route::post('store', 'AuctionController@store')->name('auction.store');
    Route::get('edit/{id}', 'AuctionController@edit')->name('auction.edit');
    Route::get('approve/{id}', 'AuctionController@approve')->name('auction.approve');
    Route::get('decline/{id}', 'AuctionController@decline')->name('auction.decline');
    Route::post('update/{id}', 'AuctionController@update')->name('auction.update');
    Route::get('destroy/{id}', 'AuctionController@destroy')->name('auction.destroy');
    Route::get('info', 'AuctionController@info')->name('auction.info');
    Route::get('bulk/{data}', 'AuctionController@bulk')->name('auction.bulk');
});
