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
Route::get('/', 'Login@login');
Route::post('/authenticate','Login@authenticate');

//user routes
Route::get('/adduser','User@addUser');

//store routes
Route::get('/addstore','Store@addStore');

//category routes
Route::get('/addcategory','Category@addCategory');

//coupon routes
Route::get('/addcoupon','Coupon@addCoupon');

//product routes
Route::get('/addproduct','Product@addProduct');