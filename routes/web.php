<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/seller', 'SellerController@index')->name('seller')->middleware('seller');
Route::get('/order', 'OrderController@index')->name('order')->middleware('seller');
Route::post('/order', 'OrderController@store')->middleware('seller');
Route::get('/postalworker', 'PostalWorkerController@index')->name('postalworker')->middleware('postal_worker');
