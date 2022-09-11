<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'FrontendView'])->name('FrontendView');
Route::get('/category/{slug}', [SearchController::class, 'CategorySearch'])->name('CategorySearch');
Route::post('/ajax-keyword', [SearchController::class, 'AjaxSearch'])->name('AjaxSearch');
Route::get('/shop/{slug}', [FrontendController::class, 'FrrontendShopView'])->name('FrrontendShopView');
Route::get('/shop/{slug}/all-products', [FrontendController::class, 'FrrontendShopViewAllProducts'])->name('FrrontendShopViewAllProducts');
Route::post('/cart/modal', [CartController::class, 'CartModalView'])->name('CartModalView');
Route::get('/category', [FrontendController::class, 'Category'])->name('Category');
Route::get('/{vendor}/{product}', [FrontendController::class, 'ProductView'])->name('ProductView');

Route::middleware(['auth',])->group(function () {
    Route::get('/cart', [CartController::class, 'CartView'])->name('CartView');
    Route::get('/ajax-cart', [CartController::class, 'AjaxCartView'])->name('AjaxCartView');
    Route::post('/cart/quantity-update', [CartController::class, 'CartUpdate'])->name('CartUpdate');
    Route::post('/cart/remove', [CartController::class, 'CartRemove'])->name('CartRemove');
    Route::post('/cartpost', [CartController::class, 'CartPost'])->name('CartPost');

    Route::get('/checkout', [CheckoutController::class, 'CheckoutView'])->name('CheckoutView');
    Route::post('/checkout', [CheckoutController::class, 'CheckoutPost'])->name('CheckoutPost');
    Route::post('/checkout/billing/district', [CheckoutController::class, 'GetDiistrict'])->name('GetDiistrict');
    Route::post('/coupon', [CheckoutController::class, 'CouponPost'])->name('CouponPost');
});




require __DIR__ . '/auth.php';
// require __DIR__.'/vendor.php';
// require __DIR__.'/admin.php';
