<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrderController;



Route::prefix('dashboard/')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [\App\Http\Controllers\ChartController::class, 'index'])->name('analytics.index');
    
    // Profile Management
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Buyer Specific
    Route::get('/my-orders', [DashboardController::class, 'myOrders'])->name('my-orders');

    // Admin Only Management
    Route::middleware('role:admin')->group(function() {
        // Product Routes
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
        Route::post('products/{product}/update', [ProductController::class, 'update'])->name('products.update');
        Route::post('products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
        
        // Category Routes (Using POST for mutations)
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::post('categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::post('categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Coupon Routes
        Route::get('coupons', [\App\Http\Controllers\CouponController::class, 'index'])->name('coupons.index');
        Route::post('coupons', [\App\Http\Controllers\CouponController::class, 'store'])->name('coupons.store');
        Route::post('coupons/{coupon}/update', [\App\Http\Controllers\CouponController::class, 'update'])->name('coupons.update');
        Route::post('coupons/{coupon}/delete', [\App\Http\Controllers\CouponController::class, 'destroy'])->name('coupons.destroy');

        // Slider Routes
        Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store');
        Route::post('sliders/{slider}/update', [SliderController::class, 'update'])->name('sliders.update');
        Route::post('sliders/{slider}/delete', [SliderController::class, 'destroy'])->name('sliders.destroy');
        
        // Order Routes
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::post('orders/{order}/delete', [OrderController::class, 'destroy'])->name('orders.destroy');

        // User Management
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('users/{user}/toggle-status', [\App\Http\Controllers\UserController::class, 'toggleStatus'])->name('users.toggleStatus');
        Route::post('users/{user}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

        // Site Settings
        Route::get('settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

        // Dynamic Pages
        Route::get('pages/about', [\App\Http\Controllers\PageController::class, 'editAbout'])->name('pages.about');
        Route::post('pages/about', [\App\Http\Controllers\PageController::class, 'updateAbout'])->name('pages.about.update');
        Route::get('pages/contact', [\App\Http\Controllers\PageController::class, 'editContact'])->name('pages.contact');
        Route::post('pages/contact', [\App\Http\Controllers\PageController::class, 'updateContact'])->name('pages.contact.update');
        Route::get('pages/terms', [\App\Http\Controllers\PageController::class, 'editTerms'])->name('pages.terms');
        Route::post('pages/terms', [\App\Http\Controllers\PageController::class, 'updateTerms'])->name('pages.terms.update');
        // Contact Messages
        Route::get('messages', [\App\Http\Controllers\ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [\App\Http\Controllers\ContactMessageController::class, 'show'])->name('messages.show');
        Route::post('messages/{message}/delete', [\App\Http\Controllers\ContactMessageController::class, 'destroy'])->name('messages.destroy');
        
        // FAQs
        Route::get('faqs', [\App\Http\Controllers\FaqController::class, 'index'])->name('faqs.index');
        Route::post('faqs', [\App\Http\Controllers\FaqController::class, 'store'])->name('faqs.store');
        Route::post('faqs/{faq}/update', [\App\Http\Controllers\FaqController::class, 'update'])->name('faqs.update');
        Route::post('faqs/{faq}/delete', [\App\Http\Controllers\FaqController::class, 'destroy'])->name('faqs.destroy');
        // Activities
        Route::get('activities', [\App\Http\Controllers\ActivityController::class, 'index'])->name('activities.index');
    });
});

require __DIR__.'/auth.php';

// Public Contact Form Submission
Route::post('/contact/submit', [\App\Http\Controllers\ContactMessageController::class, 'store'])->name('public.contact.submit');

require __DIR__.'/auth.php';

// Public Terms View
Route::get('/terms-and-conditions', function() {
    $content = \App\Models\Setting::where('key', 'terms_content')->first();
    return view('pages.terms_view', compact('content'));
})->name('public.terms');
