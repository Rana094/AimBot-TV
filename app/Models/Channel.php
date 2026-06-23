<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name',
        'logo_url',
        'stream_url',
        'group',
        'type',
        'drm_kid',
        'drm_key',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
