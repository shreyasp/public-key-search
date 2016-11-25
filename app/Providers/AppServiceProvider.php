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
        // Lumen Generators
      if ($this->app->environment() == 'local') {
        $this->app->register('Wn\Generators\CommandsServiceProvider');
      }
    }
}
