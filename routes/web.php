<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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

// Route::get('login','Auth\LoginController@getLogin');
Route::group(['prefix' => '/','middleware' => 'auth'], function () {
   Route::get('/', 'HomeController@index');
   Route::post('/getTable','HomeController@getTable');
    Route::post('/addOrder','HomeController@addOrder');
    Route::post('/updateOrder','HomeController@updateOrder');
    Route::post('/deleteProduct','HomeController@deleteProduct');
    Route::post('/moveTable','HomeController@moveTable');
    Route::post('/mergeTable','HomeController@mergeTable');
    Route::get('/temporaryPay/{id}','HomeController@temporaryPay');
    Route::post('/pay','HomeController@pay');
    Route::get('/listTable','HomeController@listTable');
    Route::resource('document', 'DocumentController');
    Route::get('type/{id}', 'DocumentController@getType');
});
