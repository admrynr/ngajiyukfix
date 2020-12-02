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

//frontend
Route::get('/', 'HomeController@index');

Route::get('/login', 'LoginController@showLoginForm')->name('login');

//blog
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blog/detail', function (){
    return view('blog-detail');
});

//video
Route::get('/video', 'HomeController@video');
Route::get('/video/detail/{id}', 'HomeController@videodetail');

//livestream
Route::get('/livestream', function (){
    return view('livestream');
});

//Route::get('/admin', 'HomeController@login')->name('loginpage');


/*Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/product', 'HomeController@product')->name('product');
Route::get('/sortnew', 'HomeController@sortnew')->name('sortnew');
Route::get('/sortlow', 'HomeController@sortpricelow')->name('sortlow');
Route::get('/sorthigh', 'HomeController@sortpricehigh')->name('sorthigh');
Route::get('/sortpopular', 'HomeController@sortpopular')->name('sortpopular');
Route::get('/category', 'HomeController@category')->name('category');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blogdetail/{id}', 'HomeController@blogdetail')->name('blogdetail');
Route::get('/login', 'HomeController@login')->name('loginpage');
Route::get('/registerpage', 'HomeController@registerpage')->name('registerpage');
Route::get('/forgot', 'HomeController@forgot')->name('forgot');
Route::get('/verified/{id}', 'RegController@verified')->name('verified');
*/
//dashboarduser
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/myauction', 'HomeController@myauction')->name('myauction');
Route::get('/myaccount', 'HomeController@myaccount')->name('myaccount');
Route::get('/addressbook', 'HomeController@addressbook')->name('addressbook');
Route::get('/changepassword', 'HomeController@changepassword')->name('changepassword');
Route::get('/myorder', 'HomeController@myorder')->name('myorder');
Route::get('/orderhistory', 'HomeController@orderhistory')->name('orderhistory');
Route::post('/resetpassword', 'RegController@resetpassword')->name('resetpassword');

Route::get('/mailtemplate', 'HomeController@mailtemplate')->name('mailtemplate');
Route::get('/reset/{id}', 'RegController@reset')->name('reset');
Route::post('/doreset/{id}', 'RegController@doreset')->name('doreset');
Route::get('/category', 'HomeController@category')->name('category');
Route::get('/category_detail/{id}', 'HomeController@categorydetail')->name('category_detail');
Route::get('/product_detail/{id}', 'HomeController@product_detail')->name('product_detail');
Route::get('/subscribe', 'HomeController@subscribe')->name('subscribe');
Route::get('/newsletter', 'HomeController@newsletter')->name('newsletter');
Route::get('/orderdetail/{id}', 'HomeController@orderdetail')->name('orderdetail');
Route::get('/test', function () {
    return view('mails.ordersuccess');
});

//auction
Route::get('/auction', 'AuctionController@auction')->name('auction');
Route::post('/auction/getmidtranstoken', 'AuctionController@getmidtranstoken')->name('auction.getmidtranstoken');
Route::post('/auctioncheckout', 'AuctionController@auctioncheckout')->name('auctioncheckout');
Route::post('/auctionorder', 'AuctionController@auctionorder')->name('auctionorder');
Route::get('/auction/{id}', 'AuctionController@auctiondetail')->name('auctiondetail');
Route::get('/auctionbidend', 'AuctionController@bidend')->name('bidend');
Route::get('/dobid', 'AuctionController@dobid')->name('dobid');
Route::get('/gethighbid', 'AuctionController@gethighbid')->name('gethighbid');


//authentication panel
Route::get('/admin', '\Modules\User\Http\Controllers\UserController@index')->name('home')->middleware('auth');
Route::get('admin/login', 'LoginController@showLoginForm')->name('login');
Route::post('admin/login/authenticate', 'LoginController@authenticateadmin')->name('admin.authenticate');
Route::post('/admin/logout', 'LoginController@logout')->name('adminlogout');

//authentication front
Route::post('login/authenticate', 'LoginController@authenticate')->name('authenticate');
Route::get('register/regsuccess', 'RegController@regsuccess')->name('regsuccess');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/register', 'RegController@index')->name('register');
Route::post('/register/store', 'RegController@store')->name('regstore');
Route::get('/authuser', 'AuthenticateUserController@index')->name('authuser');
Route::get('/verify/{id}', 'AuthenticateUserController@verify')->name('verify');

//cart
Route::prefix('cart')->namespace('Cart')->group(function() {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::get('/create', 'CartController@create')->name('cart.create');
    Route::get('/delete', 'CartController@delete')->name('cart.delete');
    Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');
    Route::post('/order', 'CartController@order')->name('cart.order');
    Route::get('/viewcart', 'CartController@viewcart')->name('cart.viewcart');
    Route::get('/updateqty', 'CartController@updateqty')->name('cart.updateqty');
    Route::get('/addqty', 'CartController@addqty')->name('cart.addqty');
    Route::get('/gettotalprice', 'CartController@gettotalprice')->name('cart.gettotalprice');
});
