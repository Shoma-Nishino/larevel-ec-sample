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

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'StocksController@index');
Route::get('/stocks/create', 'StocksController@create');
Route::post('/stocks', 'StocksController@store');

Route::get('/carts/index', 'CartsController@index'); 
Route::post('/carts', 'CartsController@store'); 
Route::post('/carts/buy', 'CartsController@buy'); 

Route::get('/buy/index', 'BuyHistoriesController@index'); 
 
