<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Component
{
    use WithFileUploads;

    // Datos del perfil
    public $name;
    public $apellido;
    public $email;
    public $telefono;
    public $fecha_n;
    public $url_foto;
    public $currentPhoto;

    // Cambio de contraseña
    public $current_password;
    public $new_password;
    public $confirm_password;
    public $showPasswordFields = false;

    // Notificaciones
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Foto de perfil
    public $photo;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->apellido = $user->apellido;
        $this->email = $user->email;
        $this->telefono = $user->telefono;
        $this->fecha_n = $user->fecha_n ? $user->fecha_n->format('Y-m-d') : '';
        $this->url_foto = $user->url_foto;
        $this->currentPhoto = $user->url_foto;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'nullable|image|max:1024|mimes:jpg,jpeg,png,gif',
        ]);
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'telefono' => 'nullable|numeric|digits_between:9,15',
            'fecha_n' => 'nullable|date|before:today',
            'photo' => 'nullable|image|max:1024|mimes:jpg,jpeg,png,gif',
        ]);

        try {
            $user = Auth::user();
            
            // Procesar foto si se subió una nueva
            if ($this->photo) {
                // Eliminar foto anterior si existe
                if ($user->url_foto && !str_contains($user->url_foto, 'http')) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $user->url_foto));
                }
                
                // Guardar nueva foto
                $photoPath = $this->photo->store('profile-photos', 'public');
                $this->url_foto = '/storage/' . $photoPath;
            }

            // Actualizar datos del usuario
            $user->update([
                'name' => $this->name,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'fecha_n' => $this->fecha_n,
                'url_foto' => $this->url_foto,
            ]);

            $this->currentPhoto = $this->url_foto;
            $this->photo = null; // Limpiar la foto temporal después de guardar
            
            $this->mostrarNotificacion('Perfil actualizado correctamente.', 'success');
            
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al actualizar el perfil: ' . $e->getMessage(), 'error');
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        try {
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($this->new_password)
            ]);

            // Limpiar campos
            $this->current_password = '';
            $this->new_password = '';
            $this->confirm_password = '';
            $this->showPasswordFields = false;

            $this->mostrarNotificacion('Contraseña actualizada correctamente.', 'success');
            
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al actualizar la contraseña: ' . $e->getMessage(), 'error');
        }
    }

    public function togglePasswordFields()
    {
        $this->showPasswordFields = !$this->showPasswordFields;
        if (!$this->showPasswordFields) {
            $this->resetPasswordFields();
        }
    }

    public function resetPasswordFields()
    {
        $this->current_password = '';
        $this->new_password = '';
        $this->confirm_password = '';
    }

    public function removePhoto()
    {
        try {
            $user = Auth::user();
            
            // Eliminar foto anterior si existe
            if ($user->url_foto && !str_contains($user->url_foto, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->url_foto));
            }
            
            // Actualizar usuario sin foto
            $user->update(['url_foto' => null]);
            
            $this->currentPhoto = null;
            $this->url_foto = null;
            $this->photo = null; // Limpiar también la foto temporal
            
            $this->mostrarNotificacion('Foto de perfil eliminada correctamente.', 'success');
            
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al eliminar la foto: ' . $e->getMessage(), 'error');
        }
    }

    public function mostrarNotificacion($mensaje, $tipo = 'success')
    {
        $this->notificationMessage = $mensaje;
        $this->notificationType = $tipo;
        $this->showNotification = true;
        
        // Ocultar notificación después de 5 segundos
        $this->dispatch('notify', [
            'message' => $mensaje,
            'type' => $tipo
        ]);
    }

    public function render()
    {
        return view('livewire.user-profile')
            ->layout('components.layouts.app');
    }
} 