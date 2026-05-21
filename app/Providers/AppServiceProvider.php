<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.layouts.partials.header', function ($view) {
            $view->with('headerCategories', \App\Models\Category::whereNull('parent_id')->where('status', 1)->get());
        });
    }
}
