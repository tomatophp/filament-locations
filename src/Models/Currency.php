<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use TomatoPHP\FilamentLocations\Traits\SwitchDriver;

/**
 * @property int $id
 * @property string $arabic
 * @property string $name
 * @property string $iso
 * @property string $created_at
 * @property string $updated_at
 */
class Currency extends Model
{
    use SwitchDriver;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['translations', 'exchange_rate', 'symbol', 'is_activated', 'arabic', 'name', 'iso', 'created_at', 'updated_at'];

    protected $casts = [
        'translations' => 'json',
        'is_activated' => 'boolean',
    ];

    public function getSchema()
    {
        return [
            'translations',
            'exchange_rate',
            'symbol',
            'is_activated',
            'arabic',
            'name',
            'iso',
            'created_at',
            'updated_at',
        ];
    }

    public function getRows()
    {

        $currencyJson = config('filament-locations.json.currencies') ?: __DIR__ . '/../../database/data/currencies.json';

        $jsonFileExists = File::exists($currencyJson);
        if ($jsonFileExists) {
            return json_decode(File::get($currencyJson), true);
        } else {
            return [];
        }
    }
}
