<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('allowed_domain', function ($attribute, $value, $parameters, $validator) {
            $allowedDomain = $parameters[0]; // Get the allowed domain from the rule parameters
    
            // Check if the email address ends with the allowed domain
            return substr($value, -strlen($allowedDomain)) === $allowedDomain;
        });
    }
}
