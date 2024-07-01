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
        Schema::create('stok', function (Blueprint $table) {
          
            $table->bigIncrements('id_stok');
            $table->unsignedBigInteger('id_barang');
            $table->string('stok_barang', 30);
            $table->date('tanggal_stok');
            $table->timestamps();
            $table->foreign('id_barang')
                  ->references('id_barang')
                  ->on('barangs')
                  ->onDelete('cascade'); // opsi onDelete jika diperlukan
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok');
    }
};
