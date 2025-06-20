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

    // Array de libros

    public $libros = [
        ["id" => 1, "titulo" => "El Misterio del Reloj Antiguo", "ISBN" => "978-3161484100", "descripcion" => "Una intrigante novela de detectives ambientada en el siglo XIX.", "categorías" => [1, 5, 10], "autores" => [1], "ediciones" => [1, 2, 3]],
        ["id" => 2, "titulo" => "Crónicas de Valoria: El Despertar del Dragón", "ISBN" => "978-0743273565", "descripcion" => "El inicio de una épica saga de fantasía llena de magia y aventuras.", "categorías" => [2, 8], "autores" => [2, 3], "ediciones" => [4, 5, 6, 7, 8]],
        ["id" => 3, "titulo" => "Cocina Molecular para Principiantes", "ISBN" => "978-1603580557", "descripcion" => "Descubre los secretos de la gastronomía moderna con recetas fáciles.", "categorías" => [15, 18], "autores" => [4], "ediciones" => [9]],
        ["id" => 4, "titulo" => "Viaje a las Estrellas Olvidadas", "ISBN" => "978-0321765723", "descripcion" => "Una odisea de ciencia ficción a través de nebulosas y planetas desconocidos.", "categorías" => [3], "autores" => [5, 6, 7], "ediciones" => [10, 11, 12, 13, 14, 15, 16]],
        ["id" => 5, "titulo" => "El Arte de la Meditación Zen", "ISBN" => "978-1590302095", "descripcion" => "Guía práctica para encontrar la paz interior y la atención plena.", "categorías" => [7, 12, 19], "autores" => [8], "ediciones" => [17, 18]],
        ["id" => 6, "titulo" => "Historia Universal del Siglo XX", "ISBN" => "978-0415277360", "descripcion" => "Un compendio detallado de los eventos más importantes del siglo pasado.", "categorías" => [5, 18], "autores" => [9], "ediciones" => [19, 20, 21, 22, 23, 24, 25, 26, 27, 28]],
        ["id" => 7, "titulo" => "Poemas del Alma Errante", "ISBN" => "978-0142437230", "descripcion" => "Colección de versos que exploran el amor, la pérdida y la esperanza.", "categorías" => [4], "autores" => [10, 11], "ediciones" => [29, 30, 31, 32]],
        ["id" => 8, "titulo" => "Robótica Aplicada: Construye tu Propio Androide", "ISBN" => "978-1449343513", "descripcion" => "Manual técnico para entusiastas de la robótica y la programación.", "categorías" => [16, 18, 20], "autores" => [12], "ediciones" => [33, 34, 35, 36, 37, 38]],
        ["id" => 9, "titulo" => "El Jardín Secreto de las Mariposas", "ISBN" => "978-0061120084", "descripcion" => "Una novela romántica con un toque de realismo mágico.", "categorías" => [6, 9], "autores" => [13, 14, 15], "ediciones" => [39, 40]],
        ["id" => 10, "titulo" => "Filosofía para la Vida Cotidiana", "ISBN" => "978-0241372771", "descripcion" => "Cómo aplicar los grandes pensamientos filosóficos a los desafíos diarios.", "categorías" => [11, 7], "autores" => [16], "ediciones" => [41, 42, 43, 44, 45, 46, 47, 48]],
        ["id" => 11, "titulo" => "La Sombra del Viento Digital", "ISBN" => "978-8408078839", "descripcion" => "Un thriller tecnológico sobre hackers y secretos gubernamentales en la era moderna.", "categorías" => [16, 1, 10], "autores" => [17], "ediciones" => [49, 50, 51, 52]],
        ["id" => 12, "titulo" => "El Último Alquimista de Praga", "ISBN" => "978-0307278278", "descripcion" => "Una novela histórica que mezcla alquimia, romance y conspiraciones en la Praga del siglo XVII.", "categorías" => [5, 6, 9], "autores" => [18, 19], "ediciones" => [53, 54]],
        ["id" => 13, "titulo" => "Guía Completa de Astrofotografía", "ISBN" => "978-1119545413", "descripcion" => "Aprende a capturar la belleza del cosmos con tu cámara, desde nebulosas hasta galaxias.", "categorías" => [17, 18, 20], "autores" => [20], "ediciones" => [55, 56, 57, 58, 59, 60]],
        ["id" => 14, "titulo" => "Los Guardianes del Bosque Encantado", "ISBN" => "978-1408855652", "descripcion" => "Una aventura infantil llena de criaturas mágicas y lecciones sobre la naturaleza.", "categorías" => [2, 8, 13], "autores" => [1], "ediciones" => [61, 62, 63]],
        ["id" => 15, "titulo" => "Minimalismo Existencial: Menos es Más Vida", "ISBN" => "978-1615195000", "descripcion" => "Un ensayo filosófico y práctico sobre cómo el minimalismo puede enriquecer la existencia.", "categorías" => [11, 7, 19], "autores" => [3, 4], "ediciones" => [64, 65, 66, 67, 68, 69, 70, 71, 72]],
        ["id" => 16, "titulo" => "El Código Perdido de los Incas", "ISBN" => "978-0451219019", "descripcion" => "Una expedición arqueológica desvela un antiguo secreto en las montañas de los Andes.", "categorías" => [8, 5, 1], "autores" => [5], "ediciones" => [73]],
        ["id" => 17, "titulo" => "Antología de Cuentos Cortos Latinoamericanos", "ISBN" => "978-9500727027", "descripcion" => "Una selección de relatos impactantes de autores contemporáneos de América Latina.", "categorías" => [10, 14], "autores" => [6, 7, 8], "ediciones" => [74, 75, 76, 77, 78]],
        ["id" => 18, "titulo" => "Neurociencia del Aprendizaje: Optimiza tu Mente", "ISBN" => "978-1626252720", "descripcion" => "Descubre cómo funciona el cerebro al aprender y aplica técnicas para mejorar tu estudio.", "categorías" => [18, 7, 17], "autores" => [9], "ediciones" => [79, 80, 81, 82, 83, 84, 85, 86, 87, 88]],
        ["id" => 19, "titulo" => "Recetas Veganas para Deportistas", "ISBN" => "978-1570673418", "descripcion" => "Platos nutritivos y deliciosos para potenciar tu rendimiento físico con una dieta basada en plantas.", "categorías" => [15, 19], "autores" => [10], "ediciones" => [89, 90, 91, 92, 93, 94, 95]],
        ["id" => 20, "titulo" => "El Futuro del Trabajo: Adaptándose a la IA", "ISBN" => "978-0262039126", "descripcion" => "Un análisis prospectivo sobre cómo la inteligencia artificial transformará el panorama laboral.", "categorías" => [16, 11, 18], "autores" => [11, 12, 13], "ediciones" => [96, 97, 98, 99, 100, 101, 102, 103, 104, 105]]
    ];

    public $categories = [
        [ "id" => 1, "nombre" => "Misterio y Suspense" ],
        [ "id" => 2, "nombre" => "Fantasía Épica" ],
        [ "id" => 3, "nombre" => "Ciencia Ficción y Distopía" ],
        [ "id" => 4, "nombre" => "Poesía Clásica y Contemporánea" ],
        [ "id" => 5, "nombre" => "Novela Histórica" ],
        [ "id" => 6, "nombre" => "Romance y Novela Romántica" ],
        [ "id" => 7, "nombre" => "Autoayuda y Desarrollo Personal" ],
        [ "id" => 8, "nombre" => "Aventura y Exploración" ],
        [ "id" => 9, "nombre" => "Realismo Mágico" ],
        [ "id" => 10, "nombre" => "Ficción Literaria Contemporánea" ],
        [ "id" => 11, "nombre" => "Filosofía y Ensayo" ],
        [ "id" => 12, "nombre" => "Espiritualidad y Meditación" ],
        [ "id" => 13, "nombre" => "Literatura Infantil y Juvenil" ],
        [ "id" => 14, "nombre" => "Cuentos y Antologías" ],
        [ "id" => 15, "nombre" => "Cocina, Gastronomía y Recetas" ],
        [ "id" => 16, "nombre" => "Tecnología, Informática y Ciencia de Datos" ],
        [ "id" => 17, "nombre" => "Ciencia, Naturaleza y Astronomía" ],
        [ "id" => 18, "nombre" => "Educación, Pedagogía y Guías de Estudio" ],
        [ "id" => 19, "nombre" => "Salud, Bienestar y Deporte" ],
        [ "id" => 20, "nombre" => "Manualidades, Hobbies y Proyectos DIY" ]
    ];


    public $authors = [
        [ "id" => 1, "nombre" => "Julian", "apellido" => "Blackwood" ],
        [ "id" => 2, "nombre" => "Elara", "apellido" => "Vance" ],
        [ "id" => 3, "nombre" => "Marcus", "apellido" => "Thorne" ],
        [ "id" => 4, "nombre" => "Isabelle", "apellido" => "Dubois" ],
        [ "id" => 5, "nombre" => "Kenji", "apellido" => "Tanaka" ],
        [ "id" => 6, "nombre" => "Sarah", "apellido" => "Chen" ],
        [ "id" => 7, "nombre" => "David", "apellido" => "Miller" ],
        [ "id" => 8, "nombre" => "Anya", "apellido" => "Sharma" ],
        [ "id" => 9, "nombre" => "Alistair", "apellido" => "Finch" ],
        [ "id" => 10, "nombre" => "Sofia", "apellido" => "Petrova" ],
        [ "id" => 11, "nombre" => "Liam", "apellido" => "O'Connell" ],
        [ "id" => 12, "nombre" => "Alex", "apellido" => "Ryder" ],
        [ "id" => 13, "nombre" => "Clara", "apellido" => "Fuentes" ],
        [ "id" => 14, "nombre" => "Mateo", "apellido" => "Silva" ],
        [ "id" => 15, "nombre" => "Elena", "apellido" => "Navarro" ],
        [ "id" => 16, "nombre" => "Evelyn", "apellido" => "Reed" ],
        [ "id" => 17, "nombre" => "Ben", "apellido" => "Carter" ],
        [ "id" => 18, "nombre" => "Viktor", "apellido" => "Orlov" ],
        [ "id" => 19, "nombre" => "Isolde", "apellido" => "Beauchamp" ],
        [ "id" => 20, "nombre" => "Samuel", "apellido" => "Kirkwood" ]
    ];



    public $editions = [
        ["id" => 1, "book_id" => 1, "editorial_id" => 1, "inventorie_id" => 1, "url_portada" => "portadas/el-misterio-del-reloj-antiguo-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/el-misterio-del-reloj-antiguo-edicion-1.pdf", "precio" => 27.24],
        ["id" => 2, "book_id" => 1, "editorial_id" => 2, "inventorie_id" => 2, "url_portada" => "portadas/el-misterio-del-reloj-antiguo-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/el-misterio-del-reloj-antiguo-edicion-2.pdf", "precio" => 64.91],
        ["id" => 3, "book_id" => 1, "editorial_id" => 3, "inventorie_id" => 3, "url_portada" => "portadas/el-misterio-del-reloj-antiguo-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/el-misterio-del-reloj-antiguo-edicion-3.pdf", "precio" => 66.45],
        ["id" => 4, "book_id" => 2, "editorial_id" => 4, "inventorie_id" => 4, "url_portada" => "portadas/cronicas-de-valoria-el-despertar-del-dragon-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/cronicas-de-valoria-el-despertar-del-dragon-edicion-1.pdf", "precio" => 73.18],
        ["id" => 5, "book_id" => 2, "editorial_id" => 5, "inventorie_id" => 5, "url_portada" => "portadas/cronicas-de-valoria-el-despertar-del-dragon-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/cronicas-de-valoria-el-despertar-del-dragon-edicion-2.pdf", "precio" => 27.42],
        ["id" => 6, "book_id" => 2, "editorial_id" => 1, "inventorie_id" => 6, "url_portada" => "portadas/cronicas-de-valoria-el-despertar-del-dragon-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/cronicas-de-valoria-el-despertar-del-dragon-edicion-3.pdf", "precio" => 52.33],
        ["id" => 7, "book_id" => 2, "editorial_id" => 2, "inventorie_id" => 7, "url_portada" => "portadas/cronicas-de-valoria-el-despertar-del-dragon-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/cronicas-de-valoria-el-despertar-del-dragon-edicion-4.pdf", "precio" => 68.61],
        ["id" => 8, "book_id" => 2, "editorial_id" => 3, "inventorie_id" => 8, "url_portada" => "portadas/cronicas-de-valoria-el-despertar-del-dragon-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/cronicas-de-valoria-el-despertar-del-dragon-edicion-5.pdf", "precio" => 34.61],
        ["id" => 9, "book_id" => 3, "editorial_id" => 4, "inventorie_id" => 9, "url_portada" => "portadas/cocina-molecular-para-principiantes-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/cocina-molecular-para-principiantes-edicion-1.pdf", "precio" => 50.15],
        ["id" => 10, "book_id" => 4, "editorial_id" => 5, "inventorie_id" => 10, "url_portada" => "portadas/viaje-a-las-estrellas-olvidadas-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/viaje-a-las-estrellas-olvidadas-edicion-1.pdf", "precio" => 56.59],
        ["id" => 11, "book_id" => 4, "editorial_id" => 1, "inventorie_id" => 11, "url_portada" => "portadas/viaje-a-las-estrellas-olvidadas-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/viaje-a-las-estrellas-olvidadas-edicion-2.pdf", "precio" => 33.19],
        ["id" => 12, "book_id" => 4, "editorial_id" => 2, "inventorie_id" => 12, "url_portada" => "portadas/viaje-a-las-estrellas-olvidadas-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/viaje-a-las-estrellas-olvidadas-edicion-3.pdf", "precio" => 56.46],
        ["id" => 13, "book_id" => 4, "editorial_id" => 3, "inventorie_id" => 13, "url_portada" => "portadas/viaje-a-las-estrellas-olvidadas-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/viaje-a-las-estrellas-olvidadas-edicion-4.pdf", "precio" => 25.59],
        ["id" => 14, "book_id" => 4, "editorial_id" => 4, "inventorie_id" => 14, "url_portada" => "portadas/viaje-a-las-estrellas-olvidadas-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/viaje-a-las-estrellas-olvidadas-edicion-5.pdf", "precio" => 21.36],
        ["id" => 15, "book_id" => 4, "editorial_id" => 5, "inventorie_id" => 15, "url_portada" => "portadas/viaje-a-las-estrellas-olvidadas-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/viaje-a-las-estrellas-olvidadas-edicion-6.pdf", "precio" => 40.73],
        ["id" => 16, "book_id" => 4, "editorial_id" => 1, "inventorie_id" => 16, "url_portada" => "portadas/viaje-a-las-estrellas-olvidadas-edicion-7.jpg", "numero_edicion" => "7ma", "url_pdf" => "pdfs/viaje-a-las-estrellas-olvidadas-edicion-7.pdf", "precio" => 34.01],
        ["id" => 17, "book_id" => 5, "editorial_id" => 2, "inventorie_id" => 17, "url_portada" => "portadas/el-arte-de-la-meditacion-zen-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/el-arte-de-la-meditacion-zen-edicion-1.pdf", "precio" => 65.65],
        ["id" => 18, "book_id" => 5, "editorial_id" => 3, "inventorie_id" => 18, "url_portada" => "portadas/el-arte-de-la-meditacion-zen-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/el-arte-de-la-meditacion-zen-edicion-2.pdf", "precio" => 33.72],
        ["id" => 19, "book_id" => 6, "editorial_id" => 4, "inventorie_id" => 19, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-1.pdf", "precio" => 62.47],
        ["id" => 20, "book_id" => 6, "editorial_id" => 5, "inventorie_id" => 20, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-2.pdf", "precio" => 27.53],
        ["id" => 21, "book_id" => 6, "editorial_id" => 1, "inventorie_id" => 21, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-3.pdf", "precio" => 78.41],
        ["id" => 22, "book_id" => 6, "editorial_id" => 2, "inventorie_id" => 22, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-4.pdf", "precio" => 56.12],
        ["id" => 23, "book_id" => 6, "editorial_id" => 3, "inventorie_id" => 23, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-5.pdf", "precio" => 75.38],
        ["id" => 24, "book_id" => 6, "editorial_id" => 4, "inventorie_id" => 24, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-6.pdf", "precio" => 61.29],
        ["id" => 25, "book_id" => 6, "editorial_id" => 5, "inventorie_id" => 25, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-7.jpg", "numero_edicion" => "7ma", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-7.pdf", "precio" => 50.81],
        ["id" => 26, "book_id" => 6, "editorial_id" => 1, "inventorie_id" => 26, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-8.jpg", "numero_edicion" => "8va", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-8.pdf", "precio" => 32.55],
        ["id" => 27, "book_id" => 6, "editorial_id" => 2, "inventorie_id" => 27, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-9.jpg", "numero_edicion" => "9na", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-9.pdf", "precio" => 54.73],
        ["id" => 28, "book_id" => 6, "editorial_id" => 3, "inventorie_id" => 28, "url_portada" => "portadas/historia-universal-del-siglo-xx-edicion-10.jpg", "numero_edicion" => "10ma", "url_pdf" => "pdfs/historia-universal-del-siglo-xx-edicion-10.pdf", "precio" => 63.88],
        ["id" => 29, "book_id" => 7, "editorial_id" => 4, "inventorie_id" => 29, "url_portada" => "portadas/poemas-del-alma-errante-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/poemas-del-alma-errante-edicion-1.pdf", "precio" => 41.57],
        ["id" => 30, "book_id" => 7, "editorial_id" => 5, "inventorie_id" => 30, "url_portada" => "portadas/poemas-del-alma-errante-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/poemas-del-alma-errante-edicion-2.pdf", "precio" => 28.31],
        ["id" => 31, "book_id" => 7, "editorial_id" => 1, "inventorie_id" => 31, "url_portada" => "portadas/poemas-del-alma-errante-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/poemas-del-alma-errante-edicion-3.pdf", "precio" => 33.92],
        ["id" => 32, "book_id" => 7, "editorial_id" => 2, "inventorie_id" => 32, "url_portada" => "portadas/poemas-del-alma-errante-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/poemas-del-alma-errante-edicion-4.pdf", "precio" => 80.15],
        ["id" => 33, "book_id" => 8, "editorial_id" => 3, "inventorie_id" => 33, "url_portada" => "portadas/robotica-aplicada-construye-tu-propio-androide-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/robotica-aplicada-construye-tu-propio-androide-edicion-1.pdf", "precio" => 42.67],
        ["id" => 34, "book_id" => 8, "editorial_id" => 4, "inventorie_id" => 34, "url_portada" => "portadas/robotica-aplicada-construye-tu-propio-androide-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/robotica-aplicada-construye-tu-propio-androide-edicion-2.pdf", "precio" => 24.39],
        ["id" => 35, "book_id" => 8, "editorial_id" => 5, "inventorie_id" => 35, "url_portada" => "portadas/robotica-aplicada-construye-tu-propio-androide-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/robotica-aplicada-construye-tu-propio-androide-edicion-3.pdf", "precio" => 25.11],
        ["id" => 36, "book_id" => 8, "editorial_id" => 1, "inventorie_id" => 36, "url_portada" => "portadas/robotica-aplicada-construye-tu-propio-androide-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/robotica-aplicada-construye-tu-propio-androide-edicion-4.pdf", "precio" => 35.77],
        ["id" => 37, "book_id" => 8, "editorial_id" => 2, "inventorie_id" => 37, "url_portada" => "portadas/robotica-aplicada-construye-tu-propio-androide-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/robotica-aplicada-construye-tu-propio-androide-edicion-5.pdf", "precio" => 77.01],
        ["id" => 38, "book_id" => 8, "editorial_id" => 3, "inventorie_id" => 38, "url_portada" => "portadas/robotica-aplicada-construye-tu-propio-androide-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/robotica-aplicada-construye-tu-propio-androide-edicion-6.pdf", "precio" => 75.92],
        ["id" => 39, "book_id" => 9, "editorial_id" => 4, "inventorie_id" => 39, "url_portada" => "portadas/el-jardin-secreto-de-las-mariposas-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/el-jardin-secreto-de-las-mariposas-edicion-1.pdf", "precio" => 38.64],
        ["id" => 40, "book_id" => 9, "editorial_id" => 5, "inventorie_id" => 40, "url_portada" => "portadas/el-jardin-secreto-de-las-mariposas-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/el-jardin-secreto-de-las-mariposas-edicion-2.pdf", "precio" => 84.17],
        ["id" => 41, "book_id" => 10, "editorial_id" => 1, "inventorie_id" => 41, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-1.pdf", "precio" => 83.18],
        ["id" => 42, "book_id" => 10, "editorial_id" => 2, "inventorie_id" => 42, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-2.pdf", "precio" => 77.42],
        ["id" => 43, "book_id" => 10, "editorial_id" => 3, "inventorie_id" => 43, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-3.pdf", "precio" => 48.01],
        ["id" => 44, "book_id" => 10, "editorial_id" => 4, "inventorie_id" => 44, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-4.pdf", "precio" => 81.39],
        ["id" => 45, "book_id" => 10, "editorial_id" => 5, "inventorie_id" => 45, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-5.pdf", "precio" => 18.06],
        ["id" => 46, "book_id" => 10, "editorial_id" => 1, "inventorie_id" => 46, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-6.pdf", "precio" => 45.42],
        ["id" => 47, "book_id" => 10, "editorial_id" => 2, "inventorie_id" => 47, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-7.jpg", "numero_edicion" => "7ma", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-7.pdf", "precio" => 40.52],
        ["id" => 48, "book_id" => 10, "editorial_id" => 3, "inventorie_id" => 48, "url_portada" => "portadas/filosofia-para-la-vida-cotidiana-edicion-8.jpg", "numero_edicion" => "8va", "url_pdf" => "pdfs/filosofia-para-la-vida-cotidiana-edicion-8.pdf", "precio" => 58.71],
        ["id" => 49, "book_id" => 11, "editorial_id" => 4, "inventorie_id" => 49, "url_portada" => "portadas/la-sombra-del-viento-digital-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/la-sombra-del-viento-digital-edicion-1.pdf", "precio" => 45.18],
        ["id" => 50, "book_id" => 11, "editorial_id" => 5, "inventorie_id" => 50, "url_portada" => "portadas/la-sombra-del-viento-digital-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/la-sombra-del-viento-digital-edicion-2.pdf", "precio" => 33.72],
        ["id" => 51, "book_id" => 11, "editorial_id" => 1, "inventorie_id" => 51, "url_portada" => "portadas/la-sombra-del-viento-digital-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/la-sombra-del-viento-digital-edicion-3.pdf", "precio" => 78.49],
        ["id" => 52, "book_id" => 11, "editorial_id" => 2, "inventorie_id" => 52, "url_portada" => "portadas/la-sombra-del-viento-digital-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/la-sombra-del-viento-digital-edicion-4.pdf", "precio" => 61.27],
        ["id" => 53, "book_id" => 12, "editorial_id" => 3, "inventorie_id" => 53, "url_portada" => "portadas/el-ultimo-alquimista-de-praga-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/el-ultimo-alquimista-de-praga-edicion-1.pdf", "precio" => 88.54],
        ["id" => 54, "book_id" => 12, "editorial_id" => 4, "inventorie_id" => 54, "url_portada" => "portadas/el-ultimo-alquimista-de-praga-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/el-ultimo-alquimista-de-praga-edicion-2.pdf", "precio" => 66.82],
        ["id" => 55, "book_id" => 13, "editorial_id" => 5, "inventorie_id" => 55, "url_portada" => "portadas/guia-completa-de-astrofotografia-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/guia-completa-de-astrofotografia-edicion-1.pdf", "precio" => 53.07],
        ["id" => 56, "book_id" => 13, "editorial_id" => 1, "inventorie_id" => 56, "url_portada" => "portadas/guia-completa-de-astrofotografia-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/guia-completa-de-astrofotografia-edicion-2.pdf", "precio" => 31.59],
        ["id" => 57, "book_id" => 13, "editorial_id" => 2, "inventorie_id" => 57, "url_portada" => "portadas/guia-completa-de-astrofotografia-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/guia-completa-de-astrofotografia-edicion-3.pdf", "precio" => 22.84],
        ["id" => 58, "book_id" => 13, "editorial_id" => 3, "inventorie_id" => 58, "url_portada" => "portadas/guia-completa-de-astrofotografia-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/guia-completa-de-astrofotografia-edicion-4.pdf", "precio" => 80.91],
        ["id" => 59, "book_id" => 13, "editorial_id" => 4, "inventorie_id" => 59, "url_portada" => "portadas/guia-completa-de-astrofotografia-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/guia-completa-de-astrofotografia-edicion-5.pdf", "precio" => 87.35],
        ["id" => 60, "book_id" => 13, "editorial_id" => 5, "inventorie_id" => 60, "url_portada" => "portadas/guia-completa-de-astrofotografia-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/guia-completa-de-astrofotografia-edicion-6.pdf", "precio" => 75.62],
        ["id" => 61, "book_id" => 14, "editorial_id" => 1, "inventorie_id" => 61, "url_portada" => "portadas/los-guardianes-del-bosque-encantado-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/los-guardianes-del-bosque-encantado-edicion-1.pdf", "precio" => 20.33],
        ["id" => 62, "book_id" => 14, "editorial_id" => 2, "inventorie_id" => 62, "url_portada" => "portadas/los-guardianes-del-bosque-encantado-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/los-guardianes-del-bosque-encantado-edicion-2.pdf", "precio" => 69.41],
        ["id" => 63, "book_id" => 14, "editorial_id" => 3, "inventorie_id" => 63, "url_portada" => "portadas/los-guardianes-del-bosque-encantado-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/los-guardianes-del-bosque-encantado-edicion-3.pdf", "precio" => 60.19],
        ["id" => 64, "book_id" => 15, "editorial_id" => 4, "inventorie_id" => 64, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-1.pdf", "precio" => 44.57],
        ["id" => 65, "book_id" => 15, "editorial_id" => 5, "inventorie_id" => 65, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-2.pdf", "precio" => 52.88],
        ["id" => 66, "book_id" => 15, "editorial_id" => 1, "inventorie_id" => 66, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-3.pdf", "precio" => 71.34],
        ["id" => 67, "book_id" => 15, "editorial_id" => 2, "inventorie_id" => 67, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-4.pdf", "precio" => 38.67],
        ["id" => 68, "book_id" => 15, "editorial_id" => 3, "inventorie_id" => 68, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-5.pdf", "precio" => 23.49],
        ["id" => 69, "book_id" => 15, "editorial_id" => 4, "inventorie_id" => 69, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-6.pdf", "precio" => 77.03],
        ["id" => 70, "book_id" => 15, "editorial_id" => 5, "inventorie_id" => 70, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-7.jpg", "numero_edicion" => "7ma", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-7.pdf", "precio" => 85.11],
        ["id" => 71, "book_id" => 15, "editorial_id" => 1, "inventorie_id" => 71, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-8.jpg", "numero_edicion" => "8va", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-8.pdf", "precio" => 30.62],
        ["id" => 72, "book_id" => 15, "editorial_id" => 2, "inventorie_id" => 72, "url_portada" => "portadas/minimalismo-existencial-menos-es-mas-vida-edicion-9.jpg", "numero_edicion" => "9na", "url_pdf" => "pdfs/minimalismo-existencial-menos-es-mas-vida-edicion-9.pdf", "precio" => 50.79],
        ["id" => 73, "book_id" => 16, "editorial_id" => 3, "inventorie_id" => 73, "url_portada" => "portadas/el-codigo-perdido-de-los-incas-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/el-codigo-perdido-de-los-incas-edicion-1.pdf", "precio" => 42.15],
        ["id" => 74, "book_id" => 17, "editorial_id" => 4, "inventorie_id" => 74, "url_portada" => "portadas/antologia-de-cuentos-cortos-latinoamericanos-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/antologia-de-cuentos-cortos-latinoamericanos-edicion-1.pdf", "precio" => 78.43],
        ["id" => 75, "book_id" => 17, "editorial_id" => 5, "inventorie_id" => 75, "url_portada" => "portadas/antologia-de-cuentos-cortos-latinoamericanos-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/antologia-de-cuentos-cortos-latinoamericanos-edicion-2.pdf", "precio" => 61.29],
        ["id" => 76, "book_id" => 17, "editorial_id" => 1, "inventorie_id" => 76, "url_portada" => "portadas/antologia-de-cuentos-cortos-latinoamericanos-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/antologia-de-cuentos-cortos-latinoamericanos-edicion-3.pdf", "precio" => 55.78],
        ["id" => 77, "book_id" => 17, "editorial_id" => 2, "inventorie_id" => 77, "url_portada" => "portadas/antologia-de-cuentos-cortos-latinoamericanos-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/antologia-de-cuentos-cortos-latinoamericanos-edicion-4.pdf", "precio" => 33.51],
        ["id" => 78, "book_id" => 17, "editorial_id" => 3, "inventorie_id" => 78, "url_portada" => "portadas/antologia-de-cuentos-cortos-latinoamericanos-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/antologia-de-cuentos-cortos-latinoamericanos-edicion-5.pdf", "precio" => 90.36],
        ["id" => 79, "book_id" => 18, "editorial_id" => 4, "inventorie_id" => 79, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-1.pdf", "precio" => 81.75],
        ["id" => 80, "book_id" => 18, "editorial_id" => 5, "inventorie_id" => 80, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-2.pdf", "precio" => 77.29],
        ["id" => 81, "book_id" => 18, "editorial_id" => 1, "inventorie_id" => 81, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-3.pdf", "precio" => 65.48],
        ["id" => 82, "book_id" => 18, "editorial_id" => 2, "inventorie_id" => 82, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-4.pdf", "precio" => 43.19],
        ["id" => 83, "book_id" => 18, "editorial_id" => 3, "inventorie_id" => 83, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-5.pdf", "precio" => 50.77],
        ["id" => 84, "book_id" => 18, "editorial_id" => 4, "inventorie_id" => 84, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-6.pdf", "precio" => 39.85],
        ["id" => 85, "book_id" => 18, "editorial_id" => 5, "inventorie_id" => 85, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-7.jpg", "numero_edicion" => "7ma", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-7.pdf", "precio" => 22.91],
        ["id" => 86, "book_id" => 18, "editorial_id" => 1, "inventorie_id" => 86, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-8.jpg", "numero_edicion" => "8va", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-8.pdf", "precio" => 88.03],
        ["id" => 87, "book_id" => 18, "editorial_id" => 2, "inventorie_id" => 87, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-9.jpg", "numero_edicion" => "9na", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-9.pdf", "precio" => 28.64],
        ["id" => 88, "book_id" => 18, "editorial_id" => 3, "inventorie_id" => 88, "url_portada" => "portadas/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-10.jpg", "numero_edicion" => "10ma", "url_pdf" => "pdfs/neurociencia-del-aprendizaje-optimiza-tu-mente-edicion-10.pdf", "precio" => 74.52],
        ["id" => 89, "book_id" => 19, "editorial_id" => 4, "inventorie_id" => 89, "url_portada" => "portadas/recetas-veganas-para-deportistas-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/recetas-veganas-para-deportistas-edicion-1.pdf", "precio" => 52.19],
        ["id" => 90, "book_id" => 19, "editorial_id" => 5, "inventorie_id" => 90, "url_portada" => "portadas/recetas-veganas-para-deportistas-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/recetas-veganas-para-deportistas-edicion-2.pdf", "precio" => 67.33],
        ["id" => 91, "book_id" => 19, "editorial_id" => 1, "inventorie_id" => 91, "url_portada" => "portadas/recetas-veganas-para-deportistas-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/recetas-veganas-para-deportistas-edicion-3.pdf", "precio" => 84.67],
        ["id" => 92, "book_id" => 19, "editorial_id" => 2, "inventorie_id" => 92, "url_portada" => "portadas/recetas-veganas-para-deportistas-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/recetas-veganas-para-deportistas-edicion-4.pdf", "precio" => 25.12],
        ["id" => 93, "book_id" => 19, "editorial_id" => 3, "inventorie_id" => 93, "url_portada" => "portadas/recetas-veganas-para-deportistas-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/recetas-veganas-para-deportistas-edicion-5.pdf", "precio" => 40.05],
        ["id" => 94, "book_id" => 19, "editorial_id" => 4, "inventorie_id" => 94, "url_portada" => "portadas/recetas-veganas-para-deportistas-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/recetas-veganas-para-deportistas-edicion-6.pdf", "precio" => 93.81],
        ["id" => 95, "book_id" => 19, "editorial_id" => 5, "inventorie_id" => 95, "url_portada" => "portadas/recetas-veganas-para-deportistas-edicion-7.jpg", "numero_edicion" => "7ma", "url_pdf" => "pdfs/recetas-veganas-para-deportistas-edicion-7.pdf", "precio" => 60.29],
        ["id" => 96, "book_id" => 20, "editorial_id" => 1, "inventorie_id" => 96, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-1.jpg", "numero_edicion" => "1ra", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-1.pdf", "precio" => 31.57],
        ["id" => 97, "book_id" => 20, "editorial_id" => 2, "inventorie_id" => 97, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-2.jpg", "numero_edicion" => "2da", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-2.pdf", "precio" => 48.73],
        ["id" => 98, "book_id" => 20, "editorial_id" => 3, "inventorie_id" => 98, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-3.jpg", "numero_edicion" => "3ra", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-3.pdf", "precio" => 80.19],
        ["id" => 99, "book_id" => 20, "editorial_id" => 4, "inventorie_id" => 99, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-4.jpg", "numero_edicion" => "4ta", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-4.pdf", "precio" => 66.42],
        ["id" => 100, "book_id" => 20, "editorial_id" => 5, "inventorie_id" => 100, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-5.jpg", "numero_edicion" => "5ta", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-5.pdf", "precio" => 53.07],
        ["id" => 101, "book_id" => 20, "editorial_id" => 1, "inventorie_id" => 101, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-6.jpg", "numero_edicion" => "6ta", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-6.pdf", "precio" => 35.88],
        ["id" => 102, "book_id" => 20, "editorial_id" => 2, "inventorie_id" => 102, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-7.jpg", "numero_edicion" => "7ma", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-7.pdf", "precio" => 71.95],
        ["id" => 103, "book_id" => 20, "editorial_id" => 3, "inventorie_id" => 103, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-8.jpg", "numero_edicion" => "8va", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-8.pdf", "precio" => 24.61],
        ["id" => 104, "book_id" => 20, "editorial_id" => 4, "inventorie_id" => 104, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-9.jpg", "numero_edicion" => "9na", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-9.pdf", "precio" => 87.05],
        ["id" => 105, "book_id" => 20, "editorial_id" => 5, "inventorie_id" => 105, "url_portada" => "portadas/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-10.jpg", "numero_edicion" => "10ma", "url_pdf" => "pdfs/el-futuro-del-trabajo-adaptandose-a-la-ia-edicion-10.pdf", "precio" => 59.32]
    ];


    public $editorials = [
        [ "id" => 1, "nombre" => "Ediciones del Sol Naciente" ],
        [ "id" => 2, "nombre" => "Editorial Cosmos Libros" ],
        [ "id" => 3, "nombre" => "Prensa Académica Unida" ],
        [ "id" => 4, "nombre" => "Libros del Bosque Encantado" ],
        [ "id" => 5, "nombre" => "TecnoEdiciones Futuras" ],
        [ "id" => 6, "nombre" => "Editorial Horizonte Literario" ],
        [ "id" => 7, "nombre" => "Sabiduría Ancestral Editores" ],
        [ "id" => 8, "nombre" => "GastroNomos Publicaciones" ],
        [ "id" => 9, "nombre" => "Aventuras Infantiles Press" ],
        [ "id" => 10, "nombre" => "Imprenta de Clásicos Renovados" ]
    ];


    public $inventories_part1 = [
        ["id" => 1, "cantidad" => 33, "umbral" => 15],
        ["id" => 2, "cantidad" => 25, "umbral" => 12],
        ["id" => 3, "cantidad" => 8, "umbral" => 18], //BAJO
        ["id" => 4, "cantidad" => 47, "umbral" => 11],
        ["id" => 5, "cantidad" => 12, "umbral" => 20],
        ["id" => 6, "cantidad" => 2, "umbral" => 14],
        ["id" => 7, "cantidad" => 41, "umbral" => 19],
        ["id" => 8, "cantidad" => 22, "umbral" => 10],
        ["id" => 9, "cantidad" => 3, "umbral" => 16], //BAJO
        ["id" => 10, "cantidad" => 30, "umbral" => 17],
        ["id" => 11, "cantidad" => 19, "umbral" => 13],
        ["id" => 12, "cantidad" => 0, "umbral" => 15],
        ["id" => 13, "cantidad" => 49, "umbral" => 11],
        ["id" => 14, "cantidad" => 28, "umbral" => 19],
        ["id" => 15, "cantidad" => 7, "umbral" => 10], //BAJO
        ["id" => 16, "cantidad" => 36, "umbral" => 14],
        ["id" => 17, "cantidad" => 1, "umbral" => 12],
        ["id" => 18, "cantidad" => 23, "umbral" => 20],
        ["id" => 19, "cantidad" => 50, "umbral" => 17],
        ["id" => 20, "cantidad" => 15, "umbral" => 16],
        ["id" => 21, "cantidad" => 28, "umbral" => 15],
        ["id" => 22, "cantidad" => 5, "umbral" => 12],
        ["id" => 23, "cantidad" => 42, "umbral" => 18],
        ["id" => 24, "cantidad" => 10, "umbral" => 11],
        ["id" => 25, "cantidad" => 3, "umbral" => 19], // BAJO
        ["id" => 26, "cantidad" => 33, "umbral" => 14],
        ["id" => 27, "cantidad" => 1, "umbral" => 10],
        ["id" => 28, "cantidad" => 20, "umbral" => 20],
        ["id" => 29, "cantidad" => 49, "umbral" => 16],
        ["id" => 30, "cantidad" => 15, "umbral" => 17],
        ["id" => 31, "cantidad" => 38, "umbral" => 13],
        ["id" => 32, "cantidad" => 7, "umbral" => 14], // BAJO
        ["id" => 33, "cantidad" => 2, "umbral" => 10],
        ["id" => 34, "cantidad" => 26, "umbral" => 19],
        ["id" => 35, "cantidad" => 41, "umbral" => 11],
        ["id" => 36, "cantidad" => 18, "umbral" => 14],
        ["id" => 37, "cantidad" => 50, "umbral" => 12],
        ["id" => 38, "cantidad" => 9, "umbral" => 20],
        ["id" => 39, "cantidad" => 31, "umbral" => 17],
        ["id" => 40, "cantidad" => 13, "umbral" => 16],
        ["id" => 41, "cantidad" => 4, "umbral" => 18], // BAJO
        ["id" => 42, "cantidad" => 24, "umbral" => 15],
        ["id" => 43, "cantidad" => 37, "umbral" => 10],
        ["id" => 44, "cantidad" => 1, "umbral" => 12],
        ["id" => 45, "cantidad" => 45, "umbral" => 19],
        ["id" => 46, "cantidad" => 16, "umbral" => 11],
        ["id" => 47, "cantidad" => 8, "umbral" => 14],
        ["id" => 48, "cantidad" => 29, "umbral" => 20],
        ["id" => 49, "cantidad" => 0, "umbral" => 17], // BAJO
        ["id" => 50, "cantidad" => 22, "umbral" => 13],
        ["id" => 51, "cantidad" => 34, "umbral" => 18],
        ["id" => 52, "cantidad" => 12, "umbral" => 10],
        ["id" => 53, "cantidad" => 48, "umbral" => 16],
        ["id" => 54, "cantidad" => 19, "umbral" => 11],
        ["id" => 55, "cantidad" => 6, "umbral" => 15],
        ["id" => 56, "cantidad" => 31, "umbral" => 19],
        ["id" => 57, "cantidad" => 14, "umbral" => 12],
        ["id" => 58, "cantidad" => 40, "umbral" => 20],
        ["id" => 59, "cantidad" => 25, "umbral" => 17],
        ["id" => 60, "cantidad" => 8, "umbral" => 13],
        ["id" => 61, "cantidad" => 25, "umbral" => 15],
        ["id" => 62, "cantidad" => 7, "umbral" => 12],
        ["id" => 63, "cantidad" => 40, "umbral" => 18],
        ["id" => 64, "cantidad" => 5, "umbral" => 11], // BAJO
        ["id" => 65, "cantidad" => 33, "umbral" => 19],
        ["id" => 66, "cantidad" => 1, "umbral" => 14],
        ["id" => 67, "cantidad" => 48, "umbral" => 10],
        ["id" => 68, "cantidad" => 19, "umbral" => 20],
        ["id" => 69, "cantidad" => 2, "umbral" => 16], // BAJO
        ["id" => 70, "cantidad" => 22, "umbral" => 17],
        ["id" => 71, "cantidad" => 39, "umbral" => 13],
        ["id" => 72, "cantidad" => 10, "umbral" => 14],
        ["id" => 73, "cantidad" => 0, "umbral" => 10], // BAJO
        ["id" => 74, "cantidad" => 27, "umbral" => 19],
        ["id" => 75, "cantidad" => 44, "umbral" => 11],
        ["id" => 76, "cantidad" => 15, "umbral" => 14],
        ["id" => 77, "cantidad" => 30, "umbral" => 12],
        ["id" => 78, "cantidad" => 8, "umbral" => 20],
        ["id" => 79, "cantidad" => 41, "umbral" => 17],
        ["id" => 80, "cantidad" => 12, "umbral" => 16],
        ["id" => 81, "cantidad" => 28, "umbral" => 18],
        ["id" => 82, "cantidad" => 3, "umbral" => 15], // BAJO
        ["id" => 83, "cantidad" => 36, "umbral" => 10],
        ["id" => 84, "cantidad" => 9, "umbral" => 12],
        ["id" => 85, "cantidad" => 49, "umbral" => 19],
        ["id" => 86, "cantidad" => 17, "umbral" => 11],
        ["id" => 87, "cantidad" => 4, "umbral" => 14],
        ["id" => 88, "cantidad" => 32, "umbral" => 20],
        ["id" => 89, "cantidad" => 11, "umbral" => 17],
        ["id" => 90, "cantidad" => 24, "umbral" => 13],
        ["id" => 91, "cantidad" => 38, "umbral" => 18],
        ["id" => 92, "cantidad" => 6, "umbral" => 10],
        ["id" => 93, "cantidad" => 47, "umbral" => 16],
        ["id" => 94, "cantidad" => 14, "umbral" => 11],
        ["id" => 95, "cantidad" => 29, "umbral" => 15],
        ["id" => 96, "cantidad" => 1, "umbral" => 19],
        ["id" => 97, "cantidad" => 35, "umbral" => 12],
        ["id" => 98, "cantidad" => 13, "umbral" => 20],
        ["id" => 99, "cantidad" => 42, "umbral" => 17],
        ["id" => 100, "cantidad" => 20, "umbral" => 16],
        ["id" => 101, "cantidad" => 5, "umbral" => 18],
        ["id" => 102, "cantidad" => 23, "umbral" => 15],
        ["id" => 103, "cantidad" => 37, "umbral" => 10],
        ["id" => 104, "cantidad" => 2, "umbral" => 12], // BAJO
        ["id" => 105, "cantidad" => 46, "umbral" => 19]
    ];

    public $book_comments = [
    ["book_id" => 12, "user_id" => 7, "puntuacion" => 5, "comentario" => "Profundo, conmovedor y brillantemente escrito. ¡Cinco estrellas sin dudarlo!", "fecha_valoracion" => "2023-08-15"],
    ["book_id" => 3, "user_id" => 15, "puntuacion" => 2, "comentario" => "Algunas partes se me hicieron un poco lentas y predecibles.", "fecha_valoracion" => "2024-01-22"],
    ["book_id" => 18, "user_id" => 2, "puntuacion" => 4, "comentario" => "Muy buen libro, lo disfruté mucho. Algunos detalles menores, pero muy recomendable.", "fecha_valoracion" => "2023-11-03"],
    ["book_id" => 5, "user_id" => 7, "puntuacion" => 5, "comentario" => "¡Absolutamente fantástico! Una obra maestra, lo recomiendo encarecidamente.", "fecha_valoracion" => "2024-05-10"],
    ["book_id" => 12, "user_id" => 11, "puntuacion" => 1, "comentario" => "Muy flojo en todos los sentidos. No encontré nada destacable.", "fecha_valoracion" => "2023-03-29"],
    ["book_id" => 1, "user_id" => 3, "puntuacion" => 4, "comentario" => "Un libro que te hace reflexionar. Muy bien escrito y con personajes profundos.", "fecha_valoracion" => "2024-02-15"],
    ["book_id" => 2, "user_id" => 5, "puntuacion" => 3, "comentario" => "Entretenido pero no aporta nada nuevo al género. Aceptable.", "fecha_valoracion" => "2024-06-20"],
    ["book_id" => 4, "user_id" => 8, "puntuacion" => 5, "comentario" => "Una joya literaria. Me encantó cada página.", "fecha_valoracion" => "2023-12-05"],
    ["book_id" => 6, "user_id" => 10, "puntuacion" => 2, "comentario" => "No cumplió mis expectativas. La trama es predecible.", "fecha_valoracion" => "2024-03-18"],
    ["book_id" => 7, "user_id" => 12, "puntuacion" => 4, "comentario" => "Muy entretenido y con un buen ritmo. Lo disfruté mucho.", "fecha_valoracion" => "2023-09-22"],
    ["book_id" => 8, "user_id" => 14, "puntuacion" => 5, "comentario" => "Excelente narración y desarrollo de personajes. Muy recomendable.", "fecha_valoracion" => "2024-07-30"],
    ["book_id" => 9, "user_id" => 16, "puntuacion" => 1, "comentario" => "No me gustó para nada. Me pareció aburrido y sin sentido.", "fecha_valoracion" => "2023-10-11"],
    ["book_id" => 10, "user_id" => 18, "puntuacion" => 4, "comentario" => "Un libro que te atrapa desde el principio. Muy bien escrito.", "fecha_valoracion" => "2024-04-25"],
    ["book_id" => 1, "user_id" => 19, "puntuacion" => 3, "comentario" => "No está mal, pero tampoco me impactó profundamente. Cumple sin más.", "fecha_valoracion" => "2024-09-01"],
    ["book_id" => 7, "user_id" => 13, "puntuacion" => 3, "comentario" => "Para pasar el rato está bien, aunque no creo que lo relea pronto.", "fecha_valoracion" => "2024-03-10"],
    ["book_id" => 19, "user_id" => 2, "puntuacion" => 5, "comentario" => "Excelente en todos los aspectos. La trama, los personajes, el estilo... todo perfecto.", "fecha_valoracion" => "2023-07-28"],
    ["book_id" => 4, "user_id" => 20, "puntuacion" => 1, "comentario" => "Muy flojo en todos los sentidos. No encontré nada destacable.", "fecha_valoracion" => "2024-11-05"],
    ["book_id" => 11, "user_id" => 5, "puntuacion" => 4, "comentario" => "Casi perfecto. La narrativa es fluida y los personajes son creíbles.", "fecha_valoracion" => "2023-01-19"],
    ["book_id" => 2, "user_id" => 17, "puntuacion" => 2, "comentario" => "La idea era prometedora, pero la ejecución no estuvo a la altura para mi gusto.", "fecha_valoracion" => "2024-06-01"],
    ["book_id" => 15, "user_id" => 8, "puntuacion" => 5, "comentario" => "Una joya literaria. Este libro se quedará conmigo por mucho tiempo.", "fecha_valoracion" => "2023-09-12"],
    ["book_id" => 10, "user_id" => 3, "puntuacion" => 4, "comentario" => "Una historia sólida y bien desarrollada. Engancha bastante y te hace pensar.", "fecha_valoracion" => "2023-05-11"],
    ["book_id" => 1, "user_id" => 18, "puntuacion" => 5, "comentario" => "¡Absolutamente fantástico! Una obra maestra, lo recomiendo encarecidamente.", "fecha_valoracion" => "2024-02-09"],
    ["book_id" => 17, "user_id" => 6, "puntuacion" => 2, "comentario" => "Algunas partes se me hicieron un poco lentas y predecibles.", "fecha_valoracion" => "2023-10-30"],
    ["book_id" => 8, "user_id" => 1, "puntuacion" => 3, "comentario" => "Tiene sus momentos interesantes, pero es un poco irregular en general.", "fecha_valoracion" => "2024-07-14"],
    ["book_id" => 20, "user_id" => 12, "puntuacion" => 5, "comentario" => "Excelente en todos los aspectos. La trama, los personajes, el estilo... todo perfecto.", "fecha_valoracion" => "2023-04-01"],
    ["book_id" => 5, "user_id" => 9, "puntuacion" => 4, "comentario" => "Buena lectura, entretenida y con buen ritmo. Definitivamente vale la pena.", "fecha_valoracion" => "2024-08-22"],
    ["book_id" => 14, "user_id" => 4, "puntuacion" => 1, "comentario" => "Realmente decepcionante. No logré engancharme en ningún momento.", "fecha_valoracion" => "2023-12-07"],
    ["book_id" => 2, "user_id" => 16, "puntuacion" => 3, "comentario" => "Correcto. Ni fu ni fa, una historia que se deja leer.", "fecha_valoracion" => "2024-01-15"],
    ["book_id" => 13, "user_id" => 10, "puntuacion" => 5, "comentario" => "Me encantó de principio a fin, una lectura obligada. Superó mis expectativas.", "fecha_valoracion" => "2023-06-25"],
    ["book_id" => 6, "user_id" => 19, "puntuacion" => 2, "comentario" => "La idea era prometedora, pero la ejecución no estuvo a la altura para mi gusto.", "fecha_valoracion" => "2024-04-18"],
    ["book_id" => 16, "user_id" => 7, "puntuacion" => 4, "comentario" => "Me gustó bastante, aunque el final podría haber sido un poco diferente. Aún así, muy bueno.", "fecha_valoracion" => "2023-02-13"],
    ["book_id" => 9, "user_id" => 14, "puntuacion" => 5, "comentario" => "Una joya literaria. Este libro se quedará conmigo por mucho tiempo.", "fecha_valoracion" => "2024-10-02"],
    ["book_id" => 11, "user_id" => 8, "puntuacion" => 3, "comentario" => "Estuvo bien, una lectura pasable para entretenerse un rato.", "fecha_valoracion" => "2023-07-07"],
    ["book_id" => 18, "user_id" => 5, "puntuacion" => 1, "comentario" => "No pude terminarlo. La historia no me atrapó y los personajes me resultaron planos.", "fecha_valoracion" => "2024-05-30"],
    ["book_id" => 3, "user_id" => 17, "puntuacion" => 4, "comentario" => "Casi perfecto. La narrativa es fluida y los personajes son creíbles.", "fecha_valoracion" => "2023-09-20"]
    ];


    public $orders = [
        [
            "id" => 1, "user_id" => 7, "payment_type_id" => 2, "shipment_type_id" => 1, "fecha_orden" => "2024-03-15", "estado" => "entregado", "total" => 75.50,
            "items" => [
            [ "edition_id" => 12, "cantidad" => 1 ],
            [ "edition_id" => 33, "cantidad" => 2 ]
            ]
        ],
        [
            "id" => 2, "user_id" => 15, "payment_type_id" => 1, "shipment_type_id" => 2, "fecha_orden" => "2024-05-01", "estado" => "pendiente", "total" => 120.00,
            "items" => [
            [ "edition_id" => 5, "cantidad" => 3 ],
            [ "edition_id" => 78, "cantidad" => 1 ],
            [ "edition_id" => 101, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 3, "user_id" => 2, "payment_type_id" => 4, "shipment_type_id" => 1, "fecha_orden" => "2023-11-20", "estado" => "entregado", "total" => 45.90,
            "items" => [
            [ "edition_id" => 92, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 4, "user_id" => 19, "payment_type_id" => 3, "shipment_type_id" => 1, "fecha_orden" => "2024-07-01", "estado" => "pendiente", "total" => 210.75,
            "items" => [
            [ "edition_id" => 1, "cantidad" => 2 ],
            [ "edition_id" => 15, "cantidad" => 1 ],
            [ "edition_id" => 22, "cantidad" => 3 ],
            [ "edition_id" => 40, "cantidad" => 1 ],
            [ "edition_id" => 65, "cantidad" => 2 ]
            ]
        ],
        [
            "id" => 5, "user_id" => 7, "payment_type_id" => 5, "shipment_type_id" => 2, "fecha_orden" => "2024-06-18", "estado" => "entregado", "total" => 88.00,
            "items" => [
            [ "edition_id" => 50, "cantidad" => 1 ],
            [ "edition_id" => 88, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 6, "user_id" => 11, "payment_type_id" => 1, "shipment_type_id" => 1, "fecha_orden" => "2023-09-05", "estado" => "entregado", "total" => 30.25,
            "items" => [
            [ "edition_id" => 10, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 7, "user_id" => 4, "payment_type_id" => 2, "shipment_type_id" => 2, "fecha_orden" => "2024-04-22", "estado" => "pendiente", "total" => 155.50,
            "items" => [
            [ "edition_id" => 3, "cantidad" => 2 ],
            [ "edition_id" => 70, "cantidad" => 3 ],
            [ "edition_id" => 99, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 8, "user_id" => 20, "payment_type_id" => 3, "shipment_type_id" => 1, "fecha_orden" => "2024-01-10", "estado" => "entregado", "total" => 62.00,
            "items" => [
            [ "edition_id" => 45, "cantidad" => 1 ],
            [ "edition_id" => 61, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 9, "user_id" => 1, "payment_type_id" => 5, "shipment_type_id" => 1, "fecha_orden" => "2024-02-28", "estado" => "entregado", "total" => 190.00,
            "items" => [
            [ "edition_id" => 2, "cantidad" => 3 ],
            [ "edition_id" => 18, "cantidad" => 2 ],
            [ "edition_id" => 53, "cantidad" => 1 ],
            [ "edition_id" => 77, "cantidad" => 2 ]
            ]
        ],
        [
            "id" => 10, "user_id" => 13, "payment_type_id" => 4, "shipment_type_id" => 2, "fecha_orden" => "2023-12-12", "estado" => "pendiente", "total" => 99.99,
            "items" => [
            [ "edition_id" => 105, "cantidad" => 1 ],
            [ "edition_id" => 8, "cantidad" => 2 ]
            ]
        ],
        [
            "id" => 11, "user_id" => 6, "payment_type_id" => 1, "shipment_type_id" => 1, "fecha_orden" => "2024-07-03", "estado" => "pendiente", "total" => 25.00,
            "items" => [
            [ "edition_id" => 29, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 12, "user_id" => 18, "payment_type_id" => 2, "shipment_type_id" => 2, "fecha_orden" => "2024-05-25", "estado" => "entregado", "total" => 132.80,
            "items" => [
            [ "edition_id" => 37, "cantidad" => 2 ],
            [ "edition_id" => 68, "cantidad" => 1 ],
            [ "edition_id" => 91, "cantidad" => 3 ]
            ]
        ],
        [
            "id" => 13, "user_id" => 9, "payment_type_id" => 3, "shipment_type_id" => 1, "fecha_orden" => "2023-10-01", "estado" => "entregado", "total" => 175.00,
            "items" => [
            [ "edition_id" => 4, "cantidad" => 1 ],
            [ "edition_id" => 20, "cantidad" => 2 ],
            [ "edition_id" => 34, "cantidad" => 1 ],
            [ "edition_id" => 58, "cantidad" => 3 ],
            [ "edition_id" => 81, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 14, "user_id" => 3, "payment_type_id" => 4, "shipment_type_id" => 1, "fecha_orden" => "2024-03-08", "estado" => "pendiente", "total" => 59.50,
            "items" => [
            [ "edition_id" => 72, "cantidad" => 1 ],
            [ "edition_id" => 100, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 15, "user_id" => 16, "payment_type_id" => 5, "shipment_type_id" => 2, "fecha_orden" => "2024-06-05", "estado" => "entregado", "total" => 80.00,
            "items" => [
            [ "edition_id" => 14, "cantidad" => 2 ],
            [ "edition_id" => 48, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 16, "user_id" => 10, "payment_type_id" => 1, "shipment_type_id" => 1, "fecha_orden" => "2023-08-19", "estado" => "entregado", "total" => 42.00,
            "items" => [
            [ "edition_id" => 95, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 17, "user_id" => 5, "payment_type_id" => 2, "shipment_type_id" => 2, "fecha_orden" => "2024-02-14", "estado" => "pendiente", "total" => 110.20,
            "items" => [
            [ "edition_id" => 27, "cantidad" => 3 ],
            [ "edition_id" => 55, "cantidad" => 1 ],
            [ "edition_id" => 84, "cantidad" => 2 ]
            ]
        ],
        [
            "id" => 18, "user_id" => 14, "payment_type_id" => 3, "shipment_type_id" => 1, "fecha_orden" => "2024-04-03", "estado" => "entregado", "total" => 165.00,
            "items" => [
            [ "edition_id" => 7, "cantidad" => 1 ],
            [ "edition_id" => 30, "cantidad" => 2 ],
            [ "edition_id" => 63, "cantidad" => 3 ],
            [ "edition_id" => 90, "cantidad" => 1 ]
            ]
        ],
        [
            "id" => 19, "user_id" => 8, "payment_type_id" => 4, "shipment_type_id" => 2, "fecha_orden" => "2023-07-28", "estado" => "entregado", "total" => 70.70,
            "items" => [
            [ "edition_id" => 42, "cantidad" => 2 ]
            ]
        ],
        [
            "id" => 20, "user_id" => 12, "payment_type_id" => 5, "shipment_type_id" => 1, "fecha_orden" => "2024-01-02", "estado" => "pendiente", "total" => 220.00,
            "items" => [
            [ "edition_id" => 11, "cantidad" => 1 ],
            [ "edition_id" => 25, "cantidad" => 3 ],
            [ "edition_id" => 51, "cantidad" => 2 ],
            [ "edition_id" => 75, "cantidad" => 1 ],
            [ "edition_id" => 103, "cantidad" => 2 ]
            ]
        ]
    ];

    public $payment_types = [
        [ "id" => 1, "nombre" => "Tarjeta de crédito", "estado" => true ],
        [ "id" => 2, "nombre" => "Banca Interbank", "estado" => true ],
        [ "id" => 3, "nombre" => "Yape", "estado" => true ],
        [ "id" => 4, "nombre" => "Plin", "estado" => true ],
        [ "id" => 5, "nombre" => "Pago Efectivo", "estado" => true ]
    ];

    public $shipment_types = [
        [ "id" => 1, "nombre" => "Envío estándar" ],
        [ "id" => 2, "nombre" => "Delivery" ]
    ];

    public $promotions = [
        ["id" => 1, "nombre" => "Oferta Flash Fin de Semana", "tipo" => "todo", "modalidad_promocion" => "porcentual", "cantidad" => 15, "fecha_inicio" => "2024-08-02", "fecha_fin" => "2024-08-04", "estado" => true],
        ["id" => 2, "nombre" => "Amor por la Fantasía", "tipo" => "categoria", "target_id" => 2, "modalidad_promocion" => "monto_fijo", "cantidad" => 5.00, "fecha_inicio" => "2024-07-20", "fecha_fin" => "2024-08-20", "estado" => true],
        ["id" => 3, "nombre" => "Cyber Lunes Literario", "tipo" => "todo", "modalidad_promocion" => "porcentual", "cantidad" => 20, "fecha_inicio" => "2024-11-25", "fecha_fin" => "2024-11-25", "estado" => false],
        ["id" => 4, "nombre" => "Especial 'El Misterio del Reloj'", "tipo" => "libro", "target_id" => 1, "modalidad_promocion" => "porcentual", "cantidad" => 25, "fecha_inicio" => "2024-09-01", "fecha_fin" => "2024-09-15", "estado" => true],
        ["id" => 5, "nombre" => "Descuento Estudiantil en Ciencia", "tipo" => "categoria", "target_id" => 17, "modalidad_promocion" => "monto_fijo", "cantidad" => 7.50, "fecha_inicio" => "2024-08-15", "fecha_fin" => "2024-12-15", "estado" => true],
        ["id" => 6, "nombre" => "Liquidación Total por Aniversario", "tipo" => "todo", "modalidad_promocion" => "porcentual", "cantidad" => 30, "fecha_inicio" => "2025-01-10", "fecha_fin" => "2025-01-20", "estado" => false],
        ["id" => 7, "nombre" => "Pack Aventuras 'Crónicas de Valoria'", "tipo" => "libro", "target_id" => 2, "modalidad_promocion" => "monto_fijo", "cantidad" => 10.00, "fecha_inicio" => "2024-10-01", "fecha_fin" => "2024-10-31", "estado" => true],
        ["id" => 8, "nombre" => "Rebajas de Primavera en Poesía", "tipo" => "categoria", "target_id" => 4, "modalidad_promocion" => "porcentual", "cantidad" => 10, "fecha_inicio" => "2025-03-20", "fecha_fin" => "2025-04-20", "estado" => false],
        ["id" => 9, "nombre" => "Últimas Copias: Descuento en 'Cocina Molecular'", "tipo" => "libro", "target_id" => 3, "modalidad_promocion" => "monto_fijo", "cantidad" => 3.00, "fecha_inicio" => "2024-07-25", "fecha_fin" => "2024-08-10", "estado" => true],
        ["id" => 10, "nombre" => "Bienvenida: Tu Primer Libro con Descuento", "tipo" => "todo", "modalidad_promocion" => "porcentual", "cantidad" => 5, "fecha_inicio" => "2024-01-01", "fecha_fin" => "2024-12-31", "estado" => true]
    ];


    public $libros_all = [];

    public function mount()
    {
        // Datos de ejemplo (puedes omitirlos si ya están en propiedades públicas)
        $libros = $this->libros;
        $categorias = collect($this->categories);
        $autores = collect($this->authors);
        $ediciones = collect($this->editions);
        $editoriales = collect($this->editorials);

        $this->libros_all = collect($libros)->map(function ($libro) use ($categorias, $autores, $ediciones, $editoriales) {
            // Obtener nombres de categorías
            $categoria_nombres = collect($libro['categorías'])->map(function ($cat_id) use ($categorias) {
                return optional($categorias->firstWhere('id', $cat_id))['nombre'];
            })->filter()->values()->all();

            // Obtener nombres de autores
            $autor_nombres = collect($libro['autores'])->map(function ($aut_id) use ($autores) {
                $autor = $autores->firstWhere('id', $aut_id);
                return $autor ? $autor['nombre'] . ' ' . $autor['apellido'] : null;
            })->filter()->values()->all();

            // Obtener ediciones del libro actual
            $ediciones_libro = $ediciones->where('book_id', $libro['id']);

            // Obtener números de edición
            $numero_ediciones = $ediciones_libro->pluck('numero_edicion')->values()->all();

            // Elegir una editorial aleatoria de esas ediciones
            $editorial_id_random = $ediciones_libro->random()['editorial_id'] ?? null;
            $editorial_nombre = optional($editoriales->firstWhere('id', $editorial_id_random))['nombre'];

            return [
                'id' => $libro['id'],
                'titulo' => $libro['titulo'],
                'ISBN' => $libro['ISBN'],
                'descripcion' => $libro['descripcion'],
                'categorias' => $categoria_nombres,
                'autores' => $autor_nombres,
                'ediciones' => $numero_ediciones,
                'editorial' => $editorial_nombre,
            ];
        })->all();
    }


}
