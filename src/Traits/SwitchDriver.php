<?php

namespace TomatoPHP\FilamentLocations\Traits;

use Sushi\Sushi;

trait SwitchDriver
{
    use Sushi;

    public static function resolveConnection($connection = null)
    {
        return config('filament-locations.driver') === 'json' ? static::$sushiConnection : static::$resolver->connection($connection);
    }

    public function getConnectionName()
    {
        return config('filament-locations.driver') === 'json' ? static::class : $this->connection;
    }

    public static function bootSushi()
    {
        if (config('filament-locations.driver') === 'json') {
            $instance = (new self);

            $cachePath = $instance->sushiCachePath();
            $dataPath = $instance->sushiCacheReferencePath();

            $states = [
                'cache-file-found-and-up-to-date' => function () use ($cachePath) {
                    static::setSqliteConnection($cachePath);
                },
                'cache-file-not-found-or-stale' => function () use ($cachePath, $dataPath, $instance) {
                    static::cacheFileNotFoundOrStale($cachePath, $dataPath, $instance);
                },
                'no-caching-capabilities' => function () use ($instance) {
                    static::setSqliteConnection(':memory:');

                    $instance->migrate();
                },
            ];

            switch (true) {
                case ! $instance->sushiShouldCache():
                    $states['no-caching-capabilities']();

                    break;

                case file_exists($cachePath) && filemtime($dataPath) <= filemtime($cachePath):
                    $states['cache-file-found-and-up-to-date']();

                    break;

                case file_exists($instance->sushiCacheDirectory()) && is_writable($instance->sushiCacheDirectory()):
                    $states['cache-file-not-found-or-stale']();

                    break;

                default:
                    $states['no-caching-capabilities']();

                    break;
            }
        }

    }
}
