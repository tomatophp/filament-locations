<?php

namespace TomatoPHP\FilamentLocations\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use TomatoPHP\FilamentLocations\Models\Country;
use TomatoPHP\FilamentLocations\Resources\CountryResource\Pages;
use TomatoPHP\FilamentLocations\Resources\CountryResource\RelationManagers;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-locations::messages.group');
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-locations::messages.country.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(['default' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(trans('filament-locations::messages.country.form.title'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->label(trans('filament-locations::messages.country.form.code'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label(trans('filament-locations::messages.country.form.phone'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('region')
                            ->label(trans('filament-locations::messages.country.form.region'))
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
                        Forms\Components\TextInput::make('numeric_code')
                            ->label(trans('filament-locations::messages.country.form.numeric_code'))
                            ->maxLength(3),
                        Forms\Components\TextInput::make('iso3')
                            ->label(trans('filament-locations::messages.country.form.iso3'))
                            ->maxLength(3),
                        Forms\Components\TextInput::make('nationality')
                            ->label(trans('filament-locations::messages.country.form.nationality'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('capital')
                            ->label(trans('filament-locations::messages.country.form.capital'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tld')
                            ->label(trans('filament-locations::messages.country.form.tld'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('native')
                            ->label(trans('filament-locations::messages.country.form.native'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('currency')
                            ->label(trans('filament-locations::messages.country.form.currency'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('currency_name')
                            ->label(trans('filament-locations::messages.country.form.currency_name'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('currency_symbol')
                            ->label(trans('filament-locations::messages.country.form.currency_symbol'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('wikiDataId')
                            ->label(trans('filament-locations::messages.country.form.wikiDataId'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('lat')
                            ->label(trans('filament-locations::messages.country.form.lat'))
                            ->numeric(),
                        Forms\Components\TextInput::make('lng')
                            ->label(trans('filament-locations::messages.country.form.lng'))
                            ->numeric(),
                        Forms\Components\TextInput::make('emoji')
                            ->label(trans('filament-locations::messages.country.form.emoji'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emojiU')
                            ->label(trans('filament-locations::messages.country.form.emojiU'))
                            ->maxLength(255),
                        Forms\Components\Toggle::make('flag')
                            ->label(trans('filament-locations::messages.country.form.flag')),
                        Forms\Components\Toggle::make('is_activated')
                            ->label(trans('filament-locations::messages.country.form.is_activated')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('emoji')
                    ->label(trans('filament-locations::messages.country.form.emoji'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('filament-locations::messages.country.form.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(trans('filament-locations::messages.country.form.currency_symbol'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label(trans('filament-locations::messages.country.form.code'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(trans('filament-locations::messages.country.form.phone'))
                    ->toggleable(isToggledHiddenByDefault: false)
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
                Tables\Columns\TextColumn::make('numeric_code')
                    ->label(trans('filament-locations::messages.country.form.numeric_code'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso3')
                    ->label(trans('filament-locations::messages.country.form.iso3'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nationality')
                    ->label(trans('filament-locations::messages.country.form.nationality'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')
                    ->label(trans('filament-locations::messages.country.form.capital'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('tld')
                    ->label(trans('filament-locations::messages.country.form.tld'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('native')
                    ->label(trans('filament-locations::messages.country.form.native'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->label(trans('filament-locations::messages.country.form.region'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
                    ->label(trans('filament-locations::messages.country.form.currency'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_name')
                    ->label(trans('filament-locations::messages.country.form.currency_name'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_activated')
                    ->label(trans('filament-locations::messages.country.form.is_activated'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->visible(config('filament-locations.driver') !== 'json'),
                Tables\Actions\DeleteAction::make()->visible(config('filament-locations.driver') !== 'json'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(config('filament-locations.driver') !== 'json'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CitiesRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return config('filament-locations.driver') !== 'json' ? [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
            'view' => Pages\ViewCountry::route('/{record}/show'),
        ] : [
            'index' => Pages\ListCountries::route('/'),
            'view' => Pages\ViewCountry::route('/{record}/show'),
        ];
    }
}
