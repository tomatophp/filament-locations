<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 * @property string $lat
 * @property string $lng
 * @property array $translations
 * @property boolean $is_activated
 * @property string $created_at
 * @property string $updated_at
 */
class City extends Model
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
    protected $fillable = ['name','translations','is_activated', 'country_id', 'lat', 'lng', 'created_at', 'updated_at'];

    protected $casts = [
        'translations' => 'json',
        'is_activated' => 'boolean'
    ];

    /**
     * @return BelongsTo
     */
    public  function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
