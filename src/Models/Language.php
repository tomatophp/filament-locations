<?php

namespace TomatoPHP\FilamentLocations\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $iso
 * @property string $name
 * @property string $arabic
 * @property string $created_at
 * @property string $updated_at
 */
class Language extends Model
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
    protected $fillable = ['translations','is_activated','iso', 'name', 'arabic', 'created_at', 'updated_at'];

    protected $casts = [
        'translations' => 'json',
        'is_activated' => 'boolean'
    ];
}
