<?php

namespace TomatoPHP\FilamentLocations;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TomatoPHP\FilamentLocations\Pages\LocationSettings;
use TomatoPHP\FilamentLocations\Resources\CityResource;
use TomatoPHP\FilamentLocations\Resources\CountryResource;
use TomatoPHP\FilamentLocations\Resources\CurrencyResource;
use TomatoPHP\FilamentLocations\Resources\LanguageResource;
use TomatoPHP\FilamentLocations\Resources\LocationResource;
use TomatoPHP\FilamentSettingsHub\Facades\FilamentSettingsHub;
use TomatoPHP\FilamentSettingsHub\Services\Contracts\SettingHold;

class FilamentLocationsPlugin implements Plugin
{
    private bool $useSettingsHub = true;

    private bool $countries = true;

    private bool $languages = true;

    private bool $currency = true;

    private bool $locations = true;

    public function getId(): string
    {
        return 'filament-locations';
    }

    public function settingsHub(bool $useSettingsHub = true): static
    {
        $this->useSettingsHub = $useSettingsHub;

        return $this;
    }

    public function hasSettingsHub(): bool
    {
        return $this->useSettingsHub;
    }

    public function countries(bool $countries = true): static
    {
        $this->countries = $countries;

        return $this;
    }

    public function hasCountries(): bool
    {
        return $this->countries;
    }

    public function languages(bool $languages = true): static
    {
        $this->languages = $languages;

        return $this;
    }

    public function hasLanguages(): bool
    {
        return $this->languages;
    }

    public function currency(bool $currency = true): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function hasCurrency(): bool
    {
        return $this->currency;
    }

    public function locations(bool $locations = true): static
    {
        $this->locations = $locations;

        return $this;
    }

    public function hasLocations(): bool
    {
        return $this->locations;
    }

    public function register(Panel $panel): void
    {
        $resources = [];
        if ($this->hasCountries()) {
            $resources[] = CityResource::class;
            $resources[] = CountryResource::class;
        }
        if ($this->hasLanguages()) {
            $resources[] = LanguageResource::class;
        }
        if ($this->hasCurrency()) {
            $resources[] = CurrencyResource::class;
        }
        if ($this->hasLocations()) {
            $resources[] = LocationResource::class;
        }

        if ($this->hasSettingsHub()) {
            $panel->pages([
                LocationSettings::class,
            ]);
        }

        $panel->resources($resources);
    }

    public function boot(Panel $panel): void
    {
        if ($this->hasSettingsHub()) {
            FilamentSettingsHub::register([
                SettingHold::make()
                    ->page(LocationSettings::class)
                    ->order(0)
                    ->label('filament-locations::messages.settings.location.title')
                    ->icon('heroicon-o-map')
                    ->description('filament-locations::messages.settings.location.description')
                    ->group('filament-settings-hub::messages.group'),
            ]);
        }
    }

    public static function make(): FilamentLocationsPlugin
    {
        return new FilamentLocationsPlugin;
    }
}
