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

Auth::routes();

Route::get('/', 'GuestController@index');
Route::get('/events', 'GuestController@events');
Route::get('/collection', 'GuestController@collection');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard','DashboardController@index');
    Route::resource('/gem', 'GemController');
    Route::post('/gem/reactivate', 'GemController@reactivate');
    Route::post('/gem/switch', 'GemController@switch');
    Route::resource('/jewelry', 'JewelryController');
    Route::post('/jewelry/reactivate', 'JewelryController@reactivate');
    Route::post('/jewelry/switch', 'JewelryController@switch');
    Route::resource('/product', 'ProductController');
    Route::resource('/event', 'EventController');
});

Route::get('/success',function(){
    return Session::get('success');
});

Route::get('/error',function(){
    return Session::get('error');
});

