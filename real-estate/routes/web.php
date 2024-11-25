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



//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');

Route::resource('deals', 'DealController', ['middleware' => ['role:broker|agent']]);

Route::resource('deal-parties', 'DealPartyController', ['middleware' => ['role:broker|agent']]);

Route::resource('deal-status', 'DealStatusController', ['middleware' => ['role:broker|agent']]);

Route::resource('users', 'UserController', ['middleware' => ['role:broker|agent']]);