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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('asunto', 255);
            $table->text('mensaje_usuario');
            $table->text('mensaje_admin')->nullable();
            $table->enum('estado', ['enviado', 'recibido', 'solucionado'])->default('enviado');
            $table->timestamps();
            
            // Índices para mejorar el rendimiento
            $table->index(['user_id', 'estado']);
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
