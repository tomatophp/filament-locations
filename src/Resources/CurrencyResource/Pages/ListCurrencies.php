<?php

namespace TomatoPHP\FilamentLocations\Resources\CurrencyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use TomatoPHP\FilamentLocations\Resources\CurrencyResource;

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
            Actions\CreateAction::make()
                ->visible(config('filament-locations.driver') !== 'json')
                ->label(trans('filament-locations::messages.currency.create')),
        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->simplePaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
    }
}
