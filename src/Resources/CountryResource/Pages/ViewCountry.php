<?php

namespace TomatoPHP\FilamentLocations\Resources\CountryResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use Filament\Resources\Pages\ViewRecord;
use TomatoPHP\FilamentLocations\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ViewCountry extends ViewRecord
{
    protected static string $resource = CountryResource::class;
}
