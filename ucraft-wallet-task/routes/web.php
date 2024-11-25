<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddWalletController;
use App\Http\Controllers\MyWalletController;
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
    return view('welcome');
});


Route::get('profile', [ProfileController::class, 'index'])->middleware([ 'auth','has-added-wallet' ])->name('profile');
Route::get('add-wallet', [AddWalletController::class, 'index'])->middleware([ 'auth'])->name('add-wallet');
Route::get('my-wallets', [MyWalletController::class, 'index'])->middleware([ 'auth'])->name('my-wallets');
Route::get('reports', [ReportsController::class, 'index'])->middleware([ 'auth'])->name('reports');

Route::prefix('profile')->middleware(['auth'])->group(function () {

});

Route::view('my-reports', 'account.my-reports')->name('account.my-reports');
