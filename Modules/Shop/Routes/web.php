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

Route::prefix('admin/shop')->middleware('auth')->group(function() {
    Route::get('/', 'ShopController@index')->name('shop.index');
    Route::get('/setting', 'ShopController@setting')->name('shop.setting');
    Route::get('/getcity', 'ShopController@getcity')->name('shop.getcity');
    Route::get('/getcost', 'ShopController@getcost')->name('shop.getcost');
    Route::post('/getmidtranstoken', 'ShopController@getmidtranstoken')->name('shop.getmidtranstoken');
    Route::post('/update', 'ShopController@update')->name('shop.update');
});

Route::prefix('admin/payment')->middleware('auth')->group(function() {
    Route::get('/', 'PaymentController@index')->name('payment.index');
    Route::get('/setting', 'PaymentController@setting')->name('payment.setting');
    Route::post('/update', 'PaymentController@update')->name('payment.update');
    Route::post('/createbanklist', 'PaymentController@createbanklist')->name('payment.createbanklist');
    Route::get('/updatestatusmanual', 'PaymentController@updatestatusmanual')->name('payment.updatestatusmanual');
    Route::get('/updatestatusgateway', 'PaymentController@updatestatusgateway')->name('payment.updatestatusgateway');
    Route::get('/deletebank', 'PaymentController@deletebank')->name('payment.deletebank');
});

Route::prefix('admin/shipping')->middleware('auth')->group(function() {
    Route::get('/', 'ShippingController@index')->name('shipping.index');
    Route::get('/setting', 'ShippingController@setting')->name('shipping.setting');
    Route::get('/update', 'ShippingController@update')->name('shipping.update');
});