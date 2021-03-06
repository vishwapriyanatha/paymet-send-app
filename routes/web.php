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

Route::get('/', function () {
    return redirect()->intended('login');
});

Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth', 'verified']],
    function () {

        Route::get('logout', 'HomeController@logout')->name('force.logout');

        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('/payment', 'PaymentController');
        Route::get('user','PaymentController@getUser')->name('get.log.user');
        Route::get('claim/{id}','PaymentController@claimAmount')->name('claim.amount');
    });
