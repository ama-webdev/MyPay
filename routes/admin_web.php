<?php

use Illuminate\Support\Facades\Auth;
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

Route::prefix('admin')->namespace('Backend')->name('admin.')->middleware('auth:admin_user')->group(function () {
    Route::get('/', 'PageController@index')->name('index');
    Route::resource('admin-users', 'AdminUserController');
    Route::get('/admin-users/datatables/ssd', 'AdminUserController@ssd');

    Route::resource('users', 'UserController');
    Route::get('/users/datatables/ssd', 'UserController@ssd');

    Route::resource('wallets', 'WalletController');
    Route::get('/wallets/datatables/ssd', 'WalletController@ssd');
});
