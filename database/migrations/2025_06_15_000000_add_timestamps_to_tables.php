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
        // Tablas principales
        Schema::table('books', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('editorials', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('editions', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('payment_types', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('shipment_types', function (Blueprint $table) {
            $table->timestamps();
        });

        // Tablas pivot y de relación
        Schema::table('book_user_coment', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('book_user_favorite', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('book_category', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('author_book', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('edition_order', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('edition_promotion', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('category_promotion', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tablas principales
        Schema::table('books', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('editorials', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('editions', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('payment_types', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('shipment_types', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        // Tablas pivot y de relación
        Schema::table('book_user_coment', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('book_user_favorite', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('book_category', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('author_book', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('edition_order', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('edition_promotion', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('category_promotion', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}; 