<?php

namespace TomatoPHP\FilamentLocations;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\View\View;
use Nwidart\Modules\Module;
use TomatoPHP\FilamentLocations\Resources\AreaResource;
use TomatoPHP\FilamentLocations\Resources\CityResource;
use TomatoPHP\FilamentLocations\Resources\CountryResource;
use TomatoPHP\FilamentLocations\Resources\CurrencyResource;
use TomatoPHP\FilamentLocations\Resources\LanguageResource;
use TomatoPHP\FilamentLocations\Resources\LocationResource;

class FilamentLocationsPlugin implements Plugin
{
    private bool $isActive = false;

    public function getId(): string
    {
        return 'filament-locations';
    }

    public function register(Panel $panel): void
    {
        if(class_exists(Module::class) && \Nwidart\Modules\Facades\Module::find('FilamentLocations')?->isEnabled()){
            $this->isActive = true;
        }
        else {
            $this->isActive = true;
        }

        if($this->isActive) {
            $resources = [];
            if (config('filament-locations.resources.city')) {
                $resources[] = CityResource::class;
            }
            if (config('filament-locations.resources.country')) {
                $resources[] = CountryResource::class;
            }
            if (config('filament-locations.resources.languages')) {
                $resources[] = LanguageResource::class;
            }
            if (config('filament-locations.resources.currency')) {
                $resources[] = CurrencyResource::class;
            }
            if (config('filament-locations.resources.locations')) {
                $resources[] = LocationResource::class;
            }

            $panel->resources($resources);
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return new static();
    }


    /**
     * Returns a View object that renders the language switcher component.
     *
     * @return \Illuminate\Contracts\View\View The View object that renders the language switcher component.
     */
    private function getLanguageSwitcherView(): View
    {
        $locales = config('filament-translations.locals');
        $currentLocale = app()->getLocale();
        $currentLanguage = collect($locales)->firstWhere('code', $currentLocale);
        $otherLanguages = $locales;
        $showFlags = config('filament-translations.show_flags');

        return view('filament-translations::language-switcher', compact(
            'otherLanguages',
            'currentLanguage',
            'showFlags',
        ));
    }
}
