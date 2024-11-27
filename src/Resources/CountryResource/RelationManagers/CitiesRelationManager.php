<?php

namespace TomatoPHP\FilamentLocations\Resources\CountryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentLocations\Models\City;
use TomatoPHP\FilamentLocations\Resources\CityResource\Pages\EditCity;
use TomatoPHP\FilamentLocations\Resources\CityResource\Pages\ViewCity;

class CitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'cities';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('filament-locations::messages.city.title');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('filament-locations::messages.city.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\KeyValue::make('translations')
                    ->label(trans('filament-locations::messages.country.form.translations'))
                    ->keyLabel(trans('filament-locations::messages.country.form.translations-key'))
                    ->valueLabel(trans('filament-locations::messages.country.form.translations-value'))
                    ->columnSpan(2),
                Forms\Components\Repeater::make('timezones')->columnSpan(2)
                    ->label(trans('filament-locations::messages.country.form.timezones'))
                    ->schema([
                        Forms\Components\TextInput::make('tzName')
                            ->label(trans('filament-locations::messages.country.form.tzName')),
                        Forms\Components\TextInput::make('zoneName')
                            ->label(trans('filament-locations::messages.country.form.zoneName')),
                        Forms\Components\TextInput::make('gmtOffset')
                            ->label(trans('filament-locations::messages.country.form.gmtOffset')),
                        Forms\Components\TextInput::make('abbreviation')
                            ->label(trans('filament-locations::messages.country.form.abbreviation')),
                        Forms\Components\TextInput::make('gmtOffsetName')
                            ->label(trans('filament-locations::messages.country.form.gmtOffsetName')),
                    ]),
                Forms\Components\TextInput::make('lat')
                    ->label(trans('filament-locations::messages.country.form.lat'))
                    ->numeric(),
                Forms\Components\TextInput::make('lng')
                    ->label(trans('filament-locations::messages.country.form.lng'))
                    ->numeric(),
                Forms\Components\Toggle::make('is_activated')
                    ->label(trans('filament-locations::messages.country.form.is_activated')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('name', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('filament-locations::messages.city.form.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('filament-locations::messages.country.form.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(trans('filament-locations::messages.country.form.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->url(fn (City $record): string => ViewCity::getUrl(['record' => $record])),
                Tables\Actions\Action::make('edit')
                    ->visible(config('filament-locations.driver') !== 'json')
                    ->label(trans('filament-locations::messages.city.edit'))
                    ->icon('heroicon-o-pencil-square')
                    ->url(fn (City $record): string => EditCity::getUrl(['record' => $record])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
