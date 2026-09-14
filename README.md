![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/3x1io-tomato-locations.jpg)

# Filament Locations

[![Dependabot Updates](https://github.com/tomatophp/filament-locations/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/tomatophp/filament-locations/actions/workflows/dependabot/dependabot-updates)
[![PHP Code Styling](https://github.com/tomatophp/filament-locations/actions/workflows/fix-php-code-styling.yml/badge.svg)](https://github.com/tomatophp/filament-locations/actions/workflows/fix-php-code-styling.yml)
[![Tests](https://github.com/tomatophp/filament-locations/actions/workflows/tests.yml/badge.svg)](https://github.com/tomatophp/filament-locations/actions/workflows/tests.yml)
[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-locations/version.svg)](https://packagist.org/packages/tomatophp/filament-locations)
[![License](https://poser.pugx.org/tomatophp/filament-locations/license.svg)](https://packagist.org/packages/tomatophp/filament-locations)
[![Downloads](https://poser.pugx.org/tomatophp/filament-locations/d/total.svg)](https://packagist.org/packages/tomatophp/filament-locations)

A database of countries, cities, area, languages, currenacy with json base and database base for FilamentPHP

## Version Compatibility

| Plugin | Filament | Laravel | PHP |
|--------|----------|---------|-----|
| 5.x    | 5.x      | 12.x - 13.x | 8.2+ |
| 4.x    | 4.x      | 11.x - 12.x | 8.2+ |
| 2.x    | 3.x      | 10.x - 11.x | 8.1+ |

## Screenshots

![Countries](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/countries-light.png)
![Countries Dark](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/countries-dark.png)
![View Country](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/country-view-light.png)
![View Country Dark](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/country-view-dark.png)
![Languages](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/languages-light.png)
![Currencies](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/currencies-dark.png)
![Locations](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/locations-light.png)
![Location Settings](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/location-settings-light.png)
![Location Settings Dark](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/location-settings-dark.png)


## Installation

```bash
composer require tomatophp/filament-locations
```

The package uses [Filament Settings Hub](https://github.com/tomatophp/filament-settings-hub) for the location settings page, so install it first if it is not installed yet (`php artisan filament-settings-hub:install`).

after install your package please run this command

```bash
php artisan filament-locations:install
```

finally reigster the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(\TomatoPHP\FilamentLocations\FilamentLocationsPlugin::make())
```

## Disable Setting Hub 

to disable the setting hub you can use this method

```php
->plugin(\TomatoPHP\FilamentLocations\FilamentLocationsPlugin::make()->settingsHub(false))
```

## Disable Resources

to disable the resources you can use this method

```php
->plugin(
\TomatoPHP\FilamentLocations\FilamentLocationsPlugin::make()
    ->countries(false)
    ->languages(false)
    ->currency(false)
    ->locations(false)
)
```

## Use Database Driver

to use database driver or if you don't have "sqlite" on your app, you can change the driver on config to "database" first publish the config


```bash
php artisan vendor:publish --tag="filament-locations-config"
```

after that go to `config/filament-locations.php` and change the driver to "database"

```php
    'driver' => 'database'
```

now you need to run migration

```bash
php artisan migrate
```

now load the data to seeder

```bash
php artisan filament-locations:seed
```

and the full data will be migrated to your database

## Use Custom JSON Files

if you like to use your json data files it's easy you can just change the path of json on your config file with the matched json schema

```php
    'driver' => 'json',
    
    'json' => [
        'countries' => base_path('resources/json/countries.json'),
        'cities' => base_path('resources/json/cities.json'),
        'areas' => base_path('resources/json/areas.json'),
        'languages' => base_path('resources/json/languages.json'),
        'currencies' => base_path('resources/json/currencies.json'),
    ],
```

## Currency Helper

we have ready to use helper to convert the money amount to the currency symbol

```php
dollar($amount) // Output $100.00
```

## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-locations-config"
```

you can publish views file by use this command

```bash
php artisan vendor:publish --tag="filament-locations-views"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-locations-lang"
```

you can publish migrations file by use this command

```bash
php artisan vendor:publish --tag="filament-locations-migrations"
```

## Other Filament Packages

Checkout our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)

