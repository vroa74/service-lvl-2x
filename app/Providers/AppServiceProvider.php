<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Facade;

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
        // Registrar el alias de PDF si no está registrado
        if (!Facade::getFacadeApplication()->bound('pdf')) {
            $this->app->alias('dompdf', 'pdf');
        }
    }
}
