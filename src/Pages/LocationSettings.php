<?php

namespace TomatoPHP\FilamentLocations\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use TomatoPHP\FilamentLocations\Models\Country;
use TomatoPHP\FilamentLocations\Models\Currency;
use TomatoPHP\FilamentLocations\Models\Language;
use TomatoPHP\FilamentLocations\Settings\LocationsSettings;
use TomatoPHP\FilamentSettingsHub\Pages\SettingsHub;
use TomatoPHP\FilamentSettingsHub\Traits\UseShield;

class LocationSettings extends SettingsPage
{
    use UseShield;

    protected static string | null | \BackedEnum $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = LocationsSettings::class;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getHeaderActions(): array
    {
        $tenant = Filament::getTenant();

        return [
            Action::make('back')
                ->url($tenant ? SettingsHub::getUrl(['tenant' => $tenant->id]) : SettingsHub::getUrl())
                ->color('danger')
                ->label(trans('filament-locations::messages.back')),
        ];
    }

    public function getTitle(): string
    {
        return trans('filament-locations::messages.settings.location.title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Grid::make(['default' => 1])->schema([
                    Textarea::make('site_address')
                        ->label(trans('filament-locations::messages.settings.location.form.site_address'))
                        ->hint(config('filament-settings-hub.show_hint') ? 'setting("site_address")' : null),
                    Select::make('site_location')
                        ->preload()
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            $country = Country::query()->where('code', $get('site_location'))->first();
                            if ($country) {
                                $set('site_phone_code', $country->phone);
                                $set('site_currency', $country->currency);
                            }
                        })
                        ->options(fn (): array => Country::query()->pluck('name', 'code')->toArray())
                        ->label(trans('filament-locations::messages.settings.location.form.site_location'))
                        ->hint(config('filament-settings-hub.show_hint') ? 'setting("site_location")' : null),
                    Select::make('site_phone_code')
                        ->searchable()
                        ->options(fn (): array => Country::query()->pluck('phone', 'phone')->toArray())
                        ->label(trans('filament-locations::messages.settings.location.form.site_phone_code'))
                        ->hint(config('filament-settings-hub.show_hint') ? 'setting("site_phone_code")' : null),
                    Select::make('site_currency')
                        ->searchable()
                        ->options(fn (): array => Currency::query()->pluck('name', 'iso')->toArray())
                        ->required()
                        ->label(trans('filament-locations::messages.settings.location.form.site_currency'))
                        ->hint(config('filament-settings-hub.show_hint') ? 'setting("site_currency")' : null),
                    Select::make('site_language')
                        ->searchable()
                        ->options(fn (): array => Language::query()->pluck('name', 'iso')->toArray())
                        ->label(trans('filament-locations::messages.settings.location.form.site_language'))
                        ->hint(config('filament-settings-hub.show_hint') ? 'setting("site_language")' : null),
                ]),
            ]);
    }
}
