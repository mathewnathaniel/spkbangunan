<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/compare', [HomeController::class, 'compare'])->name('compare');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.show');
