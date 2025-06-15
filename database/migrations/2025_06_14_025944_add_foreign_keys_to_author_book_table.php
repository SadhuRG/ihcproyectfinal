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
        Schema::table('author_book', function (Blueprint $table) {
            $table->foreign(['book_id'], 'author_book_ibfk_1')->references(['id'])->on('books')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['author_id'], 'author_book_ibfk_2')->references(['id'])->on('authors')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('author_book', function (Blueprint $table) {
            $table->dropForeign('author_book_ibfk_1');
            $table->dropForeign('author_book_ibfk_2');
        });
    }
};
