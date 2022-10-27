<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dashboard\BrandController;
use App\Http\Controllers\dashboard\SubCategoryController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\SellerController;

// Route::middleware(['auth:web',])->prefix('admin')->group(function () {

// Route::get('/dashboard', [DashboardController::class, 'DashboardView'])->name('DashboardView');
// Route::post('/summer-note/upload', [DashboardController::class, 'SummerNoteUpload'])->name('SummerNoteUpload');
// Route::get('/category/banner/{id}', [CategoryController::class, 'CategoryBannerDelete'])->name('CategoryBannerDelete');
// Route::resource('category', CategoryController::class);
// Route::resource('subcategory', SubCategoryController::class);
// Route::resource('brand', BrandController::class);


// });
Route::post('/logout', [DashboardController::class, 'AdminLogout'])->name('AdminLogout');
Route::post('/login', [DashboardController::class, 'AdminloginPost'])->name('AdminloginPost');
Route::get('/login', [DashboardController::class, 'Adminlogin'])->name('Adminlogin');
Route::middleware(['auth:admin',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'DashboardView'])->name('DashboardView');
    Route::post('/summer-note/upload', [DashboardController::class, 'SummerNoteUpload'])->name('SummerNoteUpload');
    Route::post('/category/status/', [CategoryController::class, 'CategoryStatus'])->name('CategoryStatus');
    Route::get('/category/banner/{id}', [CategoryController::class, 'CategoryBannerDelete'])->name('CategoryBannerDelete');
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::post('/seller/status/', [SellerController::class, 'SellerStatus'])->name('SellerStatus');
    Route::resource('seller', SellerController::class);
});
