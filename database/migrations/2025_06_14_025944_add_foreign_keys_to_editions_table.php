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
        Schema::table('editions', function (Blueprint $table) {
            $table->foreign(['book_id'], 'editions_ibfk_1')->references(['id'])->on('books')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['inventorie_id'], 'editions_ibfk_2')->references(['id'])->on('inventories')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['editorial_id'], 'editions_ibfk_3')->references(['id'])->on('editorials')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('editions', function (Blueprint $table) {
            $table->dropForeign('editions_ibfk_1');
            $table->dropForeign('editions_ibfk_2');
            $table->dropForeign('editions_ibfk_3');
        });
    }
};
