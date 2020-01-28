<?php

//don't touch this routes

Route::GET('/seller/register','Auth\Seller\RegisterController@showregisterForm');
Route::POST('/seller/register','Auth\Seller\RegisterController@register')->name('seller.register');
Route::GET('/seller/login','Auth\Seller\LoginController@showLoginForm')->name('auth.seller.login');
Route::POST('/seller/login','Auth\Seller\LoginController@login')->name('seller.login');
Route::POST('/seller/logout','Auth\Seller\LoginController@logout')->name('seller.logout');
Route::POST('/seller/password/email','Auth\Seller\ForgotPasswordController@sendResetLinkEmail')->name('seller.password.email');
Route::GET('/seller/password/reset','Auth\Seller\ForgotPasswordController@showLinkRequestForm')->name('seller.password.request');
Route::POST('/seller/password/reset','Auth\Seller\ResetPasswordController@reset');
Route::GET('/seller/password/reset/{token}','Auth\Seller\ResetPasswordController@showResetForm')->name('seller.password.reset');

Auth::routes();

//don't touch this routes






Route::get('/', function () {
    return redirect('/home');
});


Route::get('/home', 'HomeController@index')->name('home');


Route::get('/seller','SellerController@index');
Route::resource('/seller/products','ProductController');
Route::get('/seller/product/add', 'ProductController@addNew');
Route::resource('/seller/product/attribute','AttributeController');
Route::resource('/seller/product/variations','ProductVariationController');