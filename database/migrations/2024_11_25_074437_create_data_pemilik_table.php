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
        Schema::create('data_pemilik', function (Blueprint $table) {
            $table->string('id_data_pemilik')->primary();
            $table->string('id_user'); // Ubah tipe data dari unsignedInteger menjadi string
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('nomor_telp');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pemilik');
    }
};
