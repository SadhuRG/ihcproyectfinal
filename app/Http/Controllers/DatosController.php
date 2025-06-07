<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatosController extends Controller
{
    // Array de usuarios (expandido a 20)
    public $usuarios = [
        ['id' => 1, 'nombre' => 'Juan Mateo', 'apellido' => 'Gonzales Perez', 'email' => 'juan@example.com', 'rol' => 'administrador',  'fecha_registro' => '2024-07-15', 'fecha_nacimiento' => '2024-01-15', 'telefono' => '948766589', 'direccion' => 'Av.Napoles 255', 'dni' => '72763429'],
        ['id' => 2, 'nombre' => 'Ana Lucía', 'apellido' => 'Martínez Torres', 'email' => 'ana.lucia@example.com', 'rol' => 'editor', 'fecha_registro' => '2023-05-10', 'fecha_nacimiento' => '1995-03-22', 'telefono' => '987654321', 'direccion' => 'Calle Los Robles 123', 'dni' => '45678901'],
        ['id' => 3, 'nombre' => 'Carlos Alberto', 'apellido' => 'Vargas Quispe', 'email' => 'carlos.vargas@mail.net', 'rol' => 'usuario', 'fecha_registro' => '2024-01-20', 'fecha_nacimiento' => '1988-11-05', 'telefono' => '912345678', 'direccion' => 'Jr. Las Palmeras 789', 'dni' => '12345678'],
        ['id' => 4, 'nombre' => 'Sofía Valentina', 'apellido' => 'Gómez Paredes', 'email' => 'sofia.gomez@test.org', 'rol' => 'administrador', 'fecha_registro' => '2022-11-01', 'fecha_nacimiento' => '2000-07-19', 'telefono' => '999888777', 'direccion' => 'Av. El Sol 456', 'dni' => '87654321'],
        ['id' => 5, 'nombre' => 'Luis Miguel', 'apellido' => 'Díaz Castillo', 'email' => 'luis.diaz@example.com', 'rol' => 'invitado', 'fecha_registro' => '2024-06-30', 'fecha_nacimiento' => '1992-09-10', 'telefono' => '977666555', 'direccion' => 'Psje. Los Girasoles 101', 'dni' => '23456789'],
        ['id' => 6, 'nombre' => 'Gabriela Nicole', 'apellido' => 'Flores Mendoza', 'email' => 'gabi.nicole@company.com', 'rol' => 'editor', 'fecha_registro' => '2023-09-15', 'fecha_nacimiento' => '1998-04-01', 'telefono' => '966555444', 'direccion' => 'Urb. Santa María Mz. A Lt. 5', 'dni' => '34567890'],
        ['id' => 7, 'nombre' => 'Diego Armando', 'apellido' => 'Sánchez Roca', 'email' => 'diego.sanchez@web.dev', 'rol' => 'usuario', 'fecha_registro' => '2024-03-05', 'fecha_nacimiento' => '1985-12-25', 'telefono' => '955444333', 'direccion' => 'Av. Principal 2020', 'dni' => '45678901'],
        ['id' => 8, 'nombre' => 'Valeria Jimena', 'apellido' => 'Ruiz Fernández', 'email' => 'valeria.j@example.net', 'rol' => 'usuario', 'fecha_registro' => '2023-02-18', 'fecha_nacimiento' => '2001-06-12', 'telefono' => '944333222', 'direccion' => 'Calle Las Begonias 303', 'dni' => '56789012'],
        ['id' => 9, 'nombre' => 'Martín Eduardo', 'apellido' => 'Chávez Luna', 'email' => 'martin.ch@mail.com', 'rol' => 'administrador', 'fecha_registro' => '2021-10-08', 'fecha_nacimiento' => '1979-02-28', 'telefono' => '933222111', 'direccion' => 'Jr. Los Pinos 505', 'dni' => '67890123'],
        ['id' => 10, 'nombre' => 'Camila Andrea', 'apellido' => 'Torres Silva', 'email' => 'camila.andrea@example.org', 'rol' => 'editor', 'fecha_registro' => '2024-07-01', 'fecha_nacimiento' => '1996-10-30', 'telefono' => '922111000', 'direccion' => 'Av. La Marina 707', 'dni' => '78901234'],
        ['id' => 11, 'nombre' => 'Elena Sofia', 'apellido' => 'Ramirez Vargas', 'email' => 'elena.ramirez@email.co', 'rol' => 'moderador', 'fecha_registro' => '2023-01-12', 'fecha_nacimiento' => '1993-08-05', 'telefono' => '938475621', 'direccion' => 'Calle Las Acacias 450', 'dni' => '29384756'],
        ['id' => 12, 'nombre' => 'Javier Alejandro', 'apellido' => 'Mendoza Castro', 'email' => 'javi.mendoza@example.org', 'rol' => 'usuario', 'fecha_registro' => '2024-02-28', 'fecha_nacimiento' => '1987-05-17', 'telefono' => '927364510', 'direccion' => 'Av. Los Laureles 782', 'dni' => '18273645'],
        ['id' => 13, 'nombre' => 'Isabella Victoria', 'apellido' => 'Ortega Guzman', 'email' => 'isabella.v@webmail.com', 'rol' => 'editor', 'fecha_registro' => '2022-09-05', 'fecha_nacimiento' => '2002-12-01', 'telefono' => '916253498', 'direccion' => 'Jr. Las Orquideas 111', 'dni' => '81726354'],
        ['id' => 14, 'nombre' => 'Mateo Benjamin', 'apellido' => 'Soto Rojas', 'email' => 'mateo.soto@inbox.net', 'rol' => 'administrador', 'fecha_registro' => '2021-07-20', 'fecha_nacimiento' => '1980-03-10', 'telefono' => '905142387', 'direccion' => 'Psje. Los Jazmines 22B', 'dni' => '70615243'],
        ['id' => 15, 'nombre' => 'Luciana Camila', 'apellido' => 'Herrera Rios', 'email' => 'luciana.h@mymail.dev', 'rol' => 'invitado', 'fecha_registro' => '2024-05-19', 'fecha_nacimiento' => '1999-06-25', 'telefono' => '994031276', 'direccion' => 'Urb. Villa Hermosa C-5', 'dni' => '69504132'],
        ['id' => 16, 'nombre' => 'Daniel Felipe', 'apellido' => 'Aguilar Ponce', 'email' => 'd.aguilar@fastmail.com', 'rol' => 'usuario', 'fecha_registro' => '2023-11-30', 'fecha_nacimiento' => '1991-11-11', 'telefono' => '983920165', 'direccion' => 'Av. El Ejercito 903', 'dni' => '58493021'],
        ['id' => 17, 'nombre' => 'Emilia Renata', 'apellido' => 'Jimenez Morales', 'email' => 'emilia.renata@mailservice.org', 'rol' => 'editor', 'fecha_registro' => '2023-04-01', 'fecha_nacimiento' => '1997-01-30', 'telefono' => '972819054', 'direccion' => 'Calle San Martin 670', 'dni' => '47382910'],
        ['id' => 18, 'nombre' => 'Nicolas Andres', 'apellido' => 'Vasquez Medina', 'email' => 'nico.andres@securemail.net', 'rol' => 'moderador', 'fecha_registro' => '2022-06-15', 'fecha_nacimiento' => '1984-09-03', 'telefono' => '961708943', 'direccion' => 'Jr. Bolognesi 305A', 'dni' => '36271809'],
        ['id' => 19, 'nombre' => 'Catalina Paz', 'apellido' => 'Nuñez Paredes', 'email' => 'catalina.paz@proemail.com', 'rol' => 'administrador', 'fecha_registro' => '2020-12-01', 'fecha_nacimiento' => '1975-07-14', 'telefono' => '950697832', 'direccion' => 'Av. Progreso 1540', 'dni' => '25160798'],
        ['id' => 20, 'nombre' => 'Leonardo David', 'apellido' => 'Benitez Salazar', 'email' => 'leo.david@newmail.com', 'rol' => 'usuario', 'fecha_registro' => '2024-07-02', 'fecha_nacimiento' => '2003-02-18', 'telefono' => '949586721', 'direccion' => 'Calle Los Ficus 88', 'dni' => '14059687']
    ];

    // Array de códigos de certificados
    public $codigos = [
        ['id' => 1, 'codigo' => 'CERT-2024-001'],
        ['id' => 2, 'codigo' => 'CERT-2024-002'],
        ['id' => 3, 'codigo' => 'CERT-2024-003'],
        ['id' => 4, 'codigo' => 'CERT-2024-004'],
        ['id' => 5, 'codigo' => 'CERT-2024-005'],
        ['id' => 6, 'codigo' => 'CERT-2024-006'],
        ['id' => 7, 'codigo' => 'CERT-2024-007'],
        ['id' => 8, 'codigo' => 'CERT-2024-008'],
        ['id' => 9, 'codigo' => 'CERT-2024-009'],
        ['id' => 10, 'codigo' => 'CERT-2024-010'],
        ['id' => 11, 'codigo' => 'CERT-2024-011'],
        ['id' => 12, 'codigo' => 'CERT-2024-012'],
        ['id' => 13, 'codigo' => 'CERT-2024-013'],
        ['id' => 14, 'codigo' => 'CERT-2024-014'],
        ['id' => 15, 'codigo' => 'CERT-2024-015'],
        ['id' => 16, 'codigo' => 'CERT-2024-016'],
        ['id' => 17, 'codigo' => 'CERT-2024-017'],
        ['id' => 18, 'codigo' => 'CERT-2024-018'],
        ['id' => 19, 'codigo' => 'CERT-2024-019'],
        ['id' => 20, 'codigo' => 'CERT-2024-020'],
    ];

    // Array de grupos de certificación
    public $grupos_certificacion = [
        ['id' => 1, 'nombre' => 'Grupo de Certificación PMI 2024-I', 'tipo' => 'Certificado de voluntariado', 'descripcion' => 'Certificado de voluntariado para Enero 2024', 'fechainicio' => '2024-01-01', 'fechafin' => '2024-01-31', 'creadorgrupo' => 'Luis Perez', 'generadorcertificado' => 'Maria Lopez', 'firmante1' => 'Luis Perez', 'firmante2' => 'Lucia Gomez', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/voluntariado.png'],
        ['id' => 2, 'nombre' => 'Grupo de Certificación SCRUM 2024-I', 'tipo' => 'Certificado de metodología', 'descripcion' => 'Certificación en Scrum para el primer semestre 2024', 'fechainicio' => '2024-02-01', 'fechafin' => '2024-03-15', 'creadorgrupo' => 'Ana Martinez', 'generadorcertificado' => 'Carlos Rodríguez', 'firmante1' => 'Ana Martinez', 'firmante2' => 'Jorge Peña', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/scrum.png'],
        ['id' => 3, 'nombre' => 'Grupo de Certificación AGILE 2024-I', 'tipo' => 'Certificado de metodología', 'descripcion' => 'Certificación en metodologías ágiles', 'fechainicio' => '2024-03-01', 'fechafin' => '2024-04-30', 'creadorgrupo' => 'Pedro Sanchez', 'generadorcertificado' => 'Lucia Ramos', 'firmante1' => 'Pedro Sanchez', 'firmante2' => 'Sofia Nuñez', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/agile.png'],
        ['id' => 4, 'nombre' => 'Grupo de Certificación PRINCE2 2024-I', 'tipo' => 'Certificado de gestión de proyectos', 'descripcion' => 'Certificación en PRINCE2 para gestión de proyectos', 'fechainicio' => '2024-05-01', 'fechafin' => '2024-06-15', 'creadorgrupo' => 'Elena Vargas', 'generadorcertificado' => 'Antonio Herrera', 'firmante1' => 'Elena Vargas', 'firmante2' => 'Raul Diaz', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/prince2.png'],
        ['id' => 5, 'nombre' => 'Grupo de Certificación ITIL 2024-I', 'tipo' => 'Certificado de IT Service Management', 'descripcion' => 'Certificación en ITIL para la gestión de servicios TI', 'fechainicio' => '2024-06-01', 'fechafin' => '2024-07-15', 'creadorgrupo' => 'Laura Mendoza', 'generadorcertificado' => 'Ricardo Suarez', 'firmante1' => 'Laura Mendoza', 'firmante2' => 'Diego Torres', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/itil.png'],
        ['id' => 6, 'nombre' => 'Grupo de Certificación DevOps 2024-I', 'tipo' => 'Certificado de desarrollo y operaciones', 'descripcion' => 'Certificación en prácticas de DevOps', 'fechainicio' => '2024-07-01', 'fechafin' => '2024-08-15', 'creadorgrupo' => 'Roberto Ortega', 'generadorcertificado' => 'Sonia Herrera', 'firmante1' => 'Roberto Ortega', 'firmante2' => 'Carmen Ruiz', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/devops.png'],
        ['id' => 7, 'nombre' => 'Grupo de Certificación CISSP 2024-II', 'tipo' => 'Certificado de seguridad informática', 'descripcion' => 'Certificación en seguridad de la información CISSP', 'fechainicio' => '2024-08-01', 'fechafin' => '2024-09-30', 'creadorgrupo' => 'Juan Ramirez', 'generadorcertificado' => 'Beatriz Correa', 'firmante1' => 'Juan Ramirez', 'firmante2' => 'Hector Medina', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/cissp.png'],
        ['id' => 8, 'nombre' => 'Grupo de Certificación CCNA 2024-II', 'tipo' => 'Certificado de redes', 'descripcion' => 'Certificación Cisco CCNA en redes de comunicación', 'fechainicio' => '2024-09-01', 'fechafin' => '2024-10-15', 'creadorgrupo' => 'Silvia Mendoza', 'generadorcertificado' => 'Luis Campos', 'firmante1' => 'Silvia Mendoza', 'firmante2' => 'Hugo Paredes', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/ccna.png'],
        ['id' => 9, 'nombre' => 'Grupo de Certificación Python 2024-II', 'tipo' => 'Certificado de programación', 'descripcion' => 'Certificación en Python para desarrollo backend', 'fechainicio' => '2024-10-01', 'fechafin' => '2024-11-30', 'creadorgrupo' => 'Alberto Sandoval', 'generadorcertificado' => 'Mariana Castro', 'firmante1' => 'Alberto Sandoval', 'firmante2' => 'Fernando Pacheco', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/python.png'],
        ['id' => 10, 'nombre' => 'Grupo de Certificación Java 2024-II', 'tipo' => 'Certificado de programación', 'descripcion' => 'Certificación en desarrollo de aplicaciones Java', 'fechainicio' => '2024-11-01', 'fechafin' => '2024-12-15', 'creadorgrupo' => 'Erika Fernández', 'generadorcertificado' => 'Jose Luis Orozco', 'firmante1' => 'Erika Fernández', 'firmante2' => 'Daniela Herrera', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/java.png'],
        ['id' => 11, 'nombre' => 'Grupo de Certificación Red Hat 2024-II', 'tipo' => 'Certificado de administración de sistemas', 'descripcion' => 'Certificación en administración de servidores Red Hat', 'fechainicio' => '2024-11-01', 'fechafin' => '2024-12-15', 'creadorgrupo' => 'Miguel Rojas', 'generadorcertificado' => 'Sergio Medina', 'firmante1' => 'Miguel Rojas', 'firmante2' => 'Paula Gómez', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/redhat.png'],
        ['id' => 12, 'nombre' => 'Grupo de Certificación AWS 2024-II', 'tipo' => 'Certificado de computación en la nube', 'descripcion' => 'Certificación en soluciones de Amazon Web Services', 'fechainicio' => '2024-10-01', 'fechafin' => '2024-11-30', 'creadorgrupo' => 'Javier Ortega', 'generadorcertificado' => 'Clara Villanueva', 'firmante1' => 'Javier Ortega', 'firmante2' => 'Marina Estrada', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/aws.png'],
        ['id' => 13, 'nombre' => 'Grupo de Certificación Azure 2024-II', 'tipo' => 'Certificado de computación en la nube', 'descripcion' => 'Certificación en soluciones de Microsoft Azure', 'fechainicio' => '2024-09-01', 'fechafin' => '2024-10-15', 'creadorgrupo' => 'Fernando Paredes', 'generadorcertificado' => 'Carmen Torres', 'firmante1' => 'Fernando Paredes', 'firmante2' => 'Roberto Peña', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/azure.png'],
        ['id' => 14, 'nombre' => 'Grupo de Certificación CCNA 2024-II', 'tipo' => 'Certificado de redes', 'descripcion' => 'Certificación Cisco Certified Network Associate (CCNA)', 'fechainicio' => '2024-08-01', 'fechafin' => '2024-09-15', 'creadorgrupo' => 'Alberto Jiménez', 'generadorcertificado' => 'Sandra López', 'firmante1' => 'Alberto Jiménez', 'firmante2' => 'Luis Domínguez', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/ccna.png'],
        ['id' => 15, 'nombre' => 'Grupo de Certificación Python 2024-II', 'tipo' => 'Certificado de programación', 'descripcion' => 'Certificación en programación con Python', 'fechainicio' => '2024-07-01', 'fechafin' => '2024-08-30', 'creadorgrupo' => 'Sofia Herrera', 'generadorcertificado' => 'Martín Chávez', 'firmante1' => 'Sofia Herrera', 'firmante2' => 'Esteban Ríos', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/python.png'],
        ['id' => 16, 'nombre' => 'Grupo de Certificación Java 2024-II', 'tipo' => 'Certificado de programación', 'descripcion' => 'Certificación en desarrollo con Java', 'fechainicio' => '2024-06-01', 'fechafin' => '2024-07-30', 'creadorgrupo' => 'Natalia Gómez', 'generadorcertificado' => 'Andrés Espinoza', 'firmante1' => 'Natalia Gómez', 'firmante2' => 'Victor Muñoz', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/java.png'],
        ['id' => 17, 'nombre' => 'Grupo de Certificación C++ 2024-II', 'tipo' => 'Certificado de programación', 'descripcion' => 'Certificación en desarrollo con C++', 'fechainicio' => '2024-05-01', 'fechafin' => '2024-06-30', 'creadorgrupo' => 'Rodrigo Sánchez', 'generadorcertificado' => 'Liliana Duarte', 'firmante1' => 'Rodrigo Sánchez', 'firmante2' => 'Marta Ruiz', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/cpp.png'],
        ['id' => 18, 'nombre' => 'Grupo de Certificación SQL 2024-II', 'tipo' => 'Certificado de bases de datos', 'descripcion' => 'Certificación en manejo de bases de datos SQL', 'fechainicio' => '2024-04-01', 'fechafin' => '2024-05-31', 'creadorgrupo' => 'Verónica Medina', 'generadorcertificado' => 'Joaquín Ferrer', 'firmante1' => 'Verónica Medina', 'firmante2' => 'Gabriel Orozco', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/sql.png'],
        ['id' => 19, 'nombre' => 'Grupo de Certificación Docker 2024-II', 'tipo' => 'Certificado de virtualización', 'descripcion' => 'Certificación en contenedores con Docker', 'fechainicio' => '2024-03-01', 'fechafin' => '2024-04-15', 'creadorgrupo' => 'Ricardo Fuentes', 'generadorcertificado' => 'Beatriz Solís', 'firmante1' => 'Ricardo Fuentes', 'firmante2' => 'Francisco Lara', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/docker.png'],
        ['id' => 20, 'nombre' => 'Grupo de Certificación Kubernetes 2024-II', 'tipo' => 'Certificado de orquestación de contenedores', 'descripcion' => 'Certificación en administración de Kubernetes', 'fechainicio' => '2024-02-01', 'fechafin' => '2024-03-31', 'creadorgrupo' => 'Gustavo Varela', 'generadorcertificado' => 'Daniela Acosta', 'firmante1' => 'Gustavo Varela', 'firmante2' => 'Rodrigo Mena', 'firmante3' => 'Ninguno', 'firmante4' => 'Ninguno', 'plantilla' => '/templates/kubernetes.png'],
    ];


    // Array de fechas de emisión
    public $fechas_emision = [
        ['id' => 1, 'fecha' => '2024-01-15'],
        ['id' => 2, 'fecha' => '2024-02-20'],
        ['id' => 3, 'fecha' => '2024-03-10'],
        ['id' => 4, 'fecha' => '2024-03-25'],
        ['id' => 5, 'fecha' => '2024-04-05'],
        ['id' => 6, 'fecha' => '2024-04-20'],
        ['id' => 7, 'fecha' => '2024-05-15'],
        ['id' => 8, 'fecha' => '2024-05-30'],
        ['id' => 9, 'fecha' => '2024-06-10'],
        ['id' => 10, 'fecha' => '2024-06-25'],
        ['id' => 11, 'fecha' => '2024-07-15'],
        ['id' => 12, 'fecha' => '2024-07-30'],
        ['id' => 13, 'fecha' => '2024-08-10'],
        ['id' => 14, 'fecha' => '2024-08-25'],
        ['id' => 15, 'fecha' => '2024-09-15'],
        ['id' => 16, 'fecha' => '2024-09-30'],
        ['id' => 17, 'fecha' => '2024-10-15'],
        ['id' => 18, 'fecha' => '2024-10-30'],
        ['id' => 19, 'fecha' => '2024-11-15'],
        ['id' => 20, 'fecha' => '2024-11-30'],
    ];

    public $personas = [
        ['id' => 1, 'nombres' => 'Luis Sandro', 'apellidos' => 'Perez Tutcto', 'correo' => 'luis.perez@example.com', 'area' => 'TI', 'cargo' => 'Sin Cargo', 'firma' => '/imagenes/firmas/Firma 01.png', 'contacto' => '9542154352', 'sexo' => 'Masculino'],
        ['id' => 2, 'nombres' => 'María Fernanda', 'apellidos' => 'Lopez García', 'correo' => 'maria.lopez@example.com', 'area' => 'Recursos Humanos', 'cargo' => 'Jefa de RRHH', 'firma' => '/imagenes/firmas/Firma 02.png', 'contacto' => '9876543210', 'sexo' => 'Femenino'],
        ['id' => 3, 'nombres' => 'Carlos Alberto', 'apellidos' => 'Gomez Torres', 'correo' => 'carlos.gomez@example.com', 'area' => 'TI', 'cargo' => 'Desarrollador', 'firma' => '/imagenes/firmas/Firma 03.png', 'contacto' => '9517534567', 'sexo' => 'Masculino'],
        ['id' => 4, 'nombres' => 'Ana Patricia', 'apellidos' => 'Ramirez Salas', 'correo' => 'ana.ramirez@example.com', 'area' => 'Marketing', 'cargo' => 'Gerente', 'firma' => '/imagenes/firmas/Firma 04.png', 'contacto' => '9632587410', 'sexo' => 'Femenino'],
        ['id' => 5, 'nombres' => 'Javier Ernesto', 'apellidos' => 'Mendoza Castro', 'correo' => 'javier.mendoza@example.com', 'area' => 'Ventas', 'cargo' => 'Vendedor', 'firma' => '/imagenes/firmas/Firma 05.png', 'contacto' => '9871236548', 'sexo' => 'Masculino'],
        ['id' => 6, 'nombres' => 'Daniela Beatriz', 'apellidos' => 'Rojas Fernández', 'correo' => 'daniela.rojas@example.com', 'area' => 'Administración', 'cargo' => 'Coordinadora', '/imagenes/firmas/Firma 06.png' => 'Con firma', 'contacto' => '9123456789', 'sexo' => 'Femenino'],
        ['id' => 7, 'nombres' => 'Fernando Andrés', 'apellidos' => 'Silva Torres', 'correo' => 'fernando.silva@example.com', 'area' => 'TI', 'cargo' => 'Analista', 'firma' => '/imagenes/firmas/Firma 07.png', 'contacto' => '9234567891', 'sexo' => 'Masculino'],
        ['id' => 8, 'nombres' => 'Valeria Soledad', 'apellidos' => 'Herrera Gómez', 'correo' => 'valeria.herrera@example.com', 'area' => 'Finanzas', 'cargo' => 'Contadora', 'firma' => '/imagenes/firmas/Firma 08.png', 'contacto' => '9564783214', 'sexo' => 'Femenino'],
        ['id' => 9, 'nombres' => 'Ricardo Esteban', 'apellidos' => 'Pérez Sánchez', 'correo' => 'ricardo.perez@example.com', 'area' => 'Logística', 'cargo' => 'Supervisor', 'firma' => '/imagenes/firmas/Firma 09.png', 'contacto' => '9786543120', 'sexo' => 'Masculino'],
        ['id' => 10, 'nombres' => 'Camila Alejandra', 'apellidos' => 'Ortega Díaz', 'correo' => 'camila.ortega@example.com', 'area' => 'TI', 'cargo' => 'Programadora', 'firma' => '/imagenes/firmas/Firma 10.png', 'contacto' => '9456123789', 'sexo' => 'Femenino'],
        ['id' => 11, 'nombres' => 'Sebastián Enrique', 'apellidos' => 'Fernández Ruiz', 'correo' => 'sebastian.fernandez@example.com', 'area' => 'TI', 'cargo' => 'Ingeniero de Software', 'firma' => '/imagenes/firmas/Firma 11.png', 'contacto' => '9873216547', 'sexo' => 'Masculino'],
        ['id' => 12, 'nombres' => 'Luciana Isabel', 'apellidos' => 'Chávez López', 'correo' => 'luciana.chavez@example.com', 'area' => 'Recursos Humanos', 'cargo' => 'Asistente', 'firma' => '/imagenes/firmas/Firma 12.png', 'contacto' => '9568741230', 'sexo' => 'Femenino'],
        ['id' => 13, 'nombres' => 'Alejandro Javier', 'apellidos' => 'Muñoz Castillo', 'correo' => 'alejandro.munoz@example.com', 'area' => 'Ventas', 'cargo' => 'Ejecutivo de Ventas', 'firma' => '/imagenes/firmas/Firma 13.png', 'contacto' => '9321457896', 'sexo' => 'Masculino'],
        ['id' => 14, 'nombres' => 'Sofía Antonella', 'apellidos' => 'García Méndez', 'correo' => 'sofia.garcia@example.com', 'area' => 'Administración', 'cargo' => 'Secretaria', 'firma' => '/imagenes/firmas/Firma 14.png', 'contacto' => '9645287913', 'sexo' => 'Femenino'],
        ['id' => 15, 'nombres' => 'Tomás Emiliano', 'apellidos' => 'Vega Ríos', 'correo' => 'tomas.vega@example.com', 'area' => 'Finanzas', 'cargo' => 'Analista Financiero', 'firma' => '/imagenes/firmas/Firma 15.png', 'contacto' => '9754623189', 'sexo' => 'Masculino'],
        ['id' => 16, 'nombres' => 'Gabriela Mariana', 'apellidos' => 'Flores Campos', 'correo' => 'gabriela.flores@example.com', 'area' => 'Logística', 'cargo' => 'Encargada de Inventarios', 'firma' => '/imagenes/firmas/Firma 16.png', 'contacto' => '9123645789', 'sexo' => 'Femenino'],
        ['id' => 17, 'nombres' => 'Rodrigo Manuel', 'apellidos' => 'Cárdenas Ortiz', 'correo' => 'rodrigo.cardenas@example.com', 'area' => 'TI', 'cargo' => 'Administrador de Redes', 'firma' => '/imagenes/firmas/Firma 17.png', 'contacto' => '9874562314', 'sexo' => 'Masculino'],
        ['id' => 18, 'nombres' => 'Isabella Victoria', 'apellidos' => 'Navarro Medina', 'correo' => 'isabella.navarro@example.com', 'area' => 'Marketing', 'cargo' => 'Community Manager', 'firma' => '/imagenes/firmas/Firma 18.png', 'contacto' => '9547896321', 'sexo' => 'Femenino'],
        ['id' => 19, 'nombres' => 'Francisco Antonio', 'apellidos' => 'Jiménez Guzmán', 'correo' => 'francisco.jimenez@example.com', 'area' => 'Ventas', 'cargo' => 'Gerente de Cuentas', 'firma' => '/imagenes/firmas/Firma 19.png', 'contacto' => '9213648752', 'sexo' => 'Masculino'],
        ['id' => 20, 'nombres' => 'Elena Rocío', 'apellidos' => 'Hernández Palacios', 'correo' => 'elena.hernandez@example.com', 'area' => 'Recursos Humanos', 'cargo' => 'Capacitadora', 'firma' => '/imagenes/firmas/Firma 20.png', 'contacto' => '9875123648', 'sexo' => 'Femenino'],
    ];

    public $plantillas = [
        ['id' => 1, 'nombre' => 'Plantilla Voluntariado', 'imagen' => 'public/imagenes/firma01'],
        ['id' => 2, 'nombre' => 'Plantilla Taller', 'imagen' => 'public/imagenes/firma02'],
        ['id' => 3, 'nombre' => 'Plantilla Directiva', 'imagen' => 'public/imagenes/firma03'],
        ['id' => 4, 'nombre' => 'Plantilla Director de Proyecto', 'imagen' => 'public/imagenes/firma04'],
        ['id' => 5, 'nombre' => 'Plantilla Ponencia', 'imagen' => 'public/imagenes/firma05'],
        ['id' => 6, 'nombre' => 'Plantilla Certificación', 'imagen' => 'public/imagenes/firma06'],
        ['id' => 7, 'nombre' => 'Plantilla Reconocimiento', 'imagen' => 'public/imagenes/firma07'],
        ['id' => 8, 'nombre' => 'Plantilla Evento Académico', 'imagen' => 'public/imagenes/firma08'],
        ['id' => 9, 'nombre' => 'Plantilla Mérito', 'imagen' => 'public/imagenes/firma09'],
        ['id' => 10, 'nombre' => 'Plantilla Constancia', 'imagen' => 'public/imagenes/firma10'],
        ['id' => 11, 'nombre' => 'Plantilla Participación', 'imagen' => 'public/imagenes/firma11'],
        ['id' => 12, 'nombre' => 'Plantilla Distinción', 'imagen' => 'public/imagenes/firma12'],
        ['id' => 13, 'nombre' => 'Plantilla Convenio', 'imagen' => 'public/imagenes/firma13'],
        ['id' => 14, 'nombre' => 'Plantilla Agradecimiento', 'imagen' => 'public/imagenes/firma14'],
        ['id' => 15, 'nombre' => 'Plantilla Coordinación', 'imagen' => 'public/imagenes/firma15'],
        ['id' => 16, 'nombre' => 'Plantilla Asesoría', 'imagen' => 'public/imagenes/firma16'],
        ['id' => 17, 'nombre' => 'Plantilla Evaluación', 'imagen' => 'public/imagenes/firma17'],
        ['id' => 18, 'nombre' => 'Plantilla Organización', 'imagen' => 'public/imagenes/firma18'],
        ['id' => 19, 'nombre' => 'Plantilla Conferencia', 'imagen' => 'public/imagenes/firma19'],
        ['id' => 20, 'nombre' => 'Plantilla Capacitación', 'imagen' => 'public/imagenes/firma20'],
    ];

    public $certificados;

    public function __construct()
    {
        $this->certificados = array_map(function($i) {
            return [
                'id' => $i + 1,
                'codigo' => $this->codigos[$i]['codigo'],
                'titular' => $this->usuarios[$i]['nombre'] . ' ' . $this->usuarios[$i]['apellido'],
                'grupo_certificacion' => $this->grupos_certificacion[$i]['nombre'],
                'fecha_emision' => $this->fechas_emision[$i]['fecha'],
                'estado' => rand(0,1) ? 'Creado' : 'Validado'
            ];
        }, range(0, 19));
    }


}
