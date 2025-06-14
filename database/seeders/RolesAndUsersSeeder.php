<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RolesAndUsersSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $roles = ['superadministrador', 'administrador', 'colaborador', 'usuario'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear un usuario y asignar rol
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin Principal',
                'password' => Hash::make('password123'), // Cámbialo en producción
            ]
        );

        $admin->assignRole('administrador');
    }
}
