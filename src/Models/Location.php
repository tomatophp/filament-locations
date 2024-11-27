<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $account_id
 * @property string $street
 * @property string $area
 * @property string $city
 * @property string $zip
 * @property bool $is_main
 * @property string $country
 * @property int $home_number
 * @property int $flat_number
 * @property int $floor_number
 * @property string $mark
 * @property string $map_url
 * @property string $note
 * @property string $lat
 * @property string $lng
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 */
class Location extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'modal_id',
        'modal_type',
        'street',
        'zip',
        'is_main',
        'area_id',
        'city_id',
        'country_id',
        'home_number',
        'flat_number',
        'floor_number',
        'mark',
        'map_url',
        'note',
        'lat',
        'lng',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modal()
    {
        return $this->morphTo();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
