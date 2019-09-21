<?php

namespace App\Providers;

use App\Helpers\MascotLife;
use Illuminate\Support\ServiceProvider;

class MascotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MascotLife::class, function() {
            return new MascotLife;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
