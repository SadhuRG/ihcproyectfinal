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

        // Crear usuario superadministrador
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@admin.com'],
            [
                'name' => 'Super Admin',
                'apellido' => 'Principal',
                'password' => Hash::make('password123'),
                'telefono' => '987654321',
                'fecha_n' => '1990-01-15',
                'url_foto' => null,
            ]
        );
        $superAdmin->assignRole('superadministrador');

        // Crear usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'apellido' => 'Secundario',
                'password' => Hash::make('password123'),
                'telefono' => '987654322',
                'fecha_n' => '1985-05-20',
                'url_foto' => null,
            ]
        );
        $admin->assignRole('administrador');

        // Crear usuario colaborador
        $colaborador = User::firstOrCreate(
            ['email' => 'colaborador@admin.com'],
            [
                'name' => 'Juan Carlos',
                'apellido' => 'Colaborador',
                'password' => Hash::make('password123'),
                'telefono' => '987654323',
                'fecha_n' => '1992-08-10',
                'url_foto' => null,
            ]
        );
        $colaborador->assignRole('colaborador');

        // Crear usuario normal
        $usuario = User::firstOrCreate(
            ['email' => 'usuario@test.com'],
            [
                'name' => 'María Elena',
                'apellido' => 'Usuario',
                'password' => Hash::make('password123'),
                'telefono' => '987654324',
                'fecha_n' => '1995-12-03',
                'url_foto' => null,
            ]
        );
        $usuario->assignRole('usuario');
    }
}
