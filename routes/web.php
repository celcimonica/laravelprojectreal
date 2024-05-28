<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
// use App\Http\Controllers\ReportController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CetakController;

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

Route::get('/',[WelcomeController::class,'welcome'])->middleware('auth');



// Route::get('/', function () {
//     return view('dashboard',[
//     "title"=>"Dashboard"
//     ]);
//     })->middleware('auth');
    // Route::resource('kategori',CategoryController::class)->except('show','destroy','create')->middleware('auth');
Route::resource('pelanggan',PelangganController::class)->except('destroy')->middleware('auth');
Route::resource('layanan',LayananController::class)->middleware('auth');
Route::resource('pengguna',UserController::class)->except('destroy','create','show','update'.'edit')->middleware('auth');

Route::get('login',[LoginController::class,'loginView'])->name('login');
Route::post('login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout'])->name('auth.logout');

Route::get('penjualan',function(){
    return view('penjualan.index',[
        "title"=>"Penjualan"
    ]);
})->name('Penjualan')->middleware('auth');
Route::get('transaksi',function(){
    return view('Penjualan.transaksis',[
        "title"=>"transaksi"
    ]);
})->middleware('auth');
Route::get('cetakReceipt',[CetakController::class,'receipt'])->name('cetakReceipt')->middleware('auth');
// Route::resource('reports', ReportController::class);