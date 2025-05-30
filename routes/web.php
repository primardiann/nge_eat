<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoFoodController;
use App\Http\Controllers\MenuController;
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

//Route Frontend Halaman Transaksi
Route::get('/gofood', [GoFoodController::class, 'index'])->name('gofood.index');
Route::get('/api/gofood', [GoFoodController::class, 'getAll']);
Route::post('/gofood/tambah', [GoFoodController::class, 'store'])->name('gofood.store');
Route::delete('/api/gofood/{id}', [GoFoodController::class, 'destroy'])->name('gofood.destroy');


Route::view('/grabfood', 'grabfood.index')->name('grabfood.index');
Route::view('/shopeefood', 'shopeefood.index')->name('shopeefood.index');

//Route Frontend Halaman Laporan Keuangan
Route::view('/laporan', 'laporan.index')->name('laporan.index');

Route::resource('menus', MenuController::class)->only([
    'index', 'store', 'edit', 'update', 'destroy'
]);



require __DIR__.'/auth.php';
