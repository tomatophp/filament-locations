<?php

namespace TomatoPHP\FilamentLocations\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use TomatoPHP\FilamentLocations\Models\Currency;
use TomatoPHP\FilamentLocations\Resources\CurrencyResource\Pages;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-locations::messages.group');
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-locations::messages.currency.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('filament-locations::messages.country.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('iso')
                    ->label(trans('filament-locations::messages.languages.iso'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('exchange_rate')
                    ->label(trans('filament-locations::messages.currency.exchange_rate'))
                    ->numeric(),
                Forms\Components\TextInput::make('symbol')
                    ->label(trans('filament-locations::messages.currency.symbol'))
                    ->maxLength(255),
                Forms\Components\KeyValue::make('translations')
                    ->label(trans('filament-locations::messages.country.form.translations'))
                    ->keyLabel(trans('filament-locations::messages.country.form.translations-key'))
                    ->valueLabel(trans('filament-locations::messages.country.form.translations-value'))
                    ->columnSpan(2),
                Forms\Components\Toggle::make('is_activated')
                    ->label(trans('filament-locations::messages.country.form.is_activated')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('filament-locations::messages.country.form.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso')
                    ->label(trans('filament-locations::messages.languages.iso'))
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
                Tables\Columns\TextColumn::make('exchange_rate')
                    ->label(trans('filament-locations::messages.currency.exchange_rate'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('symbol')
                    ->label(trans('filament-locations::messages.currency.symbol'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_activated')
                    ->label(trans('filament-locations::messages.country.form.is_activated'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCurrencies::route('/'),
        ];
    }
}
