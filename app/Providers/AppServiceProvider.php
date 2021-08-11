<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Services\PaymentServiceInterface', 'App\Services\PaymentService');
        $this->app->bind('App\Contracts\Repositories\PaymentRepositoryInterface', 'App\Repositories\PaymentRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
