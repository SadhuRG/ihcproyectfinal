<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ExtraUserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['administrador', 'colaborador', 'usuario'];

        // Datos de ejemplo más realistas
        $usuariosData = [
            [
                'name' => 'Ana Lucía',
                'apellido' => 'Martínez Torres',
                'email' => 'ana.lucia@example.com',
                'telefono' => '987654321',
                'fecha_n' => '1995-03-22',
                'rol' => 'administrador'
            ],
            [
                'name' => 'Carlos Alberto',
                'apellido' => 'Vargas Quispe',
                'email' => 'carlos.vargas@mail.net',
                'telefono' => '912345678',
                'fecha_n' => '1988-11-05',
                'rol' => 'colaborador'
            ],
            [
                'name' => 'Sofía Valentina',
                'apellido' => 'Gómez Paredes',
                'email' => 'sofia.gomez@test.org',
                'telefono' => '999888777',
                'fecha_n' => '2000-07-19',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Luis Miguel',
                'apellido' => 'Díaz Castillo',
                'email' => 'luis.diaz@example.com',
                'telefono' => '977666555',
                'fecha_n' => '1992-09-10',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Gabriela Nicole',
                'apellido' => 'Flores Mendoza',
                'email' => 'gabi.nicole@company.com',
                'telefono' => '966555444',
                'fecha_n' => '1998-04-01',
                'rol' => 'colaborador'
            ],
            [
                'name' => 'Diego Armando',
                'apellido' => 'Sánchez Roca',
                'email' => 'diego.sanchez@web.dev',
                'telefono' => '955444333',
                'fecha_n' => '1985-12-25',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Valeria Jimena',
                'apellido' => 'Ruiz Fernández',
                'email' => 'valeria.j@example.net',
                'telefono' => '944333222',
                'fecha_n' => '2001-06-12',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Martín Eduardo',
                'apellido' => 'Chávez Luna',
                'email' => 'martin.ch@mail.com',
                'telefono' => '933222111',
                'fecha_n' => '1979-02-28',
                'rol' => 'administrador'
            ],
            [
                'name' => 'Camila Andrea',
                'apellido' => 'Torres Silva',
                'email' => 'camila.andrea@example.org',
                'telefono' => '922111000',
                'fecha_n' => '1996-10-30',
                'rol' => 'colaborador'
            ],
            [
                'name' => 'Elena Sofía',
                'apellido' => 'Ramírez Vargas',
                'email' => 'elena.ramirez@email.co',
                'telefono' => '938475621',
                'fecha_n' => '1993-08-05',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Javier Alejandro',
                'apellido' => 'Mendoza Castro',
                'email' => 'javi.mendoza@example.org',
                'telefono' => '927364510',
                'fecha_n' => '1987-05-17',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Isabella Victoria',
                'apellido' => 'Ortega Guzmán',
                'email' => 'isabella.v@webmail.com',
                'telefono' => '916253498',
                'fecha_n' => '2002-12-01',
                'rol' => 'colaborador'
            ],
            [
                'name' => 'Mateo Benjamin',
                'apellido' => 'Soto Rojas',
                'email' => 'mateo.soto@inbox.net',
                'telefono' => '905142387',
                'fecha_n' => '1980-03-10',
                'rol' => 'administrador'
            ],
            [
                'name' => 'Luciana Camila',
                'apellido' => 'Herrera Ríos',
                'email' => 'luciana.h@mymail.dev',
                'telefono' => '994031276',
                'fecha_n' => '1999-06-25',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Daniel Felipe',
                'apellido' => 'Aguilar Ponce',
                'email' => 'd.aguilar@fastmail.com',
                'telefono' => '983920165',
                'fecha_n' => '1991-11-11',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Emilia Renata',
                'apellido' => 'Jiménez Morales',
                'email' => 'emilia.renata@mailservice.org',
                'telefono' => '972819054',
                'fecha_n' => '1997-01-30',
                'rol' => 'colaborador'
            ],
            [
                'name' => 'Nicolás Andrés',
                'apellido' => 'Vásquez Medina',
                'email' => 'nico.andres@securemail.net',
                'telefono' => '961708943',
                'fecha_n' => '1984-09-03',
                'rol' => 'usuario'
            ],
            [
                'name' => 'Catalina Paz',
                'apellido' => 'Núñez Paredes',
                'email' => 'catalina.paz@proemail.com',
                'telefono' => '950697832',
                'fecha_n' => '1975-07-14',
                'rol' => 'administrador'
            ],
            [
                'name' => 'Leonardo David',
                'apellido' => 'Benítez Salazar',
                'email' => 'leo.david@newmail.com',
                'telefono' => '949586721',
                'fecha_n' => '2003-02-18',
                'rol' => 'usuario'
            ]
        ];

        foreach ($usuariosData as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'apellido' => $userData['apellido'],
                'email' => $userData['email'],
                'password' => Hash::make('password123'), // Contraseña por defecto
                'telefono' => $userData['telefono'],
                'fecha_n' => $userData['fecha_n'],
                'url_foto' => null,
            ]);

            // Asignar rol
            $user->assignRole($userData['rol']);
        }
    }
}
