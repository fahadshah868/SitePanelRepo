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

Route::group(['middleware' => ['clearcache']], function () {
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
    Route::get('/updateprofile','ProfileController@getUpdateProfile');
    Route::post('/updateprofile','ProfileController@postUpdateProfile');

    //network
    Route::get('/addnetwork','NetworkController@getAddNetwork');
    Route::post('/addnetwork','NetworkController@postAddNetwork');
    Route::get('/allnetworks','NetworkController@getAllNetworks');
    Route::get('/updatenetwork/{id}','NetworkController@getUpdateNetwork');
    Route::post('/updatenetwork','NetworkController@postUpdateNetwork');
    Route::get('/deletenetwork/{id}','NetworkController@deleteNetwork');

    //store routes
    Route::get('/addstore','StoreController@getAddStore');
    Route::post('/addstore','StoreController@postAddStore');
    Route::get('/allstores','StoreController@getAllStores');
    Route::get('/updatestore/{id}','StoreController@getUpdateStore');
    Route::get('/updatestoreform/{id}','StoreController@getUpdateStoreForm');
    Route::post('/updatestoreform','StoreController@postUpdateStoreForm');
    Route::post('/updatestoreimage','StoreController@postUpdateStoreImage');
    Route::get('/deletestore/{id}','StoreController@deleteStore');

    //store categories
    Route::get('/allstorecategories','StoreCategoryGroupController@getAllStoreCategories');
    Route::get('/updatestorecategories/{id}','StoreCategoryGroupController@getUpdateStoreCategories');
    Route::post('/updatestorecategories','StoreCategoryGroupController@postUpdateStoreCategories');
                                    
    //category routes
    Route::get('/addcategory','CategoryController@getaddCategory');
    Route::post('/addcategory','CategoryController@postAddCategory');
    Route::get('/allcategories','CategoryController@getAllCategories');
    Route::get('/updatecategory/{id}','CategoryController@getUpdateCategory');
    Route::get('/updatecategoryform/{id}','CategoryController@getUpdateCategoryForm');
    Route::post('/updatecategoryform','CategoryController@postUpdateCategoryForm');
    Route::post('/updatecategoryimage','CategoryController@postUpdateCategoryImage');
    Route::get('/deletecategory/{id}','CategoryController@deleteCategory');

    //offertype routes
    Route::get('/addoffertype','OfferTypeController@getAddOfferType');
    Route::post('/addoffertype','OfferTypeController@postAddOfferType');
    Route::get('/alloffertypes','OfferTypeController@getAllOfferTypes');
    Route::get('/updateoffertype/{id}','OfferTypeController@getUpdateOfferType');
    Route::post('/updateoffertype','OfferTypeController@postUpdateOfferType');
    Route::get('/deleteoffertype/{id}','OfferTypeController@deleteOfferType');

    //offer routes
    Route::get('/addoffer','OfferController@getAddOffer');
    Route::post('/addoffer','OfferController@postAddOffer');
    Route::get('/alloffers','OfferController@getAllOffers');
    Route::get('/updateoffer/{id}','OfferController@getUpdateOffer');
    Route::post('/updateoffer','OfferController@postUpdateOffer');
    Route::get('/deleteoffer/{id}','OfferController@deleteOffer');

    //product routes
    Route::get('/addproduct','ProductController@addProduct');
    Route::get('/allproducts','ProductController@getAllProducts');

    //logout
    Route::get('/logout','LogoutController@logout');
});