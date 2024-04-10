<?php

namespace TomatoPHP\FilamentLocations\Resources\LocationResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use TomatoPHP\FilamentLocations\Resources\LocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocations extends ManageRecords
{
    protected static string $resource = LocationResource::class;

    public function getTitle(): string
    {
        return trans('filament-locations::messages.location.title');
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(trans('filament-locations::messages.location.create')),
        ];
    }
}
