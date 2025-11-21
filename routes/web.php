<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/', [ProductController::class, 'index']);

// Админка — будем использовать простые маршруты
Route::prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
});
