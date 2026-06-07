<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/compare', [HomeController::class, 'compare'])->name('compare');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.show');
Route::get('/brand/{id}', [HomeController::class, 'show'])->name('brand.show');

// Search
Route::get('/search', [HomeController::class, 'search'])->name('search');

// AI assistant (internal recommender)
Route::get('/assistant', [HomeController::class, 'assistant'])->name('assistant');
Route::post('/assistant/recommend', [HomeController::class, 'assistantRecommend'])->name('assistant.recommend');
