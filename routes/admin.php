<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dashboard\BrandController;
use App\Http\Controllers\dashboard\SubCategoryController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ProductController;


// Route::middleware(['auth:web',])->prefix('admin')->group(function () {

    // Route::get('/dashboard', [DashboardController::class, 'DashboardView'])->name('DashboardView');
    // Route::post('/summer-note/upload', [DashboardController::class, 'SummerNoteUpload'])->name('SummerNoteUpload');
    // Route::get('/category/banner/{id}', [CategoryController::class, 'CategoryBannerDelete'])->name('CategoryBannerDelete');
    // Route::resource('category', CategoryController::class);
    // Route::resource('subcategory', SubCategoryController::class);
    // Route::resource('brand', BrandController::class);

   
// });
Route::middleware(['auth:web','admincheck'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'DashboardView'])->name('DashboardView');
    Route::post('/summer-note/upload', [DashboardController::class, 'SummerNoteUpload'])->name('SummerNoteUpload');
    Route::get('/category/banner/{id}', [CategoryController::class, 'CategoryBannerDelete'])->name('CategoryBannerDelete');
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('brand', BrandController::class);
});