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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->integer('do_number')->nullable(); // Nomor Delivery Order
            $table->string('status')->default('Belum Dibayar'); // Status pembayaran: Belum Dibayar, Sudah Dibayar
            $table->foreignId('transaction_id')->constrained('item')->onDelete('cascade'); // Foreign key to item table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
