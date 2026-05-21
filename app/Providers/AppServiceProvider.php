<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('frontend.layouts.partials.header', function ($view) {
            $view->with('headerCategories', \App\Models\Category::with(['subcategories' => function ($query) {
                $query->where('status', 1)->orderBy('name');
            }])->whereNull('parent_id')->where('status', 1)->orderBy('name')->get());
        });
    }
}
