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
    public $gpo_pc_user = '';
    public $fullname = '';
    public $software_instalado = '';
    public $info = '';
    public $esp = '';
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
        'fecha_inv' => 'nullable|date',
        'user_id' => 'nullable|exists:users,id',
        'res_id' => 'nullable|exists:users,id',
        'fecha' => 'nullable|date',
        'dir' => 'nullable|string',
        'resguardante' => 'nullable|string',
        'user' => 'nullable|string',
        'is_pc' => 'boolean',
        'gpo' => 'nullable|string',
        'disp' => 'nullable|string',
        'type' => 'nullable|string',
        'articulo' => 'nullable|string',
        'ni' => 'nullable|string',
        'marca' => 'nullable|string',
        'modelo' => 'nullable|string',
        'ns' => 'nullable|string',
        'nombres' => 'nullable|string',
        'apa' => 'nullable|string',
        'ama' => 'nullable|string',
        'gpo_pc_user' => 'nullable|string',
        'fullname' => 'nullable|string',
        'software_instalado' => 'nullable|string',
        'info' => 'nullable|string',
        'esp' => 'nullable|string',
        'status' => 'boolean',
    ];

    protected $messages = [
        'fecha_inv.date' => 'La fecha de inventario debe ser válida',
        'fecha.date' => 'La fecha debe ser válida',
        'user_id.exists' => 'El usuario debe ser válido',
        'res_id.exists' => 'El responsable debe ser un usuario válido',
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
        $inventory = Inventory::findOrFail($this->inventoryId);
        
        $this->fecha_inv = $inventory->fecha_inv;
        $this->user_id = $inventory->user_id;
        $this->res_id = $inventory->res_id;
        $this->fecha = $inventory->fecha;
        $this->dir = $inventory->dir;
        $this->resguardante = $inventory->resguardante;
        $this->user = $inventory->user;
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
        $this->gpo_pc_user = $inventory->gpo_pc_user;
        $this->fullname = $inventory->fullname;
        $this->software_instalado = $inventory->software_instalado;
        $this->info = $inventory->info;
        $this->esp = $inventory->esp;
        $this->status = $inventory->status;
    }

    public function openUserModal($type, $param1 = null)
    {
        $this->modalType = $type;
        $this->modalParam1 = $param1;
        $this->modalTitle = "Seleccionar Usuario - Tipo: {$type}";
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
        $this->validate();

        try {
            $inventory = Inventory::findOrFail($this->inventoryId);
            
            $inventory->update([
                'fecha_inv' => $this->fecha_inv,
                'user_id' => $this->user_id,
                'res_id' => $this->res_id,
                'fecha' => $this->fecha,
                'dir' => $this->dir,
                'resguardante' => $this->resguardante,
                'user' => $this->user,
                'is_pc' => $this->is_pc,
                'gpo' => $this->gpo,
                'disp' => $this->disp,
                'type' => $this->type,
                'articulo' => $this->articulo,
                'ni' => $this->ni,
                'marca' => $this->marca,
                'modelo' => $this->modelo,
                'ns' => $this->ns,
                'nombres' => $this->nombres,
                'apa' => $this->apa,
                'ama' => $this->ama,
                'gpo_pc_user' => $this->gpo_pc_user,
                'fullname' => $this->fullname,
                'software_instalado' => $this->software_instalado,
                'info' => $this->info,
                'esp' => $this->esp,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Artículo de inventario actualizado correctamente.');
            return redirect()->route('inventario.index');

        } catch (\Exception $e) {
            Log::error('Error al actualizar inventario: ' . $e->getMessage());
            session()->flash('error', 'Error al actualizar el artículo de inventario.');
        }
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
