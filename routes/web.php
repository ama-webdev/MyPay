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

Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('admin/login', 'Auth\AdminLoginController@Login')->name('admin.login');


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'Frontend\PageController@home')->name('home');
    Route::get('/menu', 'Frontend\PageController@menu')->name('menu');

    Route::get('/change-password', 'Frontend\PageController@changePassword')->name('changePassword');
    Route::post('/change-password', 'Frontend\PageController@updatePassword')->name('changePassword');

    Route::get('/change-phone', 'Frontend\PageController@changePhone')->name('changePhone');
    Route::post('/change-phone', 'Frontend\PageController@updatePhone')->name('changePhone');

    Route::get('/transfer', 'Frontend\PageController@transfer')->name('transfer');
    Route::get('/transfer/confirm', 'Frontend\PageController@transferConfirm')->name('transferConfirm');
    Route::post('/transfer/complete', 'Frontend\PageController@transferComplete')->name('transferComplete');

    Route::get('/transaction', 'Frontend\PageController@transaction')->name('transaction');
    Route::get('/transaction/{trx_id}', 'Frontend\PageController@transactionDetail')->name('transactionDetail');

    Route::get('/password-check', 'Frontend\PageController@checkPassword');
    Route::get('/transfer/hash', 'Frontend\PageController@hashPhone');

    Route::get('/myqr', 'Frontend\PageController@myQR')->name('myqr');
    Route::get('/myscan', 'Frontend\PageController@myScan')->name('myscan');

    Route::get('/comming-soon', 'Frontend\PageController@commingSoon')->name('comming-soon');
});
