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
        // Hapus foreign key constraint jika sudah ada
        Schema::table('stok', function (Blueprint $table) {
            $table->dropForeign(['id_barang']); // Sesuaikan dengan nama kolom foreign key yang ingin dihapus jika berbeda
        });

        // Tambahkan foreign key constraint yang baru
        Schema::table('stok', function (Blueprint $table) {
            $table->foreign('id_barang')
                  ->references('id_barang')->on('barang')
                  ->onDelete('cascade'); // opsi onDelete bisa 'cascade', 'restrict', 'set null', dll
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key constraint yang baru ditambahkan
        Schema::table('stok', function (Blueprint $table) {
            $table->dropForeign(['id_barang']);
        });
    }
};
