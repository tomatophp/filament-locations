![Screenshot of Login](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/3x1io-tomato-locations.jpg)

# Filament locations

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-locations/version.svg)](https://packagist.org/packages/tomatophp/filament-locations)
[![PHP Version Require](http://poser.pugx.org/tomatophp/filament-locations/require/php)](https://packagist.org/packages/tomatophp/filament-locations)
[![License](https://poser.pugx.org/tomatophp/filament-locations/license.svg)](https://packagist.org/packages/tomatophp/filament-locations)
[![Downloads](https://poser.pugx.org/tomatophp/filament-locations/d/total.svg)](https://packagist.org/packages/tomatophp/filament-locations)

Database Seeds for Locations for FilamentPHP

## Screenshots

![Countires](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/country.png)
![Edit Countires](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/edit-country.png)
![Languages](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/languages.png)
![Currency](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/currency.png)
![Locaitons](https://raw.githubusercontent.com/tomatophp/filament-locations/master/arts/locations.png)


## Installation

```bash
composer require tomatophp/filament-locations
```
after install your package please run this command

```bash
php artisan filament-locations:install
```

finally reigster the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(\TomatoPHP\FilamentLocations\FilamentLocationsPlugin::make())
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

## Support

you can join our discord server to get support [TomatoPHP](https://discord.gg/Xqmt35Uh)

## Docs

you can check docs of this package on [Docs](https://docs.tomatophp.com/plugins/laravel-package-generator)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Tomatophp](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
