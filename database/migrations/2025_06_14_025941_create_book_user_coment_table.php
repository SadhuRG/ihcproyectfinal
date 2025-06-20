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
        Schema::create('book_user_coment', function (Blueprint $table) {
            $table->integer('book_id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->integer('puntuacion')->nullable();
            $table->string('comentario', 200)->nullable();
            $table->date('fecha_valoracion')->nullable();

            $table->primary(['book_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_user_coment');
    }
};
