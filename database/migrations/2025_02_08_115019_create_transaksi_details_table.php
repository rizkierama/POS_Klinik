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
    Schema::create('transaksi_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transaksi_id')->constrained('transaksis')->cascadeOnDelete();
        $table->foreignId('obat_id')->constrained('obats')->cascadeOnDelete();
        $table->integer('jumlah');
        $table->decimal('subtotal', 10, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
