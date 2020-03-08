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

Route::get('/test','Admin\DashboardController@test')->name('test');
Route::get('/ajax','Admin\DashBoardController@test_view')->name('test_view');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-test-account/',function(){
	DB::table('users')->insert([
		'name'=>'admin',
		'avatar'=>'to_be_uploaded',
		'role'=>'admin',
		'email'=>'admin@admin.com',
		'password'=>Hash::make('1')
	]);
});

Route::group(['prefix'=>'auth'],function(){
	Route::group(['prefix'=>'admin'],function(){
		Route::get('login',function(){
			return view('admin.auth.login');
		});
	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('login',function(){
			return view('user.auth.login');
		})->name('login_view');

		Route::get('register',function(){
			return view('user.auth.register');
		})->name('register_view');
	});
	Route::get('logout','\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});

Route::group(['prefix'=>'user'],function(){
	Route::get('index',function(){
		return view('user.index');
	})->name('index_view');

	Route::get('/store/','User\InterfaceController@showStore')->name('store_view');
	Route::get('/store/{platform_name}-{id}','User\InterfaceController@storeCategories')->name('store_category');
	Route::get('/post','User\InterfaceController@showPost')->name('post_view');
	Route::get('/setting','User\SettingsController@showSettings')->name('setting_view');
	Route::get('/post/{id}','User\InterfaceController@postCategories')->name('post_category');
	Route::get('/the-post/{title}-{id}','User\InterfaceController@thePost')->name('thePost_view');
	Route::get('/the-post/the-comment/{id}','User\AjaxController@theComment')->name('theComment_view');
	Route::post('/the-post/the-comment/post/','User\AjaxController@addComment')->name('addComment_post');
	Route::get('/the-post/the-comment/delete/','User\AjaxController@deleteComment')->name('deleteComment');
	Route::get('/the-product/{id}','User\InterfaceController@theProduct')->name('theProduct_view');
	Route::post('/the-product/review/post','User\InterfaceController@addReview')->name('addReview_post');

	Route::group(['prefix'=>'setting'],function(){
		Route::get('/your-comments-{id}','User\SettingsController@showYourComments')->name('yourComments_view');
		Route::get('/your-comments/delete-{id}','User\SettingsController@deleteComment')->name('setting_deleteComment');
		Route::get('/your-comments/deleteAllComments','User\SettingsController@deleteAllComments')->name('deleteAllComments');
		Route::get('/your-reviews-{id}','User\SettingsController@showYourReviews')->name('yourReviews_view');
		Route::get('/your-reviews/delete-{id}','User\SettingsController@deleteReview')->name('setting_deleteReview');
		Route::get('/your-information/','User\SettingsController@showUserInformation')->name('userInformation_view');
		Route::post('/your-information/update','USer\SettingsController@editProfile')->name('editProfile');
		Route::get('/change-avatar/','User\SettingsController@editAvatar')->name('changeAvatar_view');
		Route::post('/chang-avatar/upload','User\SettingsController@uploadAvatar')->name('changeAvatar');
		Route::get('/set-default/','User\SettingsController@setDefault')->name('setDefault');
	});

	Route::group(['prefix'=>'cart'],function(){
		Route::get('/add-to-cart','User\CartController@addToCart')->name('cart_addToCart');
		Route::get('/','User\CartController@getCart')->name('cart_view');
		Route::get('/delete/','User\CartController@removeFromCart')->name('removeItemFromCart');
		Route::get('/delete-cart/','User\CartController@deleteCart')->name('delete_cart');
	});

	Route::get('/p/','User\PaymentController@pay')->name('pay');
	Route::get('/payment/','User\PaymentController@pay_view')->name('pay_view');
	Route::get('/your-orders/','User\OrdersController@orders_view')->name('yourOrders_view');
	Route::get('/search/','User\InterfaceController@search')->name('search');
});

Route::group(['prefix'=>'admin','middleware'=>'adminsOnly'],function(){
	Route::get('index',function(){
		return view('admin.index');
	});
	//Route::resource('users','Admin\UsersController');
	Route::get('usersList','Admin\UsersController@index')->name('usersList_view');
	Route::get('addUsers','Admin\UsersController@create')->name('addUsers_view');
	Route::post('addUsers/post','Admin\UsersController@store')->name('addUsers');
	Route::get('editUsers/{id}','Admin\UsersController@edit')->name('editUsers_view');
	Route::post('editUsers/post/{id}','Admin\UsersController@update')->name('editUsers');
	Route::get('deleteUsers/{id}','Admin\UsersController@destroy')->name('deleteUsers');

	//Route::resource('products','Admin\ProductsController');
	Route::get('productsList','Admin\ProductsController@index')->name('productsList_view');
	Route::get('addProducts','Admin\ProductsController@create')->name('addProducts_view');
	Route::post('addProducts/post','Admin\ProductsController@store')->name('addProducts');
	Route::get('editProducts/{id}','Admin\ProductsController@edit')->name('editProducts_view');
	Route::post('editProducts/post/{id}','Admin\ProductsController@update')->name('editProducts');
	Route::get('deleteProducts/{id}','Admin\ProductsController@destroy')->name('deleteProducts');
	Route::get('search','Admin\SearchController@index')->name('searchResults_view');
	Route::get('search','Admin\SearchController@search')->name('searchResults');
	Route::get('dashBoard','Admin\DashboardController@statistics')->name('dashBoard_view');

	//Route::resource('posts','Admin\PostsController');
	Route::get('postsList','Admin\PostsController@index')->name('postsList_view');
	Route::get('addPosts','Admin\PostsController@create')->name('addPosts_view');
	Route::post('addPosts/post','Admin\PostsController@store')->name('addPosts');
	Route::get('editPosts/{id}','Admin\PostsController@edit')->name('editPosts_view');
	Route::post('editPosts/post/{id}','Admin\PostsController@update')->name('editPosts');
	Route::get('deletePosts/{id}','Admin\PostsController@destroy')->name('deletePosts');

	//Route::resource('comments','Admin\CommentsController');
	Route::post('addComments/post','Admin\CommentsController@store')->name('addComments');
	Route::get('autoRefresh','Admin\AjaxController@autoRefreshComments')->name('autoRefresh');
	Route::get('deleteComments','Admin\AjaxController@deleteComments')->name('deleteComments');

	//Route::resource('reviews','Admin\ReviewsController');
	Route::get('reviewsList','Admin\ReviewsController@index')->name('reviewsList_view');
	Route::get('deleteReviews','Admin\ReviewsController@destroy')->name('deleteReviews');

	//Route::resource('categories','Admin\CategoriesController');
	Route::get('categoriesList','Admin\CategoriesController@showAllCategories')->name('showAllCategories_view');
	Route::get('addPostCategories','Admin\CategoriesController@create_postCategories')->name('addPostCategories_view');
	Route::post('addPostCategories/post','Admin\CategoriesController@store_postCategories')->name('addPostCategories');
	Route::get('deletePostCategories','Admin\CategoriesController@delete_postCategories')->name('deletePostCategories');
	Route::get('editPostCategories','Admin\CategoriesController@edit_postCategories')->name('editPostCategories_view');
	Route::post('editPostCategories/post','Admin\CategoriesController@update_postCategories')->name('editPostCategories');
	Route::get('addProductCategories','Admin\CategoriesController@create_productCategories')->name('addProductCategories_view');
	Route::post('addProductCategories/post','Admin\CategoriesController@store_productCategories')->name('addProductCategories');
	Route::get('deleteProductCategories','Admin\CategoriesController@delete_productCategories')->name('deleteProductCategories');
	Route::get('editProductCategories','Admin\CategoriesController@edit_productCategories')->name('editProductCategories_view');
	Route::post('editProductCategories/post','Admin\CategoriesController@update_productCategories')->name('editProductCategories');

	Route::resource('orders','Admin\OrdersController');

	Route::get('destroy_test','Admin\OrdersController@destroy');


});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
