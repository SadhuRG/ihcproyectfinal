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
        Schema::table('category_promotion', function (Blueprint $table) {
            $table->foreign(['category_id'], 'category_promotion_ibfk_1')->references(['id'])->on('categories')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['promotion_id'], 'category_promotion_ibfk_2')->references(['id'])->on('promotions')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_promotion', function (Blueprint $table) {
            $table->dropForeign('category_promotion_ibfk_1');
            $table->dropForeign('category_promotion_ibfk_2');
        });
    }
};
