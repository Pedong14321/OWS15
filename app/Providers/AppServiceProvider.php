<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

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
        View::share('title', 'OSAS Web Services'); // title share accross pages

        // this is a custom validator
        Validator::extend('alpha_spaces', function ($attribute, $value) { 
            // This rule allows alphabetic characters and spaces
            return preg_match('/^[\pL\s]+$/u', $value);
        });
    }
}
