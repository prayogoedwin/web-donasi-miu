<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriProgram;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    // Schema::create('programs', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('title');
    //         $table->text('description');
    //         $table->boolean('is_priority')->default(false);
    //         $table->foreignId('kategori_id')->constrained('kategori_programs')->default(1); // Pembangunan, Operasional, Sosial, Pendidikan, Yatim & Dhuafa, Kesehatan, Lainnya
    //         $table->decimal('target_amount', 15, 2);
    //         $table->decimal('collected_amount', 15, 2)->default(0);
    //         $table->integer('donor_count')->default(0);
    //         $table->string('status')->default('active'); // active, completed, cancelled
    //         $table->string('image_path')->nullable();
    //         $table->date('start_date');
    //         $table->date('end_date');
    //         $table->timestamps();
    //         $table->softDeletes();
    //     });

    protected $table = 'programs';
    
    protected $fillable = [
        'title',
        'description',
        'is_priority',
        'kategori_program_id',
        'target_amount',
        'collected_amount',
        'donor_count',
        'status',
        'image_path',
        'start_date',
        'end_date',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProgram::class, 'kategori_id');
    }
}
