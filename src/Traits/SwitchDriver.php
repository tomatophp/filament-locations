<?php

namespace TomatoPHP\FilamentLocations\Traits;

use Sushi\Sushi;

trait SwitchDriver
{
    use Sushi {
        bootSushi as protected bootSushiConnection;
    }

    public static function resolveConnection($connection = null)
    {
        return config('filament-locations.driver') === 'json' ? static::$sushiConnection : static::$resolver->connection($connection);
    }

    public function getConnectionName()
    {
        return config('filament-locations.driver') === 'json' ? static::class : $this->connection;
    }

    /**
     * Only the json driver reads its rows through Sushi. Sushi defers creating the model
     * instance it needs until the model has finished booting, which Laravel 12.8+ requires.
     */
    public static function bootSushi()
    {
        if (config('filament-locations.driver') === 'json') {
            static::bootSushiConnection();
        }
    }
}
