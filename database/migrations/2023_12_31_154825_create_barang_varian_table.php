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
        Schema::create('barang_varian', function (Blueprint $table) {
            $table->id();
            $table->char('kode_barang', 5);
            $table->string('nama');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('kode_barang')->references('kode')->on('barang')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_varian');
    }
};
