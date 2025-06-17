<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Edition;
use App\Models\Editorial;

class VerificarEstructura extends Command
{
    protected $signature = 'verificar:estructura';
    protected $description = 'Verifica la estructura de tablas, datos y relaciones del sistema';

    public function handle()
    {
        $this->info("=== VERIFICANDO ESTRUCTURA ===");
        $this->line("Users table: " . (Schema::hasTable('users') ? '✅' : '❌'));
        $this->line("Books table: " . (Schema::hasTable('books') ? '✅' : '❌'));
        $this->line("Orders.address_id: " . (Schema::hasColumn('orders', 'address_id') ? '✅' : '❌'));

        $this->newLine();
        $this->info("=== VERIFICANDO DATOS ===");
        $this->line("Users count: " . User::count());
        $this->line("Books count: " . Book::count());
        $this->line("Authors count: " . Author::count());

        $this->newLine();
        $this->info("=== VERIFICANDO RELACIONES ===");

        try {
            $user = User::first();
            $this->line("User->addresses: " . ($user && $user->addresses->count() >= 0 ? '✅' : '❌'));
        } catch (\Exception $e) {
            $this->line("User->addresses: ❌ " . $e->getMessage());
        }

        try {
            $book = Book::first();
            $this->line("Book->authors: " . ($book && $book->authors->count() >= 0 ? '✅' : '❌'));
            $this->line("Book->categories: " . ($book && $book->categories->count() >= 0 ? '✅' : '❌'));
            $this->line("Book->editions: " . ($book && $book->editions->count() >= 0 ? '✅' : '❌'));
        } catch (\Exception $e) {
            $this->line("Book relations: ❌ " . $e->getMessage());
        }

        try {
            $edition = Edition::first();
            $this->line("Edition->book: " . ($edition && $edition->book ? '✅' : '❌'));
            $this->line("Edition->editorial: " . ($edition && $edition->editorial ? '✅' : '❌'));
            $this->line("Edition->inventory: " . ($edition && $edition->inventory ? '✅' : '❌'));
        } catch (\Exception $e) {
            $this->line("Edition relations: ❌ " . $e->getMessage());
        }

        try {
            $editorial = Editorial::first();
            $this->line("Editorial->editions: " . ($editorial && $editorial->editions->count() >= 0 ? '✅' : '❌'));
        } catch (\Exception $e) {
            $this->line("Editorial->editions: ❌ " . $e->getMessage());
        }

        $this->newLine();
        $this->info("=== TEST COMPLETO ===");
        try {
            $completeTest = Book::with(['authors', 'categories', 'editions.editorial'])->first();
            $this->line("Complex query: " . ($completeTest ? '✅' : '❌'));
        } catch (\Exception $e) {
            $this->line("Complex query: ❌ " . $e->getMessage());
        }

        $this->newLine();
        $this->info("=== RESULTADO FINAL ===");
        $this->line("Si ves solo ✅, ¡todas las relaciones funcionan perfectamente!");
        $this->line("Si ves ❌, hay que revisar esa relación específica.");
    }
}
