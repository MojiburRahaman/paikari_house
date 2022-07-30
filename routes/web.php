<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;



Route::get('/', [FrontendController::class, 'FrontendView'])->name('FrontendView');

Route::post('/cart/modal', [CartController::class, 'CartModalView'])->name('CartModalView');

Route::get('/category', [FrontendController::class, 'Category'])->name('Category');
Route::get('/{vendor}/{product}', [FrontendController::class, 'ProductView'])->name('ProductView');
// Route::get('/product/{ActiveProduct}', [FrontendController::class, 'ProductView'])->name('ProductView');
Route::get('/cart', [CartController::class, 'CartView'])->name('CartView');
Route::post('/cart/quantity-update', [CartController::class, 'CartUpdate'])->name('CartUpdate');
Route::post('/cart/remove', [CartController::class, 'CartRemove'])->name('CartRemove');
Route::post('/cartpost', [CartController::class, 'CartPost'])->name('CartPost');

Route::get('/checkout', [CheckoutController::class, 'CheckoutView'])->name('CheckoutView')->middleware('auth');





require __DIR__ . '/auth.php';
// require __DIR__.'/vendor.php';
// require __DIR__.'/admin.php';
