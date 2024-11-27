<?php

namespace TomatoPHP\FilamentLocations\Resources\CityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentLocations\Resources\CityResource;

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
