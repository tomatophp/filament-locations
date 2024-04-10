<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $phone
 * @property string $lat
 * @property string $lng
 * @property string $numeric_code
 * @property array $translations
 * @property array $timezones
 * @property boolean $is_activated
 * @property string $created_at
 * @property string $updated_at
 * @property string $flag
 * @property string $emojiU
 * @property string $emoji
 * @property string $wikiDataId
 * @property string $currency_symbol
 * @property string $currency_name
 * @property string $currency
 * @property string $region
 * @property string $native
 * @property string $tld
 * @property string $capital
 * @property string $nationality
 * @property string $iso3
 */
class Country extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'phone',
        'lat',
        'lng',
        'created_at',
        'updated_at',
        'translations',
        'timezones',
        'numeric_code',
        'is_activated',
        'flag',
        'emojiU',
        'emoji',
        'wikiDataId',
        'currency_symbol',
        'currency_name',
        'currency',
        'region',
        'native',
        'tld',
        'capital',
        'nationality',
        'iso3',
    ];

    protected $casts = [
        'translations' => 'json',
        'timezones' => 'json',
        'is_activated' => 'boolean'
    ];


    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
