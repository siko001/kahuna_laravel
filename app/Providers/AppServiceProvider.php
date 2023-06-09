<?php

namespace App\Providers;

use App\Models\RegisteredProduct;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        View::composer('resources/views/compontents/layout.blade.php', function ($view) {
            $registeredProducts = RegisteredProduct::all();
            $view->with('registeredProducts', $registeredProducts);
        });
    }
}
