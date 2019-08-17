<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'Auth\LoginController@showLoginForm');

//Auth route:
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/uploadAvatar', 'HomeController@uploadAvatar')->name('uploadAvatar');
Route::post('/editProfile', 'HomeController@editProfile')->name('editProfile');

