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
        Schema::table('promotions', function (Blueprint $table) {
            // Eliminar columnas que ya no necesitamos
            $table->dropColumn(['tipo', 'modalidad_promocion']);
            
            // Cambiar la cantidad para que sea un porcentaje (0-100)
            $table->integer('cantidad')->change()->comment('Porcentaje de descuento (0-100)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            // Restaurar las columnas eliminadas
            $table->enum('tipo', ['todos', 'categoria', 'libro'])->nullable();
            $table->enum('modalidad_promocion', ['porcentual', 'monto fijo'])->nullable();
            
            // Restaurar la cantidad original
            $table->integer('cantidad')->change();
        });
    }
};
