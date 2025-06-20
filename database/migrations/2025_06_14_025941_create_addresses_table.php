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
        Schema::create('addresses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->string('calle', 100)->nullable();
            $table->integer('numero_piso')->nullable();
            $table->string('numero_departamento', 10)->nullable();
            $table->string('distrito', 50)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('departamento', 30)->nullable();
            $table->string('referencia', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
