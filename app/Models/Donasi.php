<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donasi extends Model
{
    // Schema::create('donasis', function (Blueprint $table) {
    //     $table->id();
    //     $table->foreignId('program_id')->constrained()->onDelete('cascade');
    //     $table->string('nama');
    //     $table->string('nomor_hp');
    //     $table->integer('jumlah_donasi');
    //     $table->timestamps();
    //     $table->softDeletes();
    // });

    use SoftDeletes;

    protected $table = 'donasis';

    protected $fillable = [
        'program_id',
        'nama',
        'nomor_hp',
        'jumlah_donasi',
        'metode_pembayaran_id',
        'status',
        'transaction_id',
        'payment_url',
        'success_at',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
