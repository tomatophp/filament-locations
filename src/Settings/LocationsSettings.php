<?php

namespace TomatoPHP\FilamentLocations\Settings;

use Spatie\LaravelSettings\Settings;

class LocationsSettings extends Settings
{
    public ?string $site_address = null;

    public ?string $site_phone_code = null;

    public ?string $site_location = null;

    public ?string $site_currency = null;

    public ?string $site_language = null;

    public static function group(): string
    {
        return 'locations';
    }
}
