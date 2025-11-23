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
    Route::delete('admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
Route::post('/cart/add/{product}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ProductController::class, 'showCart'])->name('cart.show');
Route::post('/cart/remove/{productId}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
