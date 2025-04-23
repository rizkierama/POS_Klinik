<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Cek apakah foreign key masih ada sebelum menghapusnya
            $foreignKeys = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'transaksis' AND CONSTRAINT_NAME = 'transaksis_obat_id_foreign'");

            if (count($foreignKeys) > 0) {
                $table->dropForeign(['obat_id']);
            }

            // Hapus kolom jika masih ada
            if (Schema::hasColumn('transaksis', 'obat_id')) {
                $table->dropColumn('obat_id');
            }
            if (Schema::hasColumn('transaksis', 'jumlah')) {
                $table->dropColumn('jumlah');
            }
        });
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Restore kolom jika tidak ada
            if (!Schema::hasColumn('transaksis', 'obat_id')) {
                $table->unsignedBigInteger('obat_id')->nullable();
            }
            if (!Schema::hasColumn('transaksis', 'jumlah')) {
                $table->integer('jumlah')->nullable();
            }

            // Restore foreign key hanya jika kolom obat_id ada
            $foreignKeys = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'transaksis' AND COLUMN_NAME = 'obat_id'");

            if (count($foreignKeys) == 0) {
                $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade');
            }
        });
    }
};