<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $authors = Author::all();
        $users = User::all();

        for ($i = 0; $i < 15; $i++) {
            // Fecha de creación del libro (últimos 2 años)
            $bookCreatedAt = Carbon::now()->subDays(rand(0, 730));
            
            $book = Book::create([
                'titulo' => fake()->sentence(3),
                'ISBN' => fake()->isbn13(),
                'descripcion' => fake()->text(80),
                'created_at' => $bookCreatedAt,
                'updated_at' => $bookCreatedAt,
            ]);

            // Asignar entre 1 y 3 categorías aleatorias
            $book->categories()->attach($categories->random(rand(1, 3))->pluck('id'), [
                'created_at' => $bookCreatedAt,
                'updated_at' => $bookCreatedAt,
            ]);

            // Asignar entre 1 y 2 autores aleatorios
            $book->authors()->attach($authors->random(rand(1, 2))->pluck('id'), [
                'created_at' => $bookCreatedAt,
                'updated_at' => $bookCreatedAt,
            ]);

            // Asignar entre 1 y 3 usuarios favoritos (fechas más recientes)
            $favoriteUsers = $users->random(rand(1, 3));
            foreach ($favoriteUsers as $user) {
                $favoriteDate = Carbon::now()->subDays(rand(0, 30));
                $book->favoriteUsers()->attach($user->id, [
                    'created_at' => $favoriteDate,
                    'updated_at' => $favoriteDate,
                ]);
            }

            // Crear entre 1 y 2 comentarios de usuarios (fechas más recientes)
            foreach ($users->random(rand(1, 2)) as $user) {
                $commentDate = Carbon::now()->subDays(rand(0, 60));
                DB::table('book_user_coment')->insert([
                    'book_id' => $book->id,
                    'user_id' => $user->id,
                    'puntuacion' => rand(1, 5),
                    'comentario' => fake()->sentence(),
                    'fecha_valoracion' => $commentDate->format('Y-m-d'),
                    'created_at' => $commentDate,
                    'updated_at' => $commentDate,
                ]);
            }
        }
    }
}
