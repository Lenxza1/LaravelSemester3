<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('v_login.login');
})->name('loginPage');

Route::get('/login', [LoginController::class, 'index'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('backend.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('backend.logout');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/store', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');
    });

    // transaksi
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/show/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
        Route::get('/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
        Route::put('/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
        Route::delete('/delete/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.delete');
        Route::get('/print', [TransaksiController::class, 'print'])->name('transaksi.print');
    });

    // order
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
        Route::patch('/update/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');
    });
})->middleware('auth');