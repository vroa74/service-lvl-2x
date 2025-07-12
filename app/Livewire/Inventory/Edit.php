<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Componente Livewire para editar inventario existente
 * 
 * Este componente está diseñado específicamente para la edición de inventario.
 * Requiere un ID de inventario válido para funcionar correctamente.
 */
class Edit extends Component
{
    use WithFileUploads;

    // ID del inventario a editar
    public $inventoryId;

    // Campos del formulario
    public $fecha_inv = '';
    public $user_id = '';
    public $res_id = '';
    public $fecha = '';
    public $dir = '';
    public $resguardante = '';
    public $resguardante_edit = '';
    public $user = '';
    public $is_pc = false;
    public $gpo = '';
    public $disp = '';
    public $type = '';
    public $articulo = '';
    public $ni = '';
    public $marca = '';
    public $modelo = '';
    public $ns = '';
    public $nombres = '';
    public $observaciones = '';
    public $status = false;

    // Modal properties
    public $showModal = false;
    public $modalTitle = '';
    public $modalType = '';
    public $userSearch = '';
    public $selectedUserId = null;
    public $selectedUserName = '';
    public $modalParam1 = null;

    protected $rules = [
        'fecha_inv' => 'nullable|date|before_or_equal:today',
        'user_id' => 'nullable|exists:users,id',
        'res_id' => 'nullable|exists:users,id',
        'fecha' => 'nullable|date|before_or_equal:today',
        'dir' => 'nullable|string|max:255',
        'resguardante' => 'nullable|string|max:70',
        'resguardante_edit' => 'nullable|string|max:255',
        'user' => 'nullable|string|max:140',
        'is_pc' => 'boolean',
        'gpo' => 'nullable|string|max:20',
        'disp' => 'nullable|string|max:30',
        'type' => 'nullable|string|max:30',
        'articulo' => 'nullable|string|max:70',
        'ni' => 'nullable|string|max:35',
        'marca' => 'nullable|string|max:50',
        'modelo' => 'nullable|string|max:50',
        'ns' => 'nullable|string|max:35',
        'nombres' => 'nullable|string|max:50',
        'observaciones' => 'nullable|string|max:1000',
        'status' => 'boolean',
    ];

    protected $messages = [
        'fecha_inv.date' => 'La fecha de inventario debe ser una fecha válida.',
        'fecha_inv.before_or_equal' => 'La fecha de inventario no puede ser futura.',
        'fecha.date' => 'La fecha debe ser una fecha válida.',
        'fecha.before_or_equal' => 'La fecha no puede ser futura.',
        'user_id.exists' => 'El usuario seleccionado no existe en la base de datos.',
        'res_id.exists' => 'El responsable seleccionado no existe en la base de datos.',
        'dir.max' => 'La dirección no puede tener más de 255 caracteres.',
        'resguardante.max' => 'El resguardante no puede tener más de 70 caracteres.',
        'resguardante_edit.max' => 'El campo editar resguardante no puede tener más de 255 caracteres.',
        'user.max' => 'El usuario no puede tener más de 140 caracteres.',
        'gpo.max' => 'El grupo no puede tener más de 20 caracteres.',
        'disp.max' => 'El dispositivo no puede tener más de 30 caracteres.',
        'type.max' => 'El tipo no puede tener más de 30 caracteres.',
        'articulo.max' => 'El artículo no puede tener más de 70 caracteres.',
        'ni.max' => 'El número de inventario no puede tener más de 35 caracteres.',
        'marca.max' => 'La marca no puede tener más de 50 caracteres.',
        'modelo.max' => 'El modelo no puede tener más de 50 caracteres.',
        'ns.max' => 'El número de serie no puede tener más de 35 caracteres.',
        'nombres.max' => 'Los nombres no pueden tener más de 50 caracteres.',
        'observaciones.max' => 'Las observaciones no pueden tener más de 1000 caracteres.',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->inventoryId = $id;
            $this->loadInventory();
        }
    }

    public function loadInventory()
    {
        $inventory = Inventory::with(['assignedUser', 'responsible'])->findOrFail($this->inventoryId);
        
        $this->fecha_inv = $inventory->fecha_inv;
        $this->user_id = $inventory->user_id;
        $this->res_id = $inventory->res_id;
        $this->fecha = $inventory->fecha;
        $this->dir = $inventory->dir;
        // Cargar el nombre del resguardante desde la relación si existe
        $this->resguardante = $inventory->responsible ? $inventory->responsible->name : $inventory->resguardante;
        // Inicializar el campo de edición del resguardante con el valor del campo resguardante
        $this->resguardante_edit = $inventory->resguardante;
        // Cargar el nombre del usuario desde la relación si existe
        $this->user = $inventory->assignedUser ? $inventory->assignedUser->name : $inventory->user;
        $this->is_pc = $inventory->is_pc;
        $this->gpo = $inventory->gpo;
        $this->disp = $inventory->disp;
        $this->type = $inventory->type;
        $this->articulo = $inventory->articulo;
        $this->ni = $inventory->ni;
        $this->marca = $inventory->marca;
        $this->modelo = $inventory->modelo;
        $this->ns = $inventory->ns;
        $this->nombres = $inventory->nombres;
        $this->observaciones = $inventory->observaciones;
        $this->status = $inventory->status;
    }

    public function openUserModal($type, $param1 = null)
    {
        $this->modalType = $type;
        $this->modalParam1 = $param1;
        
        if ($type === 'user') {
            $this->modalTitle = "Seleccionar Usuario";
        } elseif ($type === 'responsible') {
            $this->modalTitle = "Seleccionar Resguardante";
        }
        
        $this->showModal = true;
        $this->userSearch = '';
        $this->selectedUserId = null;
        $this->selectedUserName = '';
    }

    public function selectUser($userId, $userName)
    {
        $this->selectedUserId = $userId;
        $this->selectedUserName = $userName;

        if ($this->modalType === 'user') {
            $this->user_id = $userId;
            $this->user = $userName;
        } elseif ($this->modalType === 'responsible') {
            $this->res_id = $userId;
            $this->resguardante = $userName;
            $this->resguardante_edit = $userName;
        }

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->modalTitle = '';
        $this->modalType = '';
        $this->userSearch = '';
        $this->selectedUserId = null;
        $this->selectedUserName = '';
    }

    public function saveInventory()
    {
        try {
            // Validar los datos del formulario
            $this->validate();

            // Verificar que el inventario existe
            $inventory = Inventory::findOrFail($this->inventoryId);
            
            // Preparar los datos para actualizar
            $updateData = [
                'fecha_inv' => $this->fecha_inv ?: null,
                'user_id' => $this->user_id ?: null,
                'res_id' => $this->res_id ?: null,
                'fecha' => $this->fecha ?: null,
                'dir' => $this->dir ?: null,
                'resguardante' => $this->resguardante_edit ?: null,
                'user' => $this->user ?: null,
                'is_pc' => $this->is_pc,
                'gpo' => $this->gpo ?: null,
                'disp' => $this->disp ?: null,
                'type' => $this->type ?: null,
                'articulo' => $this->articulo ?: null,
                'ni' => $this->ni ?: null,
                'marca' => $this->marca ?: null,
                'modelo' => $this->modelo ?: null,
                'ns' => $this->ns ?: null,
                'nombres' => $this->nombres ?: null,
                'observaciones' => $this->observaciones ?: null,
                'status' => $this->status,
            ];

            // Actualizar el inventario
            $inventory->update($updateData);

            session()->flash('message', 'Artículo de inventario actualizado correctamente.');
            return redirect()->route('inventario.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Errores de validación
            Log::error('Error de validación al actualizar inventario: ' . json_encode($e->errors()));
            $errorMessages = [];
            foreach ($e->errors() as $field => $errors) {
                $errorMessages = array_merge($errorMessages, $errors);
            }
            session()->flash('error', 'Error de validación: ' . implode(', ', $errorMessages));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Inventario no encontrado
            Log::error('Inventario no encontrado: ' . $this->inventoryId);
            session()->flash('error', 'Error: El artículo de inventario no fue encontrado.');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Errores de base de datos
            Log::error('Error de base de datos al actualizar inventario: ' . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                session()->flash('error', 'Error: El usuario o responsable seleccionado no existe en la base de datos.');
            } elseif (str_contains($e->getMessage(), 'duplicate entry')) {
                session()->flash('error', 'Error: Ya existe un artículo con los mismos datos únicos.');
            } else {
                session()->flash('error', 'Error de base de datos: ' . $e->getMessage());
            }
            
        } catch (\Exception $e) {
            // Otros errores
            Log::error('Error inesperado al actualizar inventario: ' . $e->getMessage());
            session()->flash('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function updatedArticulo()
    {
        $this->validateOnly('articulo');
    }

    public function updatedFechaInv()
    {
        $this->validateOnly('fecha_inv');
    }

    public function updatedFecha()
    {
        $this->validateOnly('fecha');
    }

    public function updatedResguardanteEdit()
    {
        $this->validateOnly('resguardante_edit');
    }

    public function updatedDir()
    {
        $this->validateOnly('dir');
    }

    public function updatedType()
    {
        $this->validateOnly('type');
    }

    public function render()
    {
        $users = User::when($this->userSearch, function ($query) {
            $query->where('name', 'like', '%' . $this->userSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->userSearch . '%');
        })->get();

        return view('livewire.inventory.edit', [
            'users' => $users
        ]);
    }
}
