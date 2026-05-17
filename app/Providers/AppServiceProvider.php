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
            $view->with('headerCategories', \App\Models\Category::whereNull('parent_id')->where('status', 1)->with(['subcategories' => function($q) {
                $q->where('status', 1);
            }])->get());
            $view->with('siteLogo', \App\Models\Setting::where('key', 'site_logo')->value('value'));
        });
    }
}
