<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


//AdminRoutes
Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin-home');
    Route::get('/create/product', 'App\Http\Controllers\AdminController@createProduct')->name('create-product');
    Route::post('create/product', 'App\Http\Controllers\AdminController@storeProduct')->name('store-product');
    Route::get('/edit/product', 'App\Http\Controllers\AdminController@editProduct')->name('edit-product');
    Route::get('/edit/product/{id}', 'App\Http\Controllers\AdminController@editOneProduct');
    Route::post('/edit/product/{id}', 'App\Http\Controllers\AdminController@updateOneProduct');

    // category routes
    Route::get('/category', 'App\Http\Controllers\CategoryController@index')->name('category');
    Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@edit');
    Route::post('/category/{id}', 'App\Http\Controllers\CategoryController@update');
    Route::get('/category/delete/{id}', 'App\Http\Controllers\CategoryController@delete');
    Route::get('/category-create', 'App\Http\Controllers\CategoryController@create_category')->name('category-create');
    Route::post('/category-create', 'App\Http\Controllers\CategoryController@store');

    Route::get('/order', 'App\Http\Controllers\AdminController@showOrder')->name('order');
    Route::get('/confirm-payment/{id}', 'App\Http\Controllers\AdminController@confirmPayment');
    Route::get('/delete-payment/{id}', 'App\Http\Controllers\AdminController@deletePayment');
    Route::get('/make-shipment/{id}', 'App\Http\Controllers\AdminController@makeShipment');
});



//Auth routes
Auth::routes();
Route::post('/signup', [App\Http\Controllers\HomeController::class, 'signup'])->name('signup');
Route::get('/token/{token_number}', 'App\Http\Controllers\User\UserController@verifyUser')->name('user.verification');



//home routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', 'App\Http\Controllers\ProductController@getAllProduct')->name('products');

Route::get('/cart', 'App\Http\Controllers\OrderController@showCart')->middleware('auth')->name('show.carts');
Route::get('/cart/{product_id}', 'App\Http\Controllers\OrderController@addProductToCart')->middleware('auth');
Route::get('/confirm-order', 'App\Http\Controllers\OrderController@confirmAllOrder')->middleware('auth')->name('confirm-order');
Route::get('/cart/add-one/{id}', 'App\Http\Controllers\OrderController@addOneToCart')->middleware('auth')->name('cart-add-one');
Route::get('/cart/remove-one/{id}', 'App\Http\Controllers\OrderController@removeOneFromCart')->middleware('auth')->name('cart-remove-one');

Route::get('/order', 'App\Http\Controllers\OrderController@showOrder')->middleware('auth')->name('show-order');
Route::get('/order/delete/{id}', 'App\Http\Controllers\OrderController@deleteOrder')->middleware('auth');
Route::get('/order/{id}', 'App\Http\Controllers\OrderController@showSingleOrder')->middleware('auth');

Route::post('/payment/{id}', 'App\Http\Controllers\OrderController@makePayment')->middleware('auth');



//user
Route::group(['prefix' => 'user'], function(){
    Route::get('/{id}', 'App\Http\Controllers\User\UserController@show');
    Route::post('/{id}', 'App\Http\Controllers\User\UserController@update');
});
