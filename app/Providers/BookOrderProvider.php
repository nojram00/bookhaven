<?php

namespace App\Providers;

use App\Rules\BookGenre;
use App\Services\BookhavenService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class BookOrderProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BookhavenService::class, function($app) {
            return new BookhavenService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
