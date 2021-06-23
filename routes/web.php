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