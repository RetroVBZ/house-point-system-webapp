<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        // Register route middleware aliases
        Route::aliasMiddleware('student', \App\Http\Middleware\EnsureUserIsStudent::class);
        Route::aliasMiddleware('teacher', \App\Http\Middleware\EnsureUserIsTeacher::class);
    }
}