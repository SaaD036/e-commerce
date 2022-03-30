<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\Models\District;
use App\Http\Controllers;

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

Route::get('/products', 'App\Http\Controllers\ProductController@getAllProduct')->name('products');

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
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//user
Route::get('/token/{token_number}', 'App\Http\Controllers\User\UserController@verifyUser')->name('user.verification');
Route::group(['prefix' => 'user'], function(){
    Route::get('/{id}', 'App\Http\Controllers\User\UserController@show');
    Route::post('/{id}', 'App\Http\Controllers\User\UserController@update');
});

// orders
Route::get('/cart', 'App\Http\Controllers\OrderController@addProductToCart')->middleware('auth')->name('show.carts');
Route::post('/cart/{id}', 'App\Http\Controllers\OrderController@addProductToCart')->middleware('auth');
