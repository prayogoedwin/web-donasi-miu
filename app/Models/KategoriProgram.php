<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriProgram extends Model
{
    // Schema::create('kategori_programs', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('title');
    //         $table->text('description')->nullable();
    //         $table->timestamps();
    //         $table->softDeletes();
    //     });

    use SoftDeletes;
    protected $table = 'kategori_programs';

    protected $fillable = [
        'title',
        'description',
    ];
}
