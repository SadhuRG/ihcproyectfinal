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
        // Agregar soft deletes a la tabla books
        Schema::table('books', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Agregar soft deletes a la tabla editions
        Schema::table('editions', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Agregar soft deletes a la tabla inventories
        Schema::table('inventories', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remover soft deletes de la tabla books
        Schema::table('books', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remover soft deletes de la tabla editions
        Schema::table('editions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remover soft deletes de la tabla inventories
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
