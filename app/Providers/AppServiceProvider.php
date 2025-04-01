<?php

namespace App\Providers;

use App\Models\HeaderAndFooter;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\View;
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
        FilamentColor::register([
            'primary' => Color::hex('#0090C7'),
        ]);

        View::composer(['components.layouts.app'], function ($view) {
            $view->with([
                'siteInfo' => HeaderAndFooter::first(),
            ]);
        });
    }
}
