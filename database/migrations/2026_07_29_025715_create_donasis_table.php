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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nomor_hp');
            $table->integer('jumlah_donasi');
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained('metode_pembayarans')->onDelete('set null');
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('transaction_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->timestamp('success_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
