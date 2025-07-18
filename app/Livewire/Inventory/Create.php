<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

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
    public $status = true;

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

    public function mount()
    {
        // Establecer valores por defecto
        $this->fecha_inv = now()->format('Y-m-d');
        $this->fecha = now()->format('Y-m-d');
        $this->status = true;
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
            $inventory = Inventory::create([
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

            session()->flash('message', 'Artículo de inventario creado correctamente.');
            return redirect()->route('inventario.index');

        } catch (\Exception $e) {
            Log::error('Error al crear inventario: ' . $e->getMessage());
            session()->flash('error', 'Error al crear el artículo de inventario.');
        }
    }

    public function render()
    {
        $users = User::when($this->userSearch, function ($query) {
            $query->where('name', 'like', '%' . $this->userSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->userSearch . '%');
        })->get();

        return view('livewire.inventory.create', [
            'users' => $users
        ]);
    }
}
