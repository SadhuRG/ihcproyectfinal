<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class ProfileDirecciones extends Component
{
    // Propiedades para el formulario
    public $name;
    public $apellido;
    public $telefono;
    public $documento_tipo = 'DNI';
    public $numero_documento;
    public $calle;
    public $numero_piso;
    public $numero_departamento;
    public $referencia;
    public $provincia;
    public $distrito;
    public $departamento;

    // Estados del componente
    public $showForm = false;
    public $editingAddress = null;
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Direcciones del usuario
    public $addresses;

    protected $rules = [
        'name' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'numero_documento' => 'required|string|max:20',
        'calle' => 'required|string|max:255',
        'numero_piso' => 'nullable|string|max:10',
        'numero_departamento' => 'nullable|string|max:10',
        'referencia' => 'nullable|string|max:500',
        'provincia' => 'required|string|max:100',
        'distrito' => 'required|string|max:100',
        'departamento' => 'required|string|max:100',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'apellido.required' => 'Los apellidos son obligatorios.',
        'telefono.required' => 'El número de teléfono es obligatorio.',
        'numero_documento.required' => 'El número de documento es obligatorio.',
        'calle.required' => 'La calle es obligatoria.',
        'provincia.required' => 'La provincia es obligatoria.',
        'distrito.required' => 'El distrito es obligatorio.',
        'departamento.required' => 'El departamento es obligatorio.',
    ];

    public function mount()
    {
        $this->loadAddresses();
        $this->fillUserData();
    }

    public function loadAddresses()
    {
        $this->addresses = Auth::user()->addresses()->get();
    }

    public function fillUserData()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->apellido = $user->apellido;
        $this->telefono = $user->telefono;
        $this->numero_documento = $user->telefono; // Asumiendo que usas teléfono como documento temporalmente
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;

        if (!$this->showForm) {
            $this->resetForm();
        }
    }

    public function editAddress($addressId)
    {
        $this->editingAddress = $this->addresses->find($addressId);

        if ($this->editingAddress) {
            $this->fillFormWithAddress($this->editingAddress);
            $this->showForm = true;
        }
    }

    public function fillFormWithAddress($address)
    {
        $this->calle = $address->calle;
        $this->numero_piso = $address->numero_piso;
        $this->numero_departamento = $address->numero_departamento;
        $this->referencia = $address->referencia;
        $this->provincia = $address->provincia;
        $this->distrito = $address->distrito;
        $this->departamento = $address->departamento;
    }

    public function saveAddress()
    {
        $this->validate();

        try {
            $addressData = [
                'user_id' => Auth::id(),
                'calle' => $this->calle,
                'numero_piso' => $this->numero_piso,
                'numero_departamento' => $this->numero_departamento,
                'referencia' => $this->referencia,
                'provincia' => $this->provincia,
                'distrito' => $this->distrito,
                'departamento' => $this->departamento,
            ];

            if ($this->editingAddress) {
                // Actualizar dirección existente
                $this->editingAddress->update($addressData);
                $this->showSuccessNotification('Dirección actualizada correctamente.');
            } else {
                // Crear nueva dirección
                Address::create($addressData);
                $this->showSuccessNotification('Dirección guardada correctamente.');
            }

            $this->loadAddresses();
            $this->resetForm();
            $this->showForm = false;

        } catch (\Exception $e) {
            $this->showErrorNotification('Error al guardar la dirección: ' . $e->getMessage());
        }
    }

    public function deleteAddress($addressId)
    {
        try {
            $address = Auth::user()->addresses()->find($addressId);

            if ($address) {
                $address->delete();
                $this->loadAddresses();
                $this->showSuccessNotification('Dirección eliminada correctamente.');
            }

        } catch (\Exception $e) {
            $this->showErrorNotification('Error al eliminar la dirección: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->editingAddress = null;
        $this->reset(['calle', 'numero_piso', 'numero_departamento', 'referencia', 'provincia', 'distrito', 'departamento']);
        $this->resetErrorBag();
        $this->fillUserData(); // Mantener datos del usuario
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

    public function render()
    {
        return view('livewire.profile-direcciones');
    }
}
