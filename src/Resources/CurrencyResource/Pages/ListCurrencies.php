<?php

namespace TomatoPHP\FilamentLocations\Resources\CurrencyResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentLocations\Resources\CurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurrencies extends ManageRecords
{
    protected static string $resource = CurrencyResource::class;

    public function getTitle(): string
    {
        return trans('filament-locations::messages.currency.title');
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(trans('filament-locations::messages.currency.create')),
        ];
    }
}
