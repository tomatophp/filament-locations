<?php

use Filament\Facades\Filament;
use TomatoPHP\FilamentLocations\FilamentLocationsPlugin;

it('registers plugin', function () {
    $panel = Filament::getCurrentPanel();

    $panel->plugins([
        FilamentLocationsPlugin::make(),
    ]);

    expect($panel->getPlugin('filament-locations'))
        ->not()
        ->toThrow(Exception::class);
});
