<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
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
    Route::get('/all_orders', 'AdminController@list_orders')->name('admin.allOrders');
    Route::get('/new_orders', 'AdminController@list_new_orders')->name('admin.newOrders');
    Route::get('/delivered_orders', 'AdminController@list_delivered_orders')->name('admin.deliveredOrders');
    Route::patch('/new_orders/choosePostalWorker/{id}', 'OrderController@choosePostalWorker')->name('choosePostalWorker');
    Route::get('all_orders/{id}', 'AdminController@showOrder')->name('viewOrder');
    Route::get('delivered_orders/{id}', 'AdminController@showDeliveredOrder')->name('viewDeliveredOrder');
    Route::get('all_orders/editPostalWorker/{id}', 'OrderController@editPostalWorker')->name('editPostalWorker');
    Route::patch('all_orders/editPostalWorker/{id}', 'OrderController@updatePostalWorker')->name('updatePostalWorker');
    Route::get('/settings', 'AdminController@post_settings')->name('admin.settings');
    Route::delete('/clients/{client}', 'PostalClientsController@destroy')->name('postalclient.destroy');
    Route::resource('/postalworker', 'PostalWorkerController');
    Route::get('/postalsettings', 'PostalSettingsController@index')->name('postalsettings');
    Route::patch('/postalsettings/{settings}', 'PostalSettingsController@update');
    Route::patch('/disableacc/{id}', 'AdminController@disableAccount')->name('disableacc');
    Route::get('/addworker', 'PostalWorkerController@create')->name('addworker');
    Route::post('/addworker', 'PostalWorkerController@store')->name('post.addworker');
    Route::get('/ordersof/{sellerId}', 'PostalClientsController@allOrders')->name('ordersof');
});

Route::group(['middleware' => ['seller']], function () {
    Route::get('/seller', 'SellerController@index')->name('seller');
    Route::get('/orders', 'OrderController@index')->name('list_orders');
    Route::get('/order', 'OrderController@create')->name('order');
    Route::post('/order', 'OrderController@store');
});
Route::get('/postalworker', 'PostalWorkerController@index')->name('postalworker')->middleware('postal_worker');
