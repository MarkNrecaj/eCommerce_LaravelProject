<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostalClientsController;
use App\Http\Controllers\PostalSettingsController;
use App\Http\Controllers\PostalWorkerController;
use App\Http\Controllers\SellerController;
use App\Http\Middleware\PostalWorker;
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

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/workers', 'AdminController@showAllWorkers')->name('workers');
    Route::get('/clients', 'AdminController@showAllClients')->name('clients');
    Route::get('/orders', 'AdminController@list_orders')->name('admin.orders');
    Route::delete('/clients/{client}', 'PostalClientsController@destroy')->name('postalclient.destroy');
    Route::resource('/postalworker', 'PostalWorkerController');
    Route::get('/postalsettings', 'PostalSettingsController@index')->name('postalsettings');
    Route::patch('/postalsettings/{settings}', 'PostalSettingsController@update');
    Route::get('/addworker', 'PostalWorkerController@create')->name('addworker');
    Route::post('/addworker', 'PostalWorkerController@store')->name('post.addworker');;
    Route::get('/ordersof/{sellerId}', 'PostalClientsController@allOrders')->name('ordersof');
});

Route::group(['middleware' => ['seller']], function () {
    Route::get('/seller', 'SellerController@index')->name('seller');
    Route::get('/orders', 'OrderController@index')->name('list_orders');
    Route::get('/order', 'OrderController@create')->name('order');
    Route::post('/order', 'OrderController@store');
});
Route::get('/postalworker', 'PostalWorkerController@index')->name('postalworker')->middleware('postal_worker');
