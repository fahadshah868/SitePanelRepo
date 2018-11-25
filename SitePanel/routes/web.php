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
Route::put('/updateuser/{id}','UserController@getUpdateUser');

//profile
Route::get('/updateprofile','ProfileController@updateProfile');

//store routes
Route::get('/addstore','StoreController@addStore');
Route::get('/allstores','StoreController@getAllStores');

//category routes
Route::get('/addcategory','CategoryController@addCategory');
Route::get('/allcategories','CategoryController@getAllCategories');

//coupon routes
Route::get('/addcoupon','CouponController@addCoupon');
Route::get('/allcoupons','CouponController@getAllCoupons');

//product routes
Route::get('/addproduct','ProductController@addProduct');

//logout
Route::get('/logout','LogoutController@logout');