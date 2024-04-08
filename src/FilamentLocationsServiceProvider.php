<?php

namespace TomatoPHP\FilamentLocations;

use Illuminate\Support\ServiceProvider;


class FilamentLocationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\FilamentLocations\Console\FilamentLocationsInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-locations.php', 'filament-locations');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/filament-locations.php' => config_path('filament-locations.php'),
        ], 'filament-locations-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'filament-locations-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-locations');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/filament-locations'),
        ], 'filament-locations-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-locations');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-locations'),
        ], 'filament-locations-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
