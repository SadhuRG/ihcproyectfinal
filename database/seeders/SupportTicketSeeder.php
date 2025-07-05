<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportTicket;
use App\Models\User;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el usuario creado en el seeder (asumiendo que es el primer usuario)
        $user = User::first();
        
        if ($user) {
            // Crear algunos tickets de ejemplo
            SupportTicket::create([
                'user_id' => $user->id,
                'asunto' => 'Problema con la descarga de libros',
                'mensaje_usuario' => 'Hola, he intentado descargar el libro "Cien años de Soledad" pero no puedo acceder al PDF. El sistema me muestra un error 404. ¿Podrían ayudarme a resolver este problema?',
                'mensaje_admin' => 'Hola, hemos revisado tu solicitud. El problema se debe a que el archivo PDF no está disponible en este momento. Estamos trabajando para solucionarlo y te notificaremos cuando esté listo. Gracias por tu paciencia.',
                'estado' => 'solucionado',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(2),
            ]);

            SupportTicket::create([
                'user_id' => $user->id,
                'asunto' => 'Error en el proceso de pago',
                'mensaje_usuario' => 'Buenos días, cuando intento realizar una compra, el sistema me muestra un error en el proceso de pago. He intentado con diferentes tarjetas pero el problema persiste. ¿Podrían revisar qué está pasando?',
                'mensaje_admin' => null,
                'estado' => 'recibido',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
            ]);

            SupportTicket::create([
                'user_id' => $user->id,
                'asunto' => 'Solicitud de nuevo libro',
                'mensaje_usuario' => 'Me gustaría sugerir que agreguen el libro "El Aleph" de Jorge Luis Borges a su catálogo. Es una obra muy importante de la literatura latinoamericana y creo que muchos usuarios la disfrutarían.',
                'mensaje_admin' => 'Gracias por tu sugerencia. Hemos tomado nota de tu solicitud y la hemos agregado a nuestra lista de libros para futuras adquisiciones. Te notificaremos cuando el libro esté disponible.',
                'estado' => 'solucionado',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(8),
            ]);
        }
    }
}
