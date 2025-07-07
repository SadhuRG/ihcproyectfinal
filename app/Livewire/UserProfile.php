<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    use WithFileUploads;

    // Propiedades del perfil
    public $name;
    public $apellido;
    public $email;
    public $telefono;
    public $fecha_n;
    public $photo;
    public $currentPhoto;

    // Propiedades para cambio de contraseña
    public $current_password;
    public $new_password;
    public $confirm_password;
    public $showPasswordFields = false;

    // Propiedades para notificaciones
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Estadísticas del usuario
    public $ordersCount = 0;
    public $favoriteBooksCount = 0;
    public $commentsCount = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'apellido' => 'nullable|string|max:255',
        'telefono' => 'nullable|numeric|digits_between:9,15',
        'fecha_n' => 'nullable|date|before:today',
        'photo' => 'nullable|image|max:2048', // 2MB máximo
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.max' => 'El nombre no puede tener más de 255 caracteres.',
        'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
        'fecha_n.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        'fecha_n.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
        'photo.image' => 'El archivo debe ser una imagen.',
        'photo.max' => 'La imagen no puede ser mayor a 2MB.',
        'current_password.required' => 'La contraseña actual es obligatoria.',
        'new_password.required' => 'La nueva contraseña es obligatoria.',
        'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
        'confirm_password.required' => 'Debes confirmar la nueva contraseña.',
        'confirm_password.same' => 'Las contraseñas no coinciden.',
    ];

    public function mount()
    {
        $user = Auth::user();

        // Pre-llenar todos los campos con los datos del usuario
        $this->fill([
            'name' => $user->name,
            'apellido' => $user->apellido,
            'email' => $user->email, // Solo para mostrar, no se puede editar
            'telefono' => $user->telefono,
            'fecha_n' => $user->fecha_n ? $user->fecha_n->format('Y-m-d') : '',
        ]);

        $this->currentPhoto = $user->url_foto ? Storage::url($user->url_foto) : null;

        // Cargar estadísticas
        $this->loadUserStats();
    }

    public function loadUserStats()
    {
        $user = Auth::user();

        $this->ordersCount = $user->orders()->count();
        $this->favoriteBooksCount = $user->favoriteBooks()->count();
        $this->commentsCount = $user->comments()->count();
    }

    public function updated($propertyName)
    {
        // Validación cuando el usuario cambia los valores del perfil
        if (in_array($propertyName, ['name', 'apellido', 'telefono', 'fecha_n'])) {
            $this->validateOnly($propertyName);
        }

        // Validación en tiempo real para contraseñas cuando están activas
        if ($this->showPasswordFields) {
            if ($propertyName === 'new_password' && !empty($this->new_password)) {
                $this->validateOnly('new_password', [
                    'new_password' => ['required', 'min:8']
                ], [
                    'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.'
                ]);
            }

            if ($propertyName === 'confirm_password' && !empty($this->confirm_password)) {
                $this->validateOnly('confirm_password', [
                    'confirm_password' => 'same:new_password'
                ], [
                    'confirm_password.same' => 'Las contraseñas no coinciden.'
                ]);
            }
        }
    }

    public function updateProfile()
    {
        // Validar sin incluir email (está bloqueado)
        logger('updateProfile ejecutado');
        $this->validate($this->rules);

        try {
            $user = Auth::user();

            // Actualizar datos básicos (sin email)
            $user->update([
                'name' => $this->name,
                'apellido' => $this->apellido,
                'telefono' => $this->telefono,
                'fecha_n' => $this->fecha_n ?: null,
            ]);

            // Manejar foto de perfil
            if ($this->photo) {
                // Eliminar foto anterior si existe
                if ($user->url_foto && Storage::exists($user->url_foto)) {
                    Storage::delete($user->url_foto);
                }

                // Guardar nueva foto
                $photoPath = $this->photo->store('profile-photos', 'public');
                $user->update(['url_foto' => $photoPath]);
                $this->currentPhoto = Storage::url($photoPath);
                $this->photo = null;
            }

            $this->showSuccessNotification('Perfil actualizado correctamente.');

        } catch (\Exception $e) {
            $this->showErrorNotification('Error al actualizar el perfil: ' . $e->getMessage());
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'min:8', 'different:current_password'],
            'confirm_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'new_password.required' => 'La nueva contraseña es obligatoria.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.different' => 'La nueva contraseña debe ser diferente a la actual.',
            'confirm_password.required' => 'Debes confirmar la nueva contraseña.',
            'confirm_password.same' => 'Las contraseñas no coinciden.',
        ]);

        try {
            $user = Auth::user();

            // Verificar contraseña actual
            if (!Hash::check($this->current_password, $user->password)) {
                $this->addError('current_password', 'La contraseña actual es incorrecta.');
                return;
            }

            // Actualizar contraseña
            $user->update([
                'password' => Hash::make($this->new_password)
            ]);

            // Limpiar campos
            $this->reset(['current_password', 'new_password', 'confirm_password']);
            $this->showPasswordFields = false;

            $this->showSuccessNotification('Contraseña actualizada correctamente.');

        } catch (\Exception $e) {
            $this->showErrorNotification('Error al actualizar la contraseña: ' . $e->getMessage());
        }
    }

    public function removePhoto()
    {
        try {
            $user = Auth::user();

            if ($user->url_foto && Storage::exists($user->url_foto)) {
                Storage::delete($user->url_foto);
            }

            $user->update(['url_foto' => null]);
            $this->currentPhoto = null;
            $this->photo = null;

            $this->showSuccessNotification('Foto eliminada correctamente.');

        } catch (\Exception $e) {
            $this->showErrorNotification('Error al eliminar la foto: ' . $e->getMessage());
        }
    }

    public function togglePasswordFields()
    {
        $this->showPasswordFields = !$this->showPasswordFields;

        if (!$this->showPasswordFields) {
            // Limpiar campos y errores cuando se cancela
            $this->reset(['current_password', 'new_password', 'confirm_password']);
            $this->resetErrorBag(['current_password', 'new_password', 'confirm_password']);
        }
    }

    private function showSuccessNotification($message)
    {
        $this->notificationMessage = $message;
        $this->notificationType = 'success';
        $this->showNotification = true;

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $message
        ]);
    }

    private function showErrorNotification($message)
    {
        $this->notificationMessage = $message;
        $this->notificationType = 'error';
        $this->showNotification = true;

        $this->dispatch('notify', [
            'type' => 'error',
            'message' => $message
        ]);
    }

    public function hydrate()
    {
        // Asegurar que los datos persistan en cada request de Livewire
        if (empty($this->email)) {
            $user = Auth::user();
            $this->email = $user->email;
        }
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}

