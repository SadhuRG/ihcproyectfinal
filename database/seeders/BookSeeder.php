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

        // Libros reales con sus datos
        $books = [
            [
                'titulo' => 'Cien años de soledad',
                'ISBN' => '9788497592208',
                'descripcion' => 'La obra maestra de Gabriel García Márquez que narra la historia de la familia Buendía a lo largo de siete generaciones en el pueblo ficticio de Macondo.',
                'author_names' => ['Gabriel García Márquez'],
                'categories' => ['Literatura Contemporánea', 'Novela Histórica'],
                'created_at' => '1967-06-05'
            ],
            [
                'titulo' => 'El amor en los tiempos del cólera',
                'ISBN' => '9788497592215',
                'descripcion' => 'Una historia de amor que dura más de cincuenta años, desde la juventud hasta la vejez de los protagonistas.',
                'author_names' => ['Gabriel García Márquez'],
                'categories' => ['Literatura Contemporánea', 'Romance'],
                'created_at' => '1985-03-12'
            ],
            [
                'titulo' => 'La casa de los espíritus',
                'ISBN' => '9788497592222',
                'descripcion' => 'La primera novela de Isabel Allende que narra la saga familiar de los Trueba a lo largo de cuatro generaciones.',
                'author_names' => ['Isabel Allende'],
                'categories' => ['Literatura Contemporánea', 'Fantasía'],
                'created_at' => '1982-01-15'
            ],
            [
                'titulo' => 'Harry Potter y la piedra filosofal',
                'ISBN' => '9788478884452',
                'descripcion' => 'El primer libro de la saga que introduce al joven mago Harry Potter y su entrada al mundo mágico.',
                'author_names' => ['J.K. Rowling'],
                'categories' => ['Fantasía', 'Infantil y Juvenil'],
                'created_at' => '1997-06-26'
            ],
            [
                'titulo' => 'Harry Potter y la cámara secreta',
                'ISBN' => '9788478884957',
                'descripcion' => 'Segunda entrega de la saga donde Harry regresa a Hogwarts para enfrentar nuevos misterios.',
                'author_names' => ['J.K. Rowling'],
                'categories' => ['Fantasía', 'Infantil y Juvenil'],
                'created_at' => '1998-07-02'
            ],
            [
                'titulo' => 'El señor de los anillos: La comunidad del anillo',
                'ISBN' => '9788445071405',
                'descripcion' => 'Primera parte de la épica trilogía de Tolkien sobre la búsqueda para destruir el Anillo Único.',
                'author_names' => ['J.R.R. Tolkien'],
                'categories' => ['Fantasía', 'Literatura Contemporánea'],
                'created_at' => '1954-07-29'
            ],
            [
                'titulo' => 'El código Da Vinci',
                'ISBN' => '9788497592239',
                'descripcion' => 'Un thriller que combina arte, religión y misterio en una trama llena de secretos y conspiraciones.',
                'author_names' => ['Dan Brown'],
                'categories' => ['Misterio y Suspense', 'Novela Histórica'],
                'created_at' => '2003-03-18'
            ],
            [
                'titulo' => 'El alquimista',
                'ISBN' => '9788497592246',
                'descripcion' => 'Una novela filosófica que narra el viaje de un joven pastor en busca de su tesoro personal.',
                'author_names' => ['Paulo Coelho'],
                'categories' => ['Literatura Contemporánea', 'Desarrollo Personal'],
                'created_at' => '1988-01-01'
            ],
            [
                'titulo' => 'Sapiens: De animales a dioses',
                'ISBN' => '9788499926223',
                'descripcion' => 'Una breve historia de la humanidad que explora cómo los humanos llegaron a dominar el planeta.',
                'author_names' => ['Yuval Noah Harari'],
                'categories' => ['Historia', 'Ciencias Sociales'],
                'created_at' => '2011-01-01'
            ],
            [
                'titulo' => 'Homo Deus: Breve historia del mañana',
                'ISBN' => '9788499926230',
                'descripcion' => 'Una exploración del futuro de la humanidad y los desafíos que enfrentaremos en el siglo XXI.',
                'author_names' => ['Yuval Noah Harari'],
                'categories' => ['Historia', 'Ciencias Sociales'],
                'created_at' => '2015-01-01'
            ],
            [
                'titulo' => 'El poder de los introvertidos',
                'ISBN' => '9788497592253',
                'descripcion' => 'Un análisis de cómo los introvertidos pueden prosperar en un mundo que parece valorar solo la extroversión.',
                'author_names' => ['Susan Cain'],
                'categories' => ['Psicología', 'Desarrollo Personal'],
                'created_at' => '2012-01-24'
            ],
            [
                'titulo' => 'Padre Rico, Padre Pobre',
                'ISBN' => '9788497592260',
                'descripcion' => 'Un libro sobre educación financiera que contrasta las mentalidades de dos padres diferentes.',
                'author_names' => ['Robert Kiyosaki'],
                'categories' => ['Negocios y Economía', 'Desarrollo Personal'],
                'created_at' => '1997-01-01'
            ],
            [
                'titulo' => 'Cómo ganar amigos e influir sobre las personas',
                'ISBN' => '9788497592277',
                'descripcion' => 'Un clásico sobre las habilidades sociales y la comunicación efectiva.',
                'author_names' => ['Dale Carnegie'],
                'categories' => ['Desarrollo Personal', 'Negocios y Economía'],
                'created_at' => '1936-01-01'
            ],
            [
                'titulo' => 'Piense y hágase rico',
                'ISBN' => '9788497592284',
                'descripcion' => 'Un libro sobre los principios del éxito basado en el estudio de personas exitosas.',
                'author_names' => ['Napoleon Hill'],
                'categories' => ['Desarrollo Personal', 'Negocios y Economía'],
                'created_at' => '1937-01-01'
            ],
            [
                'titulo' => 'El arte de la guerra',
                'ISBN' => '9788497592291',
                'descripcion' => 'Un tratado militar chino que se ha convertido en referencia para estrategias de negocios.',
                'author_names' => ['Sun Tzu'],
                'categories' => ['Negocios y Economía', 'Filosofía'],
                'created_at' => '-0500-01-01'
            ],
            [
                'titulo' => '1984',
                'ISBN' => '9788497592307',
                'descripcion' => 'Una distopía que describe una sociedad totalitaria bajo constante vigilancia.',
                'author_names' => ['George Orwell'],
                'categories' => ['Ciencia Ficción', 'Literatura Contemporánea'],
                'created_at' => '1949-06-08'
            ],
            [
                'titulo' => 'Un mundo feliz',
                'ISBN' => '9788497592314',
                'descripcion' => 'Una novela distópica que critica la sociedad industrial y el control social.',
                'author_names' => ['Aldous Huxley'],
                'categories' => ['Ciencia Ficción', 'Literatura Contemporánea'],
                'created_at' => '1932-01-01'
            ],
            [
                'titulo' => 'El principito',
                'ISBN' => '9788497592321',
                'descripcion' => 'Una fábula poética sobre la amistad, el amor y el sentido de la vida.',
                'author_names' => ['Antoine de Saint-Exupéry'],
                'categories' => ['Literatura Contemporánea', 'Infantil y Juvenil'],
                'created_at' => '1943-04-06'
            ],
            [
                'titulo' => 'El retrato de Dorian Gray',
                'ISBN' => '9788497592338',
                'descripcion' => 'Una novela gótica que explora temas de belleza, moralidad y la naturaleza del arte.',
                'author_names' => ['Oscar Wilde'],
                'categories' => ['Literatura Contemporánea', 'Misterio y Suspense'],
                'created_at' => '1890-07-20'
            ],
            [
                'titulo' => 'Crimen y castigo',
                'ISBN' => '9788497592345',
                'descripcion' => 'Una novela psicológica que explora la culpa y la redención a través de un estudiante que comete un crimen.',
                'author_names' => ['Fiódor Dostoyevski'],
                'categories' => ['Literatura Contemporánea', 'Psicología'],
                'created_at' => '1866-01-01'
            ],
            [
                'titulo' => 'Los miserables',
                'ISBN' => '9788497592352',
                'descripcion' => 'Una epopeya que narra la vida de Jean Valjean y su búsqueda de redención en la Francia del siglo XIX.',
                'author_names' => ['Victor Hugo'],
                'categories' => ['Literatura Contemporánea', 'Novela Histórica'],
                'created_at' => '1862-01-01'
            ],
            [
                'titulo' => 'Don Quijote de la Mancha',
                'ISBN' => '9788497592369',
                'descripcion' => 'La obra maestra de Cervantes que narra las aventuras de un hidalgo que enloquece leyendo libros de caballerías.',
                'author_names' => ['Miguel de Cervantes'],
                'categories' => ['Literatura Contemporánea', 'Novela Histórica'],
                'created_at' => '1605-01-16'
            ],
            [
                'titulo' => 'Rayuela',
                'ISBN' => '9788497592376',
                'descripcion' => 'Una novela experimental que puede leerse en múltiples órdenes, explorando la condición humana.',
                'author_names' => ['Julio Cortázar'],
                'categories' => ['Literatura Contemporánea', 'Ensayo'],
                'created_at' => '1963-06-28'
            ],
            [
                'titulo' => 'Ficciones',
                'ISBN' => '9788497592383',
                'descripcion' => 'Una colección de cuentos que exploran temas de realidad, tiempo y literatura.',
                'author_names' => ['Jorge Luis Borges'],
                'categories' => ['Literatura Contemporánea', 'Filosofía'],
                'created_at' => '1944-01-01'
            ],
            [
                'titulo' => 'Veinte poemas de amor y una canción desesperada',
                'ISBN' => '9788497592390',
                'descripcion' => 'Una de las obras más importantes de Pablo Neruda, explorando el amor y la pasión.',
                'author_names' => ['Pablo Neruda'],
                'categories' => ['Poesía', 'Literatura Contemporánea'],
                'created_at' => '1924-01-01'
            ],
            [
                'titulo' => 'Como agua para chocolate',
                'ISBN' => '9788497592406',
                'descripcion' => 'Una novela que combina realismo mágico con recetas de cocina en una historia de amor prohibido.',
                'author_names' => ['Laura Esquivel'],
                'categories' => ['Literatura Contemporánea', 'Romance'],
                'created_at' => '1989-01-01'
            ]
        ];

        // Calcular fechas recientes para los libros (entre 2000 y hoy, manteniendo el orden)
        $startYear = 2000;
        $totalBooks = count($books);
        $yearsRange = (int)date('Y') - $startYear;
        foreach ($books as $i => &$bookData) {
            $year = $startYear + (int)round(($i / max(1, $totalBooks - 1)) * $yearsRange);
            $bookData['created_at'] = Carbon::create($year, rand(1, 12), rand(1, 28), rand(8, 18), rand(0, 59), rand(0, 59))->format('Y-m-d H:i:s');
        }
        unset($bookData);

        foreach ($books as $bookData) {
            // Buscar autores por nombre completo
            $authorIds = [];
            foreach ($bookData['author_names'] as $authorName) {
                $nameParts = explode(' ', $authorName);
                $firstName = $nameParts[0];
                $lastName = end($nameParts);
                
                $author = $authors->where('nombre', $firstName)
                    ->where('apellido', $lastName)
                    ->first();
                
                if ($author) {
                    $authorIds[] = $author->id;
                }
            }

            // Si no encontramos el autor, usar uno aleatorio
            if (empty($authorIds)) {
                $authorIds = [$authors->random()->id];
            }

            // Formatear la fecha correctamente
            $createdAt = Carbon::parse($bookData['created_at'])->format('Y-m-d H:i:s');

            // Crear el libro
            $book = Book::create([
                'titulo' => $bookData['titulo'],
                'ISBN' => $bookData['ISBN'],
                'descripcion' => $bookData['descripcion'],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Asignar categorías
            foreach ($bookData['categories'] as $categoryName) {
                $category = $categories->where('nombre', $categoryName)->first();
                if ($category) {
                    $book->categories()->attach($category->id, [
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);
                }
            }

            // Asignar autores
            foreach ($authorIds as $authorId) {
                $book->authors()->attach($authorId, [
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Asignar usuarios favoritos (fechas más recientes)
            $favoriteUsers = $users->random(rand(1, 5));
            foreach ($favoriteUsers as $user) {
                $favoriteDate = Carbon::now()->subDays(rand(0, 365));
                $book->favoriteUsers()->attach($user->id, [
                    'created_at' => $favoriteDate,
                    'updated_at' => $favoriteDate,
                ]);
            }

            // Crear comentarios de usuarios
            foreach ($users->random(rand(1, 3)) as $user) {
                $commentDate = Carbon::now()->subDays(rand(0, 180));
                DB::table('book_user_coment')->insert([
                    'book_id' => $book->id,
                    'user_id' => $user->id,
                    'puntuacion' => rand(3, 5), // Los libros reales suelen tener buenas puntuaciones
                    'comentario' => $this->getRealisticComment($bookData['titulo']),
                    'fecha_valoracion' => $commentDate->format('Y-m-d'),
                    'created_at' => $commentDate,
                    'updated_at' => $commentDate,
                ]);
            }
        }
    }

    private function getRealisticComment($bookTitle): string
    {
        $comments = [
            "Excelente libro, muy recomendado.",
            "Una obra maestra de la literatura.",
            "Muy bien escrito y entretenido.",
            "Un clásico que no decepciona.",
            "Lectura obligatoria para cualquier amante de los libros.",
            "Profundo y conmovedor.",
            "Una historia que te atrapa desde el primer capítulo.",
            "Muy bien estructurado y con personajes memorables.",
            "Un libro que te hace reflexionar.",
            "Simplemente maravilloso.",
            "Una lectura que no puedes dejar.",
            "Muy original y creativo.",
            "Un libro que te cambia la perspectiva.",
            "Muy bien documentado y realista.",
            "Una obra que trasciende el tiempo."
        ];

        return $comments[array_rand($comments)];
    }
}
