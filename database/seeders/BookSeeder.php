<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $authors = Author::all();
        $users = User::all();

        for ($i = 0; $i < 15; $i++) {
            $book = Book::create([
                'titulo' => fake()->sentence(3),
                'ISBN' => fake()->isbn13(),
                'descripcion' => fake()->text(80),
            ]);

            // Asignar entre 1 y 3 categorías aleatorias
            $book->categories()->attach($categories->random(rand(1, 3))->pluck('id'));

            // Asignar entre 1 y 2 autores aleatorios
            $book->authors()->attach($authors->random(rand(1, 2))->pluck('id'));

            // Asignar entre 1 y 3 usuarios favoritos
            $book->favoriteUsers()->attach($users->random(rand(1, 3))->pluck('id'));

            // Crear entre 1 y 2 comentarios de usuarios
            foreach ($users->random(rand(1, 2)) as $user) {
                DB::table('book_user_coment')->insert([
                    'book_id' => $book->id,
                    'user_id' => $user->id,
                    'puntuacion' => rand(1, 5),
                    'comentario' => fake()->sentence(),
                    'fecha_valoracion' => now(),
                ]);
            }
        }
    }
}
