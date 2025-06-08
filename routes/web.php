<?php

use App\Http\Controllers\GoFoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GrabFoodController;
use App\Http\Controllers\ShopeeFoodController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahan route AJAX untuk ambil menu berdasarkan kategori
Route::get('/get-menus/{category_id}', [GoFoodController::class, 'getMenus'])->name('get-menus');

// Tambahan route AJAX untuk ambil harga berdasarkan menu dan platform
Route::get('/get-price', [GoFoodController::class, 'getPrice'])->name('get-price');


// Route Frontend Halaman Transaksi
Route::get('/gofood', [GoFoodController::class, 'index'])->name('gofood.index');
Route::get('/api/gofood', [GoFoodController::class, 'getAll']);
Route::post('/gofood', [GoFoodController::class, 'store'])->name('gofood.store');
Route::delete('/api/gofood/{id}', [GoFoodController::class, 'destroy'])->name('gofood.destroy');
Route::get('/gofood/{id}/edit', [GoFoodController::class, 'edit']);
Route::get('/gofood/{id}/edit-json', [GoFoodController::class, 'editJson']);
Route::put('/gofood/update/{id}', [GoFoodController::class, 'update'])->name('update');


Route::get('/grabfood', [GrabFoodController::class, 'index'])->name('grabfood.index');
Route::get('/api/grabfood', [GrabFoodController::class, 'getAll']);
Route::post('/grabfood', [GrabFoodController::class, 'store'])->name('grabfood.store');
Route::delete('/api/grabfood/{id}', [GrabFoodController::class, 'destroy'])->name('grabfood.destroy');
Route::get('/grabfood/{id}/edit', [GrabFoodController::class, 'edit']);
Route::get('/grabfood/{id}/edit-json', [GrabFoodController::class, 'editJson']);
Route::put('/grabfood/update/{id}', [GrabFoodController::class, 'update'])->name('update');


Route::get('/shopeefood', [ShopeeFoodController::class, 'index'])->name('shopeefood.index');
Route::get('/api/shopeefood', [ShopeeFoodController::class, 'getAll']);
Route::post('/shopeefood', [ShopeeFoodController::class, 'store'])->name('shopeefood.store');
Route::delete('/api/shopeefood/{id}', [ShopeeFoodController::class, 'destroy'])->name('shopeefood.destroy');
Route::delete('/api/shopeefood/{id}', [ShopeeFoodController::class, 'destroy'])->name('shopeefood.destroy');
Route::get('/shopeefood/{id}/edit', [ShopeeFoodController::class, 'edit']);
Route::get('/shopeefood/{id}/edit-json', [ShopeeFoodController::class, 'editJson']);
Route::put('/shopeefood/update/{id}', [ShopeeFoodController::class, 'update'])->name('update');



// Route Frontend Halaman Laporan Keuangan
Route::view('/laporan', 'laporan.index')->name('laporan.index');

Route::resource('menus', MenuController::class)->only([
    'index', 'store', 'edit', 'update', 'destroy'
]);
Route::get('/menus/{menu}/edit-modal', [MenuController::class, 'editModal']);

Route::view('/items-terjual', 'items-terjual.index')->name('items-terjual.index');



require __DIR__.'/auth.php';
