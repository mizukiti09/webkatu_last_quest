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

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Auth::routes();

Route::get('login/twitter', 'TwitterLoginController@redirectToProvider');
Route::get('login/twitter/callback', 'TwitterLoginController@handleProviderCallback');

Route::prefix('twitter')->group(function () {
    Route::get('/follow', 'TwitterFollowController@index')->name('twitter.follow')->middleware('auth', 'twitterAuth');
});
