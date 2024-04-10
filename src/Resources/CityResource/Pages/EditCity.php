<?php

namespace TomatoPHP\FilamentLocations\Resources\CityResource\Pages;

use TomatoPHP\FilamentLocations\Resources\CityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCity extends EditRecord
{
    protected static string $resource = CityResource::class;

    public function getTitle(): string
    {
        return trans('filament-locations::messages.city.edit');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
