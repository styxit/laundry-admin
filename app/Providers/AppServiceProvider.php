<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Laravel\Horizon\Horizon;
use Illuminate\Pagination\Paginator;
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
        // Authorization for Horizon.
        Horizon::auth(function (Request $request) {
            // Allow logged in users.
            return ! is_null($request->user());
        });

        // Let the paginator render bootstrap 3 compatible links.
        Paginator::useBootstrapThree();

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
