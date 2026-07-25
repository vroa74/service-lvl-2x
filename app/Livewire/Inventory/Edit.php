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
    public $apa = '';
    public $ama = '';
    public $fullname = '';
    public $software_instalado = '';
    public $info_pc = '';
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
        'dir' => 'nullable|string|max:40',
        'resguardante' => 'nullable|string|max:70',
        'resguardante_edit' => 'nullable|string|max:70',
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
        'apa' => 'nullable|string|max:35',
        'ama' => 'nullable|string|max:35',
        'fullname' => 'nullable|string',
        'software_instalado' => 'nullable|string',
        'info_pc' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'status' => 'boolean',
    ];

    protected $messages = [
        'fecha_inv.date' => 'La fecha de inventario debe ser una fecha válida.',
        'fecha_inv.before_or_equal' => 'La fecha de inventario no puede ser futura.',
        'fecha.date' => 'La fecha debe ser una fecha válida.',
        'fecha.before_or_equal' => 'La fecha no puede ser futura.',
        'user_id.exists' => 'El usuario seleccionado no existe en la base de datos.',
        'res_id.exists' => 'El responsable seleccionado no existe en la base de datos.',
        'dir.max' => 'La dirección no puede tener más de 40 caracteres.',
        'resguardante.max' => 'El resguardante no puede tener más de 70 caracteres.',
        'resguardante_edit.max' => 'El campo editar resguardante no puede tener más de 70 caracteres.',
        'apa.max' => 'El campo APA no puede tener más de 35 caracteres.',
        'ama.max' => 'El campo AMA no puede tener más de 35 caracteres.',
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
        $this->apa = $inventory->apa;
        $this->ama = $inventory->ama;
        $this->fullname = $inventory->fullname;
        $this->software_instalado = $inventory->software_instalado;
        $this->info_pc = $inventory->info_pc;
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
                'apa' => $this->apa ?: null,
                'ama' => $this->ama ?: null,
                'fullname' => $this->fullname ?: null,
                'software_instalado' => $this->software_instalado ?: null,
                'info_pc' => $this->info_pc ?: null,
                'observaciones' => $this->observaciones ?: null,
                'status' => $this->status,
            ];

            // Actualizar el inventario
            $inventory->update($updateData);

            session()->flash('message', '✅ Artículo de inventario actualizado correctamente.');
            return redirect()->route('inventario.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Errores de validación - Mensajes más específicos
            Log::error('Error de validación al actualizar inventario: ' . json_encode($e->errors()));
            
            $errorDetails = [];
            foreach ($e->errors() as $field => $errors) {
                $fieldName = $this->getFieldDisplayName($field);
                foreach ($errors as $error) {
                    $errorDetails[] = "• {$fieldName}: {$error}";
                }
            }
            
            $errorMessage = "❌ Error de validación en los siguientes campos:\n" . implode("\n", $errorDetails);
            session()->flash('error', $errorMessage);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Inventario no encontrado
            Log::error('Inventario no encontrado: ' . $this->inventoryId);
            session()->flash('error', '❌ Error: El artículo de inventario con ID ' . $this->inventoryId . ' no fue encontrado en la base de datos. Es posible que haya sido eliminado.');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Errores de base de datos - Mensajes más específicos
            Log::error('Error de base de datos al actualizar inventario: ' . $e->getMessage());
            
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            
            if (str_contains($errorMessage, 'foreign key constraint')) {
                if (str_contains($errorMessage, 'user_id')) {
                    session()->flash('error', '❌ Error: El usuario seleccionado ya no existe en la base de datos. Por favor, seleccione un usuario válido.');
                } elseif (str_contains($errorMessage, 'res_id')) {
                    session()->flash('error', '❌ Error: El responsable seleccionado ya no existe en la base de datos. Por favor, seleccione un responsable válido.');
                } else {
                    session()->flash('error', '❌ Error: Uno de los usuarios seleccionados ya no existe en la base de datos. Por favor, verifique las selecciones.');
                }
            } elseif (str_contains($errorMessage, 'duplicate entry')) {
                if (str_contains($errorMessage, 'ni')) {
                    session()->flash('error', '❌ Error: Ya existe un artículo con el mismo Número de Inventario (NI): ' . $this->ni . '. Los números de inventario deben ser únicos.');
                } elseif (str_contains($errorMessage, 'ns')) {
                    session()->flash('error', '❌ Error: Ya existe un artículo con el mismo Número de Serie (NS): ' . $this->ns . '. Los números de serie deben ser únicos.');
                } else {
                    session()->flash('error', '❌ Error: Ya existe un artículo con los mismos datos únicos. Verifique que no esté duplicando información.');
                }
            } elseif (str_contains($errorMessage, 'Data too long')) {
                session()->flash('error', '❌ Error: Uno o más campos exceden el límite de caracteres permitido. Verifique la longitud de los datos ingresados.');
            } elseif (str_contains($errorMessage, 'Cannot add or update a child row')) {
                session()->flash('error', '❌ Error: No se puede actualizar el registro porque hay restricciones de integridad en la base de datos.');
            } else {
                session()->flash('error', '❌ Error de base de datos: ' . $errorMessage . ' (Código: ' . $errorCode . ')');
            }
            
        } catch (\Exception $e) {
            // Otros errores
            Log::error('Error inesperado al actualizar inventario: ' . $e->getMessage());
            session()->flash('error', '❌ Error inesperado del sistema: ' . $e->getMessage() . '. Por favor, contacte al administrador si el problema persiste.');
        }
    }

    /**
     * Obtiene el nombre de visualización para los campos del formulario
     */
    private function getFieldDisplayName($field)
    {
        $fieldNames = [
            'fecha_inv' => 'Fecha de Inventario',
            'user_id' => 'Usuario',
            'res_id' => 'Responsable',
            'fecha' => 'Fecha',
            'dir' => 'Dirección',
            'resguardante' => 'Resguardante',
            'resguardante_edit' => 'Nombre del Resguardante',
            'user' => 'Usuario',
            'is_pc' => 'Es PC',
            'gpo' => 'Grupo',
            'disp' => 'Dispositivo',
            'type' => 'Tipo',
            'articulo' => 'Artículo',
            'ni' => 'Número de Inventario',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'ns' => 'Número de Serie',
            'nombres' => 'Nombres',
            'apa' => 'APA',
            'ama' => 'AMA',
            'fullname' => 'Nombre Completo',
            'software_instalado' => 'Software Instalado',
            'info_pc' => 'Información PC',
            'observaciones' => 'Observaciones',
            'status' => 'Estado',
        ];

        return $fieldNames[$field] ?? ucfirst(str_replace('_', ' ', $field));
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
