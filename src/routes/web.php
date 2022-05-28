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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::namespace('Auth')->group(function () {
    //パスワードリセット
    Route::get(
        'password/reset',
        'ForgotPasswordController@showLinkRequestForm'
    )->name('password.request');
    Route::post(
        'password/email',
        'ForgotPasswordController@sendResetLinkEmail'
    )->name('password.email');
    Route::get(
        'password/reset/{token}',
        'ResetPasswordController@showResetForm'
    )->name('password.reset');
    Route::post(
        'password/reset',
        'ResetPasswordController@reset'
    )->name('password.resetPost');
});

Route::namespace('Twitter')->group(function () {
    // Twitter認証====================
    // ログイン
    Route::get('login/twitter', 'TwitterLoginController@twitterLogin')->name('login.twitter');
    Route::get('login/twitter/callback', 'TwitterLoginController@twitterCallback')->name('login.twitter.callback');

    // ログアウト
    Route::get('logout/twitter', 'TwitterLogoutController@handle')->name('logout.twitter');
    // ================================

    Route::prefix('twitter')->group(function () {
        Route::get('/follow', 'TwitterFollowController@index')->name('twitter.follow')->middleware('auth', 'twitterAuth');
        Route::get('/coin_trend', 'TwitterCoinTrendController@index')->name('twitter.coin_trend')->middleware('auth');
    });
});

Route::namespace('Google')->group(function () {
    Route::prefix('google')->group(function () {
        Route::get('news', 'GoogleNewsController@index')->name('google.news')->middleware('auth');
    });
});
