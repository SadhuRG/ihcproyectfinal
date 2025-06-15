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
        Schema::table('book_category', function (Blueprint $table) {
            $table->foreign(['book_id'], 'book_category_ibfk_1')->references(['id'])->on('books')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['category_id'], 'book_category_ibfk_2')->references(['id'])->on('categories')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_category', function (Blueprint $table) {
            $table->dropForeign('book_category_ibfk_1');
            $table->dropForeign('book_category_ibfk_2');
        });
    }
};
