<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Format seconds to readable time format.
        Blade::directive('duration', function ($expression) {
            return "<?php
            \$format = ($expression < 60) ? '0\m s\s' : 'G\h i\m';
            echo \Carbon\Carbon::createFromTimestamp($expression)->format(\$format); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
