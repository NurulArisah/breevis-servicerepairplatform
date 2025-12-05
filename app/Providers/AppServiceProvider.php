<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Order;
use App\Observers\OrderObserver;
use App\Services\LogActivityService;
use App\Services\OrderService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(LogActivityService::class, function ($app) {
            return new LogActivityService();
        });

        // >>> WAJIB: BINDING UNTUK ORDER SERVICE <<<
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // mendaftarkan observer
        Order::observe(OrderObserver::class);
    }
}
