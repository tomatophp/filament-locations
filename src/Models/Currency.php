<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $arabic
 * @property string $name
 * @property string $iso
 * @property string $created_at
 * @property string $updated_at
 */
class Currency extends Model
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
    protected $fillable = ['translations','exchange_rate', 'symbol','is_activated','arabic', 'name', 'iso', 'created_at', 'updated_at'];

    protected $casts = [
        'translations' => 'json',
        'is_activated' => 'boolean'
    ];

}
