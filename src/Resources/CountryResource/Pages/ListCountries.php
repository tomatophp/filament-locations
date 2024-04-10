<?php

namespace TomatoPHP\FilamentLocations\Resources\CountryResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use TomatoPHP\FilamentLocations\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCountries extends ManageRecords
{
    protected static string $resource = CountryResource::class;

    public function getTitle():string
    {
        return trans('filament-locations::messages.country.title');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(trans('filament-locations::messages.country.create')),
        ];
    }
}
