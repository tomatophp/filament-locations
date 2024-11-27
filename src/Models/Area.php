<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
use TomatoPHP\FilamentLocations\Traits\SwitchDriver;

/**
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property string $lat
 * @property string $lng
 * @property array $translations
 * @property bool $is_activated
 * @property string $created_at
 * @property string $updated_at
 */
class Area extends Model
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
    protected $fillable = ['name', 'translations', 'is_activated', 'city_id', 'lat', 'lng', 'created_at', 'updated_at'];

    protected $casts = [
        'translations' => 'json',
        'is_activated' => 'boolean',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getSchema()
    {
        return [
            'name',
            'translations',
            'is_activated',
            'city_id',
            'lat',
            'lng',
            'created_at',
            'updated_at',
        ];
    }

    public function getRows()
    {
        $areaJson = config('filament-locations.json.areas') ?: __DIR__ . '/../../database/data/areas.json';

        $jsonFileExists = File::exists($areaJson);
        if ($jsonFileExists) {
            return json_decode(File::get($areaJson), true);
        } else {
            return [];
        }
    }
}
