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

Route::group(['middleware' => ['clearcache','checklogin']], function () {
//login routes
Route::get('/', 'LoginController@getLogin')->name('login');
Route::post('/authenticate','LoginController@postLogin');
});


Route::group(['middleware' => ['clearcache','authenticate','checkuserstatus']], function () {
    //dashboard routes
    Route::get('/dashboard',function(){
        return view('pages.dashboard');
    });

    //user routes
    Route::get('/adduser','UserController@getAddUser');
    Route::post('/adduser','UserController@postAddUser');
    Route::get('/allusers','UserController@getAllUsers');
    Route::get('/viewuser/{id}','UserController@getViewUser');
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
    Route::get('/filterednetworks/{dateremark}/{datefrom}/{dateto}','NetworkController@getFilteredNetworks');
    Route::get('/viewnetwork/{id}','NetworkController@getViewNetwork');
    Route::get('/updatenetwork/{id}','NetworkController@getUpdateNetwork');
    Route::post('/updatenetwork','NetworkController@postUpdateNetwork');
    Route::get('/deletenetwork/{id}','NetworkController@deleteNetwork');

    //store routes
    Route::get('/addstore','StoreController@getAddStore');
    Route::post('/addstore','StoreController@postAddStore');
    Route::get('/allstores','StoreController@getAllStores');
    Route::get('/todayallstores','StoreController@getTodayAllStores');
    Route::get('/filteredstores/{dateremark}/{datefrom}/{dateto}','StoreController@getFilteredStores');
    Route::get('/viewstore/{id}','StoreController@getViewStore');
    Route::get('/updatestoreform/{id}','StoreController@getUpdateStoreForm');
    Route::post('/updatestoreform','StoreController@postUpdateStoreForm');
    Route::post('/updatestoreimage','StoreController@postUpdateStoreImage');
    Route::get('/deletestore/{id}','StoreController@deleteStore');

    //store categories
    Route::get('/allstorecategories','StoreCategoryController@getAllStoreCategories');
    Route::get('/updatestorecategories/{id}','StoreCategoryController@getUpdateStoreCategories');
    Route::post('/updatestorecategories','StoreCategoryController@postUpdateStoreCategories');
    Route::get('/getstorecategories/{id}','StoreCategoryController@getStoreCategories');
                                
    //category routes
    Route::get('/addcategory','CategoryController@getaddCategory');
    Route::post('/addcategory','CategoryController@postAddCategory');
    Route::get('/allcategories','CategoryController@getAllCategories');
    Route::get('/todayallcategories','CategoryController@getTodayAllCategories');
    Route::get('/filteredcategories/{dateremark}/{datefrom}/{dateto}','CategoryController@getFilteredCategories');
    Route::get('/viewcategory/{id}','CategoryController@getViewCategory');
    Route::get('/updatecategoryform/{id}','CategoryController@getUpdateCategoryForm');
    Route::post('/updatecategoryform','CategoryController@postUpdateCategoryForm');
    Route::post('/updatecategoryimage','CategoryController@postUpdateCategoryImage');
    Route::get('/deletecategory/{id}','CategoryController@deleteCategory');

    //offer routes
    Route::get('/addoffer','OfferController@getAddOffer');
    Route::post('/addoffer','OfferController@postAddOffer');
    Route::get('/todayalloffers','OfferController@getTodayAllOffers');
    Route::get('/alloffers','OfferController@getAllOffers');
    Route::get('/viewoffer/{id}','OfferController@getViewOffer');
    Route::get('/filteredoffers/{dateremark}/{datefrom}/{dateto}','OfferController@getFilteredOffers');
    Route::get('/updateoffer/{id}','OfferController@getUpdateOffer');
    Route::post('/updateoffer','OfferController@postUpdateOffer');
    Route::get('/deleteoffer/{id}','OfferController@deleteOffer');

    //carousel offer routes
    Route::get('/addcarouseloffer','CarouselOfferController@getAddCarouselOffer');
    Route::post('/addcarouseloffer','CarouselOfferController@postAddCarouselOffer');
    Route::get('/todayallcarouseloffers','CarouselOfferController@getTodayAllCarouselOffers');
    Route::get('/allcarouseloffers','CarouselOfferController@getAllCarouselOffers');
    Route::get('/filteredcarouseloffers/{dateremark}/{datefrom}/{dateto}','CarouselOfferController@getFilteredCarouselOffers');
    Route::get('/viewcarouseloffer/{id}','CarouselOfferController@getViewCarouselOffer');
    Route::get('/updatecarouselofferform/{id}','CarouselOfferController@getUpdateCarouselOfferForm');
    Route::post('/updatecarouselofferform','CarouselOfferController@postUpdateCarouselOfferForm');
    Route::post('/updatecarouselofferimage','CarouselOfferController@postUpdateCarouselOfferImage');
    Route::get('/deletecarouseloffer/{id}','CarouselOfferController@deleteCarouselOffer');

    //blog categories routes
    Route::get('/addblogcategory','BlogCategoryController@getAddBlogCategory');
    Route::post('/addblogcategory','BlogCategoryController@postAddBlogCategory');
    Route::get('/allblogcategories','BlogCategoryController@getAllBlogCategories');
    Route::get('/filteredblogcategories/{dateremark}/{datefrom}/{dateto}','BlogCategoryController@getFilteredBlogCategories');
    Route::get('/viewblogcategory/{id}','BlogCategoryController@getViewBlogCategory');
    Route::get('/updateblogcategory/{id}','BlogCategoryController@getupdateBlogCategory');
    Route::post('/updateblogcategory','BlogCategoryController@postupdateBlogCategory');
    Route::get('/deleteblogcategory/{id}','BlogCategoryController@deleteBlogCategory');

    //blog routes
    Route::get('/addblog','BlogController@getAddBlog');
    Route::post('/addblog','BlogController@postAddBlog');
    Route::get('/allblogs','BlogController@getAllBlogs');
    Route::get('/todayallblogs','BlogController@getTodayAllBlogs');
    Route::get('/filteredblogs/{dateremark}/{datefrom}/{dateto}','BlogController@getFilteredBlogs');
    Route::get('/viewblog/{id}','BlogController@getViewBlog');
    Route::get('/updateblogform/{id}','BlogController@getUpdatedBlogForm');
    Route::post('/updateblogform','BlogController@postUpdatedBlogForm');
    Route::post('/updateblogimage','BlogController@postUpdatedBlogImage');
    Route::get('/deleteblog/{id}','BlogController@deleteBlog');
    Route::post('/uploadblogimage','BlogController@postUploadBlogImage')->name('upload');

    //blog comments route
    Route::get('/allblogcomments','BlogCommentController@getAllBlogComments');
    Route::get('/filteredblogcomments/{dateremark}/{datefrom}/{dateto}','BlogCommentController@getFilteredBlogComments');
    Route::get('/viewblogcomment/{id}','BlogCommentController@getViewBlogComment');
    Route::get('/updateblogcomment/{id}','BlogCommentController@getUpdateBlogComment');
    Route::post('/updateblogcomment','BlogCommentController@postUpdateBlogComment');
    Route::get('/deleteblogcomment/{id}','BlogCommentController@deleteBlogComment');

    //event routes
    Route::get('/addevent','EventController@getAddEvent');
    Route::post('/addevent','EventController@postAddEvent');
    Route::get('/allevents','EventController@getAllEvents');
    Route::get('/filteredevents/{dateremark}/{datefrom}/{dateto}','EventController@getFilteredEvents');
    Route::get('/viewevent/{id}','EventController@getViewEvent');
    Route::get('/updateevent/{id}','EventController@getUpdateEvent');
    Route::post('/updateevent','EventController@postUpdateEvent');
    Route::get('/deleteevent/{id}','EventController@deleteEvent');

    //event offers routes
    Route::get('/event/todayalloffers','EventOfferController@getTodayAllOffers');
    Route::get('/event/alloffers','EventOfferController@getAllOffers');
    Route::get('/event/filteredoffers/{dateremark}/{datefrom}/{dateto}','EventOfferController@getFilteredOffers');
    Route::get('/event/viewoffer/{id}','EventOfferController@getViewOffer');
    Route::get('/event/updateoffer/{id}','EventOfferController@getUpdateOffer');
    Route::post('/event/updateoffer','EventOfferController@postUpdateOffer');
    Route::get('/event/deleteoffer/{id}','EventOfferController@deleteOffer');

    //logout
    Route::get('/logout','LogoutController@logout');
});