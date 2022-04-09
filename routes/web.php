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

//Route::get('/', function () {
//});

Route::get('/', 'Customer\PaymentController@payment');
Route::get('/vnpay_callback', 'Customer\PaymentController@paymentCallBack');

Route::get('category','Admin\CategoryController@index');


Route::get('categories/index', 'Customer\CategoryController@search')->name('category.search');
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
], function () {
    Route::resource('/category', 'CategoryController');
});
