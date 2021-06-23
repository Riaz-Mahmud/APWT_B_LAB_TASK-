<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('LoginSignUp.Registration')->with('title', 'Sign up');
});

Route::post('/signup','SignupController@signup');

Route::get('/login', function () {
    return view('LoginSignUp.Login')->with('title', 'Sign In');
});

Route::post('/login','SigninController@signup');

Route::group(['middleware'=>['sess']] , function(){

    Route::get('/customer/home', function () {
        return view('Customer.Home')->with('title', 'Sign In');
    });

    //Seler Route
    Route::get('/system/sales','SaleController@index');
    Route::get('/system/sales/physical_store','SaleController@PhysicalStore');
    Route::get('/system/sales/physical_store/sell_product','SaleController@SellProduct');
    Route::post('/system/sales/physical_store/sell_product','SaleController@createSellProduct');
    Route::get('/system/sales/physical_store/sales_log','SaleController@sellLog');
    Route::get('/system/sales/physical_store/checkProductDetails','SaleController@productDetails');

    //product manage
    Route::get('/system/product_management','ProductController@index');
    Route::get('/system/product_management/existing_products','ProductController@ExistingProduct');
    Route::get('system/product_management/product/{product_id}', 'ProductController@ProductDetails');
    Route::get('/system/product_management/existing_products/delete/{product_id}', 'ProductController@ProductDelete');
    Route::get('/system/product_management/existing_products/edit/{product_id}', 'ProductController@ProductDetails');

});

Route::get('/logout','SigninController@logout');


