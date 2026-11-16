<?php

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman utama -> arahkan ke modul Pelanggan
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('pelanggan.index')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modul Pelanggan (wajib login, hak akses dicek di Policy)
    Route::resource('pelanggan', PelangganController::class);
});

require __DIR__.'/auth.php';