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
        Schema::dropIfExists('edition_promotion');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('edition_promotion', function (Blueprint $table) {
            $table->id();
            $table->integer('edition_id');
            $table->integer('promotion_id');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('edition_id')->references('id')->on('editions')->onDelete('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');

            // Índice único para evitar duplicados
            $table->unique(['edition_id', 'promotion_id']);
        });
    }
};
