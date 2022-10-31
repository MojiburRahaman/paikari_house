<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\WishListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'FrontendView'])->name('FrontendView');
Route::get('/compare', [CompareController::class, 'CompareView'])->name('CompareView');
Route::get('/compare/reset', [CompareController::class, 'CompareReset'])->name('CompareReset');
Route::post('/compare', [CompareController::class, 'CompareViewPost'])->name('CompareViewPost');
Route::get('/category/{slug}', [SearchController::class, 'CategorySearch'])->name('CategorySearch');
Route::post('/ajax-keyword', [SearchController::class, 'AjaxSearch'])->name('AjaxSearch');
Route::get('/shop/{slug}', [FrontendController::class, 'FrrontendShopView'])->name('FrrontendShopView');
Route::get('/shop/{slug}/all-products', [FrontendController::class, 'FrrontendShopViewAllProducts'])->name('FrrontendShopViewAllProducts');
Route::post('/cart/modal', [CartController::class, 'CartModalView'])->name('CartModalView');
Route::get('/category', [FrontendController::class, 'Category'])->name('Category');
Route::get('/{vendor}/{product}', [FrontendController::class, 'ProductView'])->name('ProductView');

Route::middleware(['auth:web',])->group(function () {
    Route::get('/dashboard', [UserProfileController::class, 'UserProfile'])->name('UserProfile');


    Route::get('/wishlist', [WishListController::class, 'WishListView'])->name('WishListView');
    Route::post('/wishlist', [WishListController::class, 'WishListViewPost'])->name('WishListViewPost');
    Route::post('/wishlist/remove', [WishListController::class, 'WishListRemovePost'])->name('WishListRemovePost');

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
