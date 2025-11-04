<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ApiToken extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'api_tokens';

    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}


