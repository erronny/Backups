<?php
//ALTER TABLE `tbl_document` ADD `bookMark` INT NOT NULL DEFAULT '0' AFTER `IsActive`;

//ALTER TABLE `tbl_share` ADD `IsDelete` INT NOT NULL DEFAULT '0' AFTER `IsActive`;

// ALTER TABLE `users` ADD `IsActive` INT NOT NULL DEFAULT '1' AFTER `registration_no`;

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


// composer require laravel/ui "^1.0" --dev

// php artisan ui vue --auth

// composer require laravelcollective/html

// zC-!t7b{i3)t
// crackcr1_document
// crackcr1_documen

Route::get('/', 'HomeController@index');
// sitemaps route
Route::get('/sitemap.xml', 'SitemapController@sitemap');
Route::get('/sitemap.html', 'SitemapController@sitemaps');


Auth::routes();

Route::get('/home', 'HomeController@dashboard')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/signup', 'HomeController@signUp')->name('signup');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/policy', 'HomeController@policy')->name('policy');
Route::get('/faq', 'HomeController@faq')->name('faq');
// Route::get('/signup', 'HomeController@signup')->name('signup');
Route::get('/pricing', 'HomeController@pricing')->name('pricing');
Route::get('/returnpolicy', 'HomeController@returnpolicy')->name('returnpolicy');


Route::get('/test', 'HomeController@metatag')->name('test');

Route::post('/checkEmail', 'HomeController@checkEmail');
Route::post('/verifyOtp', 'HomeController@verifyOtp');
Route::post('/sendOtp', 'HomeController@sendOtp');
Route::post('/userRegister', 'HomeController@userRegister');


Route::group(['middleware' => ['auth','clearance']], function () { 
	Route::group(['prefix' => 'admin'], function () {
	
		Route::get('/qrcode/{id}/{key}', 'QrController@index');

		/*Product routes start*/  
		


		Route::resource('document', 'DocumentController');
		Route::get('updateDocument/{id}/{key}', 'DocumentController@updateDocument');
		Route::get('updateDetail/{id}/', 'DocumentController@updateDetail');
		Route::get('getImages/{id}', 'DocumentController@getImages');
		Route::post('updateImages', 'DocumentController@updateImages');
		
		Route::post('getDocument', 'DocumentController@getProduct');
		Route::post('deleteAllItem', 'DocumentController@deleteAllItem');
		Route::post('shareAllItem', 'DocumentController@shareAllItem');
		Route::get('loadItem', 'DocumentController@loadItem');
		Route::get('shareDocument', 'DocumentController@shareDocument');
		Route::get('recievedDocument', 'DocumentController@recievedDocument');
		//Route::get('getProductById/{id}', 'DocumentController@getProductById');
		

		
		Route::get('cart', 'ProductController@cart');
		Route::post('addToCart', 'ProductController@addToCart');
		Route::get('removeItem/{id}', 'ProductController@removeItem');
		
		Route::post('updateStatus', 'OrderController@updateStatus');
		Route::get('getCurrentorder/{id}', 'OrderController@getCurrentorder');

		Route::get('myOrder', 'OrderController@myOrder');
		Route::post('getMyOrder', 'OrderController@getMyOrder');

		Route::get('place_order', 'OrderController@place_order');
		Route::get('order_place', 'OrderController@order_place');
		Route::post('getOrder', 'OrderController@getOrder');
		Route::post('updateCart', 'ProductController@updateCart');
		Route::get('invoice/{id}', 'OrderController@invoice');
		Route::get('getGraphData', 'ProductController@getGraphData');
	/*Product routes end*/ 

          /*roles*/
    //       Route::resource('roles', 'RoleController');
    // 	  Route::resource('permissions', 'PermissionController');
	/*end*/

	/*Product routes start*/  
		Route::resource('courier', 'CourierController');
		Route::get('updateCourier/{id}/{key}', 'CourierController@updateCourier');
	/*Product routes end*/ 

	/*Product routes start*/  
		Route::resource('category', 'CategoryController');
		Route::get('updateCategory/{id}/{key}', 'CategoryController@updateCategory');
	/*Product routes end*/ 

		Route::get('users/create/{key}', 'UserController@create');
		Route::get('users/{key}', 'UserController@index');
		Route::get('updateUser/{id}/{key}', 'UserController@updateUser');
		Route::get('userWiseReport', 'UserController@userWiseReport');
		Route::resource('users', 'UserController');


});

});