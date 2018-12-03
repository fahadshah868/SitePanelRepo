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

//login routes
Route::get('/', 'LoginController@getLogin');
Route::post('/','LoginController@postLogin');

//dashboard routes
Route::get('/dashboard',function(){
    return view('pages.dashboard');
});

//user routes
Route::get('/adduser','UserController@getAddUser');
Route::post('/adduser','UserController@postAddUser');
Route::get('/allusers','UserController@getAllUsers');
Route::get('/updateuser/{id}','UserController@getUpdateUser');
Route::post('/updateuser','UserController@postUpdateUser');
Route::get('/deleteuser/{id}','UserController@deleteUser');

//profile
Route::get('/updateprofile','ProfileController@updateProfile');

//store routes
Route::get('/addstore','StoreController@getaddStore');
Route::post('/addstore','StoreController@postaddStore');
Route::get('/allstores','StoreController@getAllStores');
Route::get('/updatestore/{id}','StoreController@getUpdateStore');
Route::post('/updatestore','StoreController@postUpdateStore');
Route::get('/deletestore/{id}','StoreController@deleteStore');

//category routes
Route::get('/addcategory','CategoryController@addCategory');
Route::get('/allcategories','CategoryController@getAllCategories');

//coupon routes
Route::get('/addcoupon','CouponController@addCoupon');
Route::get('/allcoupons','CouponController@getAllCoupons');

//product routes
Route::get('/addproduct','ProductController@addProduct');
Route::get('/allproducts','ProductController@getAllProducts');

//logout
Route::get('/logout','LogoutController@logout');