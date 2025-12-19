<?php

namespace TomatoPHP\FilamentLocations\Resources;

use Filament\Forms;
use Filament\Actions;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use TomatoPHP\FilamentLocations\Models\Language;
use TomatoPHP\FilamentLocations\Resources\LanguageResource\Pages;

class LanguageResource extends Resource
{
    protected static ?string $model = Language::class;

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-language';

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-locations::messages.group');
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-locations::messages.languages.title');
    }

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('iso')
                    ->label(trans('filament-locations::messages.languages.iso'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label(trans('filament-locations::messages.country.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\KeyValue::make('translations')
                    ->label(trans('filament-locations::messages.country.form.translations'))
                    ->keyLabel(trans('filament-locations::messages.country.form.translations-key'))
                    ->valueLabel(trans('filament-locations::messages.country.form.translations-value'))
                    ->columnSpan(2),
                Forms\Components\Toggle::make('is_activated'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('iso')
                    ->label(trans('filament-locations::messages.languages.iso'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('filament-locations::messages.country.form.name'))
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
                Tables\Columns\IconColumn::make('is_activated')
                    ->label(trans('filament-locations::messages.country.form.is_activated'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Actions\EditAction::make()->visible(config('filament-locations.driver') !== 'json'),
                Actions\DeleteAction::make()->visible(config('filament-locations.driver') !== 'json'),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make()->visible(config('filament-locations.driver') !== 'json'),
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
            'index' => Pages\ListLanguages::route('/'),
        ];
    }
}
