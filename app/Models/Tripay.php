<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tripay extends Model
{
    protected $table = 'tripays';

    protected $fillable = [
        'environment',
        'api_key',
        'url_sandbox',
        'url_production',
    ];
}
