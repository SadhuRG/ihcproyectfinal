<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamamos al seeder de roles y usuarios que ya tenías
        $this->call(RolesAndUsersSeeder::class);

        // Llamamos a los seeders en orden correcto (IMPORTANTE: el orden importa!)
        $this->call([
            ExtraUserSeeder::class,           // Más usuarios
            AddressSeeder::class,             // Direcciones (después de usuarios)
            AuthorSeeder::class,              // Autores
            EditorialSeeder::class,           // Editoriales
            CategorySeeder::class,            // Categorías
            BookSeeder::class,                // Libros (con relaciones autor/categoria)
            EditionSeeder::class,             // Ediciones (después de libros/editoriales)
            PaymentTypeSeeder::class,         // Tipos de pago
            ShipmentTypeSeeder::class,        // Tipos de envío
            OrderSeeder::class,               // Órdenes de los últimos 7 días
            RealisticOrderSeeder::class,      // Órdenes realistas desde abril 2025
            PromotionSeeder::class,           // Promociones (opcional)
        ]);
    }
}
