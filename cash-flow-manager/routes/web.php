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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::POST('/transaction/store', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaksi', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');

// Route::group(
//     ['prefix' => 'bapak', 'as' => 'bapak.','middleware'=>'bapak'],
//     function () {
//         Route::get('/', [Bapak\DashboardController::class, "index"])->name('dashboard');
//     }
// );
