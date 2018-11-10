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

//store routes
Route::get('/addstore' , 'Store@addStore');