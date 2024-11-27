<?php

namespace TomatoPHP\FilamentLocations;

use Illuminate\Support\ServiceProvider;

require_once __DIR__ . '/helpers.php';

class FilamentLocationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
            \TomatoPHP\FilamentLocations\Console\FilamentLocationsInstall::class,
            \TomatoPHP\FilamentLocations\Console\FilamentLocationsLoad::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__ . '/../config/filament-locations.php', 'filament-locations');

        //Publish Config
        $this->publishes([
            __DIR__ . '/../config/filament-locations.php' => config_path('filament-locations.php'),
        ], 'filament-locations-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if (config('filament-locations.driver') === 'database') {
            $this->loadMigrationsFrom(__DIR__ . '/../database/sql-migrations');
        }

        //Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-locations');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => base_path('lang/vendor/filament-locations'),
        ], 'filament-locations-lang');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
