<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
