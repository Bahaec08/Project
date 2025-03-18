<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('enum_value', function ($attribute, $value, $parameters, $validator) {
            $enumClass = $parameters[0];
            return $enumClass::hasValue($value);
        });
    }
}
