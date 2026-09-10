<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman Utama: Menampilkan Katalog Produk
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Detail Produk & Komentar (Dapat diakses Publik/User/Admin)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Route khusus untuk User yang sudah Login
Route::middleware('auth')->group(function () {
    // Tambah Komentar
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    // Profile Routes bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route khusus ADMIN (CRUD Foto Produk)
Route::middleware(['auth'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/auth.php';