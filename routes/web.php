<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoFoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GrabFoodController;
use App\Http\Controllers\ShopeeFoodController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ItemTerjualController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;

// Redirect ke login saat akses root URL
Route::get('/', function () {
    return redirect()->route('login');
});

// Route dashboard (hanya bisa diakses kalau user sudah login & terverifikasi)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route untuk manajemen profil user (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');       // Form edit profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Proses update profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Hapus akun
});

// ====== ROUTE KATEGORI ======
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');      // Tampilkan semua kategori
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');     // Simpan kategori baru
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update'); // Update kategori
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); // Hapus kategori
Route::get('/kategori/{id}', [KategoriController::class, 'get'])->name('kategori.get');     // Ambil 1 data kategori
Route::get('/api/kategori', [KategoriController::class, 'getAll'])->name('kategori.api');   // API semua kategori (JSON)

// ====== ROUTE MENU ======
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');                // Tampilkan semua menu
Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');               // Simpan menu baru
Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');       // Update data menu
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');  // Hapus menu
Route::get('/menus/{menu}/edit-modal', [MenuController::class, 'editModal'])->name('menus.editModal'); // Ambil data untuk modal edit

// ====== ROUTE GOFOOD ======
Route::get('/gofood', [GoFoodController::class, 'index'])->name('gofood.index');            // Halaman data transaksi GoFood
Route::get('/api/gofood', [GoFoodController::class, 'getAll']);                             // API semua data GoFood
Route::post('/gofood', [GoFoodController::class, 'store'])->name('gofood.store');           // Simpan transaksi GoFood
Route::delete('/api/gofood/{id}', [GoFoodController::class, 'destroy'])->name('gofood.destroy'); // Hapus transaksi
Route::get('/gofood/{id}/edit', [GoFoodController::class, 'edit']);                         // Ambil data untuk form edit
Route::get('/gofood/{id}/edit-json', [GoFoodController::class, 'editJson']);                // Ambil data dalam bentuk JSON
Route::put('/gofood/update/{id}', [GoFoodController::class, 'update'])->name('gofood.update'); // Proses update data

// ====== ROUTE GRABFOOD ======
Route::get('/grabfood', [GrabfoodController::class, 'index'])->name('grabfood.index');      // Halaman transaksi GrabFood
Route::get('/api/grabfood', [GrabfoodController::class, 'getAll']);                         // API semua data GrabFood
Route::post('/grabfood', [GrabfoodController::class, 'store'])->name('grabfood.store');     // Simpan transaksi GrabFood
Route::delete('/api/grabfood/{id}', [GrabfoodController::class, 'destroy'])->name('grabfood.destroy'); // Hapus data
Route::get('/grabfood/{id}/edit', [GrabfoodController::class, 'edit']);                     // Ambil data untuk edit
Route::get('/grabfood/{id}/edit-json', [GrabfoodController::class, 'editJson']);            // Data JSON untuk modal
Route::put('/grabfood/update/{id}', [GrabfoodController::class, 'update'])->name('grabfood.update'); // Proses update

// ====== ROUTE SHOPEEFOOD ======
Route::get('/shopeefood', [ShopeefoodController::class, 'index'])->name('shopeefood.index'); // Halaman ShopeeFood
Route::get('/api/shopeefood', [ShopeefoodController::class, 'getAll']);                      // API semua data ShopeeFood
Route::post('/shopeefood', [ShopeefoodController::class, 'store'])->name('shopeefood.store'); // Simpan transaksi
Route::delete('/api/shopeefood/{id}', [ShopeefoodController::class, 'destroy'])->name('shopeefood.destroy'); // Hapus data
Route::get('/shopeefood/{id}/edit', [ShopeefoodController::class, 'edit']);                  // Ambil data edit
Route::get('/shopeefood/{id}/edit-json', [ShopeefoodController::class, 'editJson']);         // JSON untuk modal
Route::put('/shopeefood/update/{id}', [ShopeefoodController::class, 'update'])->name('shopeefood.update'); // Update data

// ====== ROUTE ITEM TERJUAL (GROUPED) ======
Route::prefix('items-terjual')->name('items-terjual.')->group(function () {
    Route::get('/gofood', [ItemTerjualController::class, 'gofood'])->name('gofood');         // Data item terjual GoFood
    Route::get('/grabfood', [ItemTerjualController::class, 'grabfood'])->name('grabfood');   // Data item terjual GrabFood
    Route::get('/shopeefood', [ItemTerjualController::class, 'shopeefood'])->name('shopeefood'); // Data item terjual ShopeeFood
});

// ====== ROUTE LAPORAN ======
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');          // Halaman laporan gabungan
Route::get('/laporan/download/excel', [DownloadController::class, 'downloadExcel'])->name('laporan.download.excel'); // Unduh Excel
Route::get('/laporan/download/pdf', [DownloadController::class, 'downloadPdf'])->name('laporan.download.pdf');       // Unduh PDF

// ====== ROUTE AUTHENTIKASI (LOGIN, REGISTER, DLL) ======
require __DIR__.'/auth.php';
