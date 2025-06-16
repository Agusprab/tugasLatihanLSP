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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')->constrained('item')->onDelete('cascade'); // Foreign key to item table
            $table->integer('quantity');
            $table->integer('price')->default(0); // Harga per item
            $table->integer('amount')->default(0); // Total amount for the transaction
            $table->integer('session_id')->nullable(); // Optional session ID for tracking
            $table->string('remarks')->nullable(); // Optional remarks for the transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
