<?php

namespace TomatoPHP\FilamentLocations\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use TomatoPHP\FilamentLocations\Models\City;
use TomatoPHP\FilamentLocations\Resources\CityResource\Pages;
use TomatoPHP\FilamentLocations\Resources\CityResource\RelationManagers\AreasRelationManager;
use TomatoPHP\FilamentLocations\Resources\CountryResource\Pages\ListCountries;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-locations::messages.group');
    }

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('filament-locations::messages.city.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('country_id')
                    ->label(trans('filament-locations::messages.city.form.country_id'))
                    ->relationship('country', 'name')
                    ->required(),
                Forms\Components\KeyValue::make('translations')
                    ->label(trans('filament-locations::messages.city.form.translations'))
                    ->keyLabel('language')
                    ->valueLabel('translation')
                    ->columnSpan(2),
                Forms\Components\Repeater::make('timezones')->columnSpan(2)
                    ->label(trans('filament-locations::messages.city.form.timezones'))
                    ->schema([
                        Forms\Components\TextInput::make('tzName'),
                        Forms\Components\TextInput::make('zoneName'),
                        Forms\Components\TextInput::make('gmtOffset'),
                        Forms\Components\TextInput::make('abbreviation'),
                        Forms\Components\TextInput::make('gmtOffsetName'),
                    ]),
                Forms\Components\TextInput::make('lat')
                    ->label(trans('filament-locations::messages.city.form.lat'))
                    ->numeric(),
                Forms\Components\TextInput::make('lng')
                    ->label(trans('filament-locations::messages.city.form.lng'))
                    ->numeric(),
                Forms\Components\Toggle::make('is_activated')
                    ->label(trans('filament-locations::messages.city.form.is_activated')),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AreasRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCountries::route('/'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
            'view' => Pages\ViewCity::route('/{record}/show'),
        ];
    }
}
