<?php

namespace TomatoPHP\FilamentLocations\Resources\CountryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use TomatoPHP\FilamentLocations\Resources\CountryResource;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    public function getTitle(): string
    {
        return trans('filament-locations::messages.country.create');
    }
}
