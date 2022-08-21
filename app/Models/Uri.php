<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $attributes, array $values = [])
 * @method static where($array, callable $callback)
 */
class Uri extends Model
{
    const UPDATED_AT = null;

    /**
     * @var string
     */
    protected $table = 'links';

    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'short_hash',
    ];
}
