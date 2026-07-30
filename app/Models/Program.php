<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriProgram;
use App\Models\Donasi;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    // Schema::create('programs', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('title');
    //         $table->string('proposed_by')->nullable();
    //         $table->string('link')->unique();
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
        'proposed_by',
        'link',
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

    public static function booted()
    {
        static::creating(function ($program) {
            // Generate a unique link based on the title
            $program->link = self::generateUniqueLink($program->title);
        });

        static::updated(function ($program) {
            // If the title has changed, update the link
            if ($program->isDirty('title')) {
                $program->link = self::generateUniqueLink($program->title);
                $program->save();
            }
        });
    }

    private static function generateUniqueLink($title)
    {
        // Convert the title to a URL-friendly format
        $link = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));

        // Check if the link already exists in the database
        $count = self::where('link', 'like', $link . '%')->count();

        // If it exists, append a number to make it unique
        if ($count > 0) {
            $link .= '-' . ($count + 1);
        }

        return $link;
    }

    public function kategori_program()
    {
        return $this->belongsTo(KategoriProgram::class, 'kategori_program_id');
    }

    public function donasis()
    {
        return $this->hasMany(Donasi::class);
    }

    public function getDaysLeftAttribute()
    {
        $today = now();
        $endDate = $this->end_date;

        if ($endDate && $today <= $endDate) {
            return (int) $today->diffInDays($endDate);
        }

        return 0; // Return 0 if the program has ended or no end date is set
    }
}
