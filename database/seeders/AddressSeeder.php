<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Crear 1-3 direcciones por usuario
            $numAddresses = rand(1, 3);

            for ($i = 0; $i < $numAddresses; $i++) {
                // Fecha de creación de la dirección (después del registro del usuario)
                $userCreatedAt = Carbon::parse($user->created_at);
                $addressCreatedAt = $userCreatedAt->addDays(rand(1, 30));
                
                Address::create([
                    'user_id' => $user->id,
                    'calle' => fake()->streetName(),
                    'numero_piso' => rand(1, 10),
                    'numero_departamento' => rand(100, 999) . fake()->randomLetter(),
                    'distrito' => fake()->city(),
                    'provincia' => fake()->state(),
                    'departamento' => fake()->state(),
                    'referencia' => 'Cerca de ' . fake()->company(),
                    'created_at' => $addressCreatedAt,
                    'updated_at' => $addressCreatedAt,
                ]);
            }
        }
    }
}
