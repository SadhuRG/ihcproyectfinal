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
        Schema::create('editions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('editorial_id')->index('editorial_id');
            $table->integer('inventorie_id')->index('inventorie_id');
            $table->integer('book_id')->index('book_id');
            $table->string('url_portada', 100)->nullable();
            $table->string('numero_edicion', 10)->nullable();
            $table->string('url_pdf', 100)->nullable();
            $table->float('precio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};
