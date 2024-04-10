<?php

namespace TomatoPHP\FilamentLocations\Resources\CountryResource\Pages;

use TomatoPHP\FilamentLocations\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;

    public function getTitle():string
    {
        return trans('filament-locations::messages.country.edit');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
