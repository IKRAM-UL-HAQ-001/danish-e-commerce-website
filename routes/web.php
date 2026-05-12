<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ActivityController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/shop', [HomeController::class, 'shop'])->name('public.shop');
Route::get('/shop-list', [HomeController::class, 'shopList'])->name('public.shop.list');
Route::get('/product/{product:slug}', [HomeController::class, 'productDetails'])->name('public.product.details');
Route::get('/cart', [HomeController::class, 'cart'])->name('public.cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('public.checkout');

// Cart AJAX Routes
Route::post('/cart/add', [\App\Http\Controllers\Frontend\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [\App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [\App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('cart.remove');

// Product Review Route
Route::post('/product/{product}/review', [\App\Http\Controllers\Frontend\ProductReviewController::class, 'store'])->name('product.review');

Route::prefix('dashboard/')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [ChartController::class, 'index'])->name('analytics.index');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Buyer Specific
    Route::get('/my-orders', [DashboardController::class, 'myOrders'])->name('my-orders');

    // Admin Only Management
    Route::middleware('role:admin')->group(function() {
        // Product Routes
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
        Route::post('products/update', [ProductController::class, 'update'])->name('products.update');
        Route::post('products/delete', [ProductController::class, 'destroy'])->name('products.destroy');
        
        // Category Routes (Using POST for mutations)
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::post('categories/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::post('categories/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Brand Routes
        Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
        Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
        Route::post('brands/update', [BrandController::class, 'update'])->name('brands.update');
        Route::post('brands/delete', [BrandController::class, 'destroy'])->name('brands.destroy');

                // Apply coupon route
        Route::post('cart/apply-coupon', [CouponController::class, 'apply'])->name('cart.applyCoupon');

        Route::get('coupons', [CouponController::class, 'index'])->name('coupons.index');
        Route::post('coupons', [CouponController::class, 'store'])->name('coupons.store');
        Route::post('coupons/update', [CouponController::class, 'update'])->name('coupons.update');
        Route::post('coupons/delete', [CouponController::class, 'destroy'])->name('coupons.destroy');

        // Slider Routes
        Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store');
        Route::post('sliders/update', [SliderController::class, 'update'])->name('sliders.update');
        Route::post('sliders/delete', [SliderController::class, 'destroy'])->name('sliders.destroy');
        
        // Order Routes
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('orders/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::post('orders/delete', [OrderController::class, 'destroy'])->name('orders.destroy');

        // User Management
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
        Route::post('users/delete', [UserController::class, 'destroy'])->name('users.destroy');

        // Site Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

        // Database Backup
        Route::get('backups', [DatabaseBackupController::class, 'index'])->name('backups.index');
        Route::post('backups', [DatabaseBackupController::class, 'create'])->name('backups.create');
        Route::post('backups/download', [DatabaseBackupController::class, 'download'])->name('backups.download');
        Route::post('backups/delete', [DatabaseBackupController::class, 'destroy'])->name('backups.destroy');


        // Dynamic Pages
        Route::get('pages/about', [PageController::class, 'editAbout'])->name('pages.about');
        Route::post('pages/about', [PageController::class, 'updateAbout'])->name('pages.about.update');
        Route::get('pages/contact', [PageController::class, 'editContact'])->name('pages.contact');
        Route::post('pages/contact', [PageController::class, 'updateContact'])->name('pages.contact.update');
        Route::get('pages/terms', [PageController::class, 'editTerms'])->name('pages.terms');
        Route::post('pages/terms', [PageController::class, 'updateTerms'])->name('pages.terms.update');
        // Contact Messages
        Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::post('messages/show', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::post('messages/delete', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
        
        // FAQs
        Route::get('faqs', [FaqController::class, 'index'])->name('faqs.index');
        Route::post('faqs', [FaqController::class, 'store'])->name('faqs.store');
        Route::post('faqs/update', [FaqController::class, 'update'])->name('faqs.update');
        Route::post('faqs/delete', [FaqController::class, 'destroy'])->name('faqs.destroy');
        // Activities
        Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    });
});

require __DIR__.'/auth.php';

// Public Contact Form Submission
Route::post('/contact/submit', [ContactMessageController::class, 'store'])->name('public.contact.submit');

// Public Terms View
Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('public.terms');
