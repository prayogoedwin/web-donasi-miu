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
        Schema::table('donasis', function (Blueprint $table) {
            $table->string('order_id')->unique()->after('id');
            $table->string('snap_token')->nullable()->after('metode_pembayaran_id');
            $table->string('status_pembayaran')->default('pending')->after('snap_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('snap_token');
            $table->dropColumn('status_pembayaran');
        });
    }
};
