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
        Schema::create('book_promotion', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('promotion_id');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');

            // Índice único para evitar duplicados
            $table->unique(['book_id', 'promotion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_promotion');
    }
};
