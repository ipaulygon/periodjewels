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

Route::get('/success',function(){
    return Session::get('success');
});

Route::get('/error',function(){
    return Session::get('error');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard','DashboardController@index');
    Route::resource('/jewelry', 'JewelryController');
    Route::post('/jewelry/reactivate', 'JewelryController@reactivate');
    Route::post('/jewelry/switch', 'JewelryController@switch');
    Route::resource('/product', 'ProductController');
    Route::post('/product/reactivate', 'ProductController@reactivate');
    Route::post('/product/switch', 'ProductController@switch');
});

