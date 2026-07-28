<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informasi extends Model
{
    use SoftDeletes;

    protected $table = 'informasis';

    protected $fillable = [
        'key',
        'value',
    ];

    public function parent()
    {
        return $this->belongsTo(Informasi::class, 'parent_id');
    }
}
