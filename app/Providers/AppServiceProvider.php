<?php

namespace App\Providers;

use App\Services\ModelEventService;
use App\Services\UserActivityLogger;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserActivityLogger::class, function () {
            return new UserActivityLogger();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
