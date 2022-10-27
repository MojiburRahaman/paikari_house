<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\vendor\CouponController;
use App\Http\Controllers\dashboard\vendor\OrderController;
use App\Http\Controllers\dashboard\vendor\VendorController;
use App\Http\Controllers\dashboard\vendor\ProductController;
// Route::middleware(['guest:web,vendor',])->prefix('vendor')->group(function () {
// Route::get('/login', [VendorController::class, 'VendorLogin'])->name('VendorLogin');
// });

Route::middleware(['guest:vendor',])->group(function () {
    Route::get('/login', [VendorController::class, 'VendorLogin'])->name('VendorLogin');
    Route::post('/login', [VendorController::class, 'VendorLoginPost'])->name('VendorLoginPost');
    Route::post('/register', [VendorController::class, 'VendorRegister'])->name('VendorRegister');
});


Route::get('/access-denied', [VendorController::class, 'VendorAccessDenied'])->name('VendorAccessDenied');
Route::post('/logout', [VendorController::class, 'VendorLogout'])->name('VendorLogout')->middleware('auth:vendor');
Route::middleware(['auth:vendor', 'VendorStatus'])->group(function () {
    Route::get('/dashboard', [VendorController::class, 'VendorDashboardView'])->name('VendorDashboardView');

    Route::post('/product/status/', [ProductController::class, 'ProductStatus'])->name('ProductStatus');
    Route::post('/product/feature/', [ProductController::class, 'ProductFeature'])->name('ProductFeature');
    Route::post('/product/trending/', [ProductController::class, 'ProductTrending'])->name('ProductTrending');
    Route::get('/product/gallery/{id}', [ProductController::class, 'GalleryRemove'])->name('GalleryRemove');
    Route::get('/product/get-sub-cat/{cat_id}', [ProductController::class, 'GetSubcatbyAjax'])->name('GetSubcatbyAjax');
    Route::resource('product', ProductController::class);
    Route::resource('coupon', CouponController::class);
    Route::resource('order', OrderController::class);
});
