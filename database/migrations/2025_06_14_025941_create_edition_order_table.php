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
        Schema::create('edition_order', function (Blueprint $table) {
            $table->integer('edition_id');
            $table->integer('order_id')->index('order_id');
            $table->integer('cantidad')->nullable();

            $table->primary(['edition_id', 'order_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edition_order');
    }
};
