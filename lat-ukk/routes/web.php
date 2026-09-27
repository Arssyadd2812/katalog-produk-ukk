<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPhotoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'is_admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Kelola produk & foto: khusus admin (didaftarkan dulu agar
// /products/create tidak tertelan route publik /products/{product})
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::post('products/{product}/photos', [ProductPhotoController::class, 'store'])->name('products.photos.store');
    Route::put('photos/{photo}', [ProductPhotoController::class, 'update'])->name('photos.update');
    Route::delete('photos/{photo}', [ProductPhotoController::class, 'destroy'])->name('photos.destroy');
});

// Katalog publik: lihat produk + foto
Route::resource('products', ProductController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
