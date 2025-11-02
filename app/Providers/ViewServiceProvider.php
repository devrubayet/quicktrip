<?php

namespace App\Providers;

use App\Models\SiteInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // site info model থেকে data load করা
        View::composer('*', function ($view) {
            $site_infos = SiteInfo::first(); // ধরো তোমার site info টেবিল থেকে একটাই row থাকে
            $view->with('site_infos', $site_infos);
        });
    }
}
