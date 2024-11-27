<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use TomatoPHP\FilamentLocations\Traits\SwitchDriver;

/**
 * @property int $id
 * @property string $iso
 * @property string $name
 * @property string $arabic
 * @property string $created_at
 * @property string $updated_at
 */
class Language extends Model
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
    protected $fillable = ['translations', 'is_activated', 'iso', 'name', 'arabic', 'created_at', 'updated_at'];

    protected $casts = [
        'translations' => 'json',
        'is_activated' => 'boolean',
    ];

    public function getSchema()
    {
        return [
            'translations',
            'is_activated',
            'iso',
            'name',
            'arabic',
            'created_at',
            'updated_at',
        ];
    }

    public function getRows()
    {
        $languageJson = config('filament-locations.json.languages') ?: __DIR__ . '/../../database/data/languages.json';

        $jsonFileExists = File::exists($languageJson);
        if ($jsonFileExists) {
            return json_decode(File::get($languageJson), true);
        } else {
            return [];
        }
    }
}
