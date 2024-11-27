<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
use TomatoPHP\FilamentLocations\Traits\SwitchDriver;

/**
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property string $lat
 * @property string $lng
 * @property array $translations
 * @property bool $is_activated
 * @property string $created_at
 * @property string $updated_at
 */
class City extends Model
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
    protected $fillable = ['name', 'translations', 'is_activated', 'country_id', 'lat', 'lng', 'created_at', 'updated_at'];

    protected $casts = [
        'translations' => 'json',
        'is_activated' => 'boolean',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function getSchema()
    {
        return [
            'name',
            'translations',
            'is_activated',
            'country_id',
            'lat',
            'lng',
            'created_at',
            'updated_at',
        ];
    }

    public function getRows()
    {
        $cityJson = config('filament-locations.json.cities') ?: __DIR__ . '/../../database/data/cities.json';

        $jsonFileExists = File::exists($cityJson);
        if ($jsonFileExists) {
            return json_decode(File::get($cityJson), true);
        } else {
            return [];
        }
    }
}
