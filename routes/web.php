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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/seller','SellerController@index');

Route::GET('/seller/register','Auth\Seller\RegisterController@showregisterForm');
Route::POST('/seller/register','Auth\Seller\RegisterController@register')->name('seller.register');
Route::GET('/seller/login','Auth\Seller\LoginController@showLoginForm')->name('auth.seller.login');
Route::POST('/seller/login','Auth\Seller\LoginController@login')->name('seller.login');
Route::POST('/seller/logout','Auth\Seller\LoginController@logout')->name('seller.logout');
Route::POST('/seller/password/email','Auth\Seller\ForgotPasswordController@sendResetLinkEmail')->name('seller.password.email');
Route::GET('/seller/password/reset','Auth\Seller\ForgotPasswordController@showLinkRequestForm')->name('seller.password.request');
Route::POST('/seller/password/reset','Auth\Seller\ResetPasswordController@reset');
Route::GET('/seller/password/reset/{token}','Auth\Seller\ResetPasswordController@showResetForm')->name('seller.password.reset');
