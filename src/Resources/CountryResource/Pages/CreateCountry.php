<?php

namespace TomatoPHP\FilamentLocations\Resources\CountryResource\Pages;

use TomatoPHP\FilamentLocations\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    public function getTitle():string
    {
        return trans('filament-locations::messages.country.create');
    }
}
