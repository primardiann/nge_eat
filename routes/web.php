<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoFoodController;
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
Route::post('/gofood/tambah', [GoFoodController::class, 'store'])->name('gofood.store');

Route::view('/grabfood', 'grabfood.index')->name('grabfood.index');
Route::view('/shopeefood', 'shopeefood.index')->name('shopeefood.index');

//Route Frontend Halaman Laporan Keuangan
Route::view('/laporan', 'laporan.index')->name('laporan.index');


require __DIR__.'/auth.php';
