<?php

use App\Http\Controllers\LoginController;
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
Route::post('/login', [LoginController::class, 'login'])->name('backend.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('backend.logout');

Route::get('/admin/dashboard', function () {
    return view('v_dashboard.admin');
})->name('admin.dashboard');