<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

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

// Route default (bisa diganti ke login atau dashboard)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk login (asumsi punya view auth/login.blade.php)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group route yang butuh auth (login dulu)
Route::middleware('auth')->group(function () {
    // Dashboard (asumsi punya view dashboard.blade.php, redirect setelah login)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Member (Registrasi Pelanggan) - admin & kasir
    Route::resource('members', MemberController::class);

    // CRUD Outlet - admin only (check di controller)
    Route::resource('outlets', OutletController::class);

    // CRUD Paket (produk/paket cucian) - admin only
    Route::resource('pakets', PaketController::class);

    // CRUD User (pengguna) - admin only
    Route::resource('users', UserController::class);

    // Entri Transaksi - admin & kasir
    Route::resource('transaksis', TransaksiController::class);

    // Generate Laporan - semua role
    Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');
    // Kalau butuh post atau filter, bisa tambah Route::post('/laporans', [LaporanController::class, 'generate']);
});