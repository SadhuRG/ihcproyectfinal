<?php

namespace App\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserSupport extends Component
{
    public $asunto = '';
    public $mensaje = '';
    public $showCreateModal = false;
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';
    public $ticketActivo = null;

    public function mount()
    {
        // Verificar si el usuario tiene un ticket activo
        if (Auth::check()) {
            $this->ticketActivo = SupportTicket::getActiveTicket(Auth::id());
        }
    }

    public function abrirModal()
    {
        if (!$this->puedeCrearTicket()) {
            $this->showNotification = true;
            $this->notificationMessage = 'Ya tienes un ticket de soporte activo. Debes esperar a que sea solucionado para crear uno nuevo.';
            $this->notificationType = 'error';
            return;
        }

        $this->showCreateModal = true;
    }

    public function cerrarModal()
    {
        $this->showCreateModal = false;
        $this->asunto = '';
        $this->mensaje = '';
    }

    public function enviarTicket()
    {
        $this->validate([
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string|max:1000'
        ], [
            'asunto.required' => 'El asunto es obligatorio.',
            'asunto.max' => 'El asunto no puede exceder 255 caracteres.',
            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.max' => 'El mensaje no puede exceder 1000 caracteres.'
        ]);

        // Verificar límite de palabras
        if (SupportTicket::exceedsWordLimit($this->mensaje, 500)) {
            $this->showNotification = true;
            $this->notificationMessage = 'El mensaje no puede exceder 500 palabras.';
            $this->notificationType = 'error';
            return;
        }

        // Verificar que el usuario puede crear un ticket
        if (!$this->puedeCrearTicket()) {
            $this->showNotification = true;
            $this->notificationMessage = 'Ya tienes un ticket de soporte activo. Debes esperar a que sea solucionado para crear uno nuevo.';
            $this->notificationType = 'error';
            return;
        }

        try {
            SupportTicket::create([
                'user_id' => Auth::id(),
                'asunto' => $this->asunto,
                'mensaje_usuario' => $this->mensaje,
                'estado' => 'enviado'
            ]);

            $this->cerrarModal();
            $this->showNotification = true;
            $this->notificationMessage = 'Tu ticket de soporte ha sido enviado correctamente. Te notificaremos cuando recibamos una respuesta.';
            $this->notificationType = 'success';

            // Actualizar el ticket activo
            $this->ticketActivo = SupportTicket::getActiveTicket(Auth::id());

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al enviar el ticket de soporte.';
            $this->notificationType = 'error';
        }
    }

    public function puedeCrearTicket()
    {
        return Auth::check() && SupportTicket::canUserCreateTicket(Auth::id());
    }

    public function getContadorPalabras()
    {
        return SupportTicket::countWords($this->mensaje);
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
        $this->notificationType = 'success';
    }

    public function render()
    {
        return view('livewire.user-support');
    }
}
