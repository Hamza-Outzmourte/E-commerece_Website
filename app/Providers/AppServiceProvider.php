<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Stock;
use App\Observers\StockObserver;
class AppServiceProvider extends ServiceProvider
{


public function boot()
{
    Stock::observe(StockObserver::class);
}

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

}
