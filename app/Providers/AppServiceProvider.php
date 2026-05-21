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
            $headerCategories = \App\Models\Category::with(['subcategories' => function ($query) {
                    $query->where('status', 1);
                }])
                ->whereNull('parent_id')
                ->where('status', 1)
                ->get();

            $view->with('headerCategories', $headerCategories);
        });
    }
}
