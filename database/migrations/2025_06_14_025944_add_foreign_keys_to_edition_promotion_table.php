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
        Schema::table('edition_promotion', function (Blueprint $table) {
            $table->foreign(['edition_id'], 'edition_promotion_ibfk_1')->references(['id'])->on('editions')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['promotion_id'], 'edition_promotion_ibfk_2')->references(['id'])->on('promotions')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('edition_promotion', function (Blueprint $table) {
            $table->dropForeign('edition_promotion_ibfk_1');
            $table->dropForeign('edition_promotion_ibfk_2');
        });
    }
};
