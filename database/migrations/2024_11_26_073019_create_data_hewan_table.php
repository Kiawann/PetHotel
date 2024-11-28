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
        Schema::create('data_hewan', function (Blueprint $table) {
                $table->string('id_data_hewan')->primary();
                $table->string('id_data_pemilik'); // Ubah tipe data dari unsignedInteger menjadi string
                $table->foreign('id_data_pemilik')->references('id_data_pemilik')->on('data_pemilik')->onDelete('cascade');
                $table->string('id_kategori_hewan'); // Ubah tipe data dari unsignedInteger menjadi string
                $table->foreign('id_kategori_hewan')->references('id_kategori_hewan')->on('kategori_hewan')->onDelete('cascade');
                $table->string('nama_hewan');
                $table->integer('umur');
                $table->integer('berat_badan');
                $table->string('warna');
                $table->string('ras_hewan');
                $table->enum('jenis_kelamin',['L','P']);
                $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_hewan');
    }
};
