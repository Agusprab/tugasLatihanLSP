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
        Schema::create('identitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_identitas');
            $table->string('badan_hukum')->nullable();
            $table->string('npwp')->nullable();
            $table->string('email')->nullable();
            $table->string('url')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('fax')->nullable();
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas');
    }
};
