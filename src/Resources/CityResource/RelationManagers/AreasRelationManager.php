<?php

namespace TomatoPHP\FilamentLocations\Resources\CityResource\RelationManagers;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AreasRelationManager extends RelationManager
{
    protected static string $relationship = 'areas';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('filament-locations::messages.areas.title');
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('filament-locations::messages.areas.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\KeyValue::make('translations')
                    ->label(trans('filament-locations::messages.country.form.translations'))
                    ->keyLabel(trans('filament-locations::messages.country.form.translations-key'))
                    ->valueLabel(trans('filament-locations::messages.country.form.translations-value'))
                    ->columnSpan(2),
                Forms\Components\Toggle::make('is_activated')
                    ->label(trans('filament-locations::messages.areas.form.is_activated')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('filament-locations::messages.areas.form.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label(trans('filament-locations::messages.areas.form.city_id'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('filament-locations::messages.areas.form.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(trans('filament-locations::messages.areas.form.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_activated')
                    ->label(trans('filament-locations::messages.areas.form.is_activated'))
                    ->boolean(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->label(trans('filament-locations::messages.areas.create')),
            ])
            ->filters([

            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
