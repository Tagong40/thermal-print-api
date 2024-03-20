<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ThermalPrinterService;
use Mike42\Escpos\PrintConnectors\UsbPrintConnector;

class ThermalPrinterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ThermalPrinterService::class, function ($app) {

            return new ThermalPrinterService(new UsbPrintConnector("Your/USB/Port"));
        });
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
