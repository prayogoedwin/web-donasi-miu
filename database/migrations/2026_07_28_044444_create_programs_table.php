<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link')->unique();
            $table->text('description');
            $table->boolean('is_priority')->default(false);
            $table->foreignId('kategori_program_id')->constrained('kategori_programs')->default(1); // Pembangunan, Operasional, Sosial, Pendidikan, Yatim & Dhuafa, Kesehatan, Lainnya
            $table->decimal('target_amount', 15, 2);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->integer('donor_count')->default(0);
            $table->string('status')->default('active'); // active, completed, cancelled
            $table->string('image_path')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
