<?php

namespace App\Livewire\Service;

use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

    // Campos del formulario
    public $id_s = '';
    public $F_serv = '';
    public $solicitante_id = '';
    public $efectuo_id = '';
    public $vobo_id = '';
    public $obj_sol = 'se instalaron dos nodos de res en el área de archivo histórico.';
    public $actividades = 'Para hacer esta tarea, se necesito aproximadamente 50 metro de cable, 2 canaletas auto aderibles y 5 plug';
    public $mantenimiento = '';
    public $observaciones = 'uno de los plug ya estaba ponchado o estaba defectuoso';
    public $solicitante_name = '';
    public $solicitante_position = '';
    public $solicitante_direction = '';
    public $efectuo_name = '';
    public $efectuo_position = '';
    public $efectuo_direction = '';
    public $vobo_name = '';
    public $vobo_position = '';
    public $vobo_direction = '';
    // Tipo de servicio
    public $correctivo = false;
    public $preventivo = false;
    public $transparencia = false;
    public $a_tec = false;
    public $web_ins = false;
    public $print = false;

    // Via de solicitud
    public $email = false;
    public $tel = false;
    public $sol_ser = false;
    public $oficio = false;
    public $calendario = false;

    public $capturo = '';
    public $status = false;
    public $impressions = false;

    // Modal properties
    public $showModal = false;
    public $modalTitle = '';
    public $modalType = '';
    public $userSearch = '';
    public $userSearchName = '';
    public $userSearchPosition = '';
    public $userSearchDirection = '';
    public $userSearchLvl = '';
    public $selectedUserId = null;
    public $selectedUserName = '';
    public $modalParam1 = null;
    public $modalParam2 = null;
    public $modalParam3 = null;
    public $modalParam4 = null;

    // Inventory Modal properties
    public $showInventoryModal = false;
    public $inventoryModalTitle = '';
    public $inventorySearchNi = '';
    public $inventorySearchSn = '';
    public $inventorySearchType = '';
    public $inventorySearchArticulo = '';
    public $selectedInventoryId = null;
    public $selectedInventory = null;

    // --- INICIO: Métodos Modal Inventario ---=================================================
    public $inventoryModalType = '';
    public $inventoryParam1 = null;
    public $inventoryParam2 = null;
    public $inventoryParam3 = null;
    public $inventoryParam4 = null;
    public $inventoryParam5 = null;

    public function openInventoryModal($type = 'inventario', $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null)
    {
        $this->inventoryModalType = $type;
        $this->inventoryParam1 = $param1;
        $this->inventoryParam2 = $param2;
        $this->inventoryParam3 = $param3;
        $this->inventoryParam4 = $param4;
        $this->inventoryParam5 = $param5;
        $this->inventoryModalTitle = "Seleccionar Inventario - Tipo: {$type}";
        // Mostrar parámetros en el título si no son nulos
        $params = array_filter([$param1, $param2, $param3, $param4, $param5], function($param) {
            return $param !== null && $param !== '';
        });
        if (!empty($params)) {
            $this->inventoryModalTitle .= " - Parámetros: " . implode(', ', $params);
        }
        $this->showInventoryModal = true;
        $this->inventorySearchNi = '';
        $this->inventorySearchSn = '';
        $this->inventorySearchType = '';
        $this->inventorySearchArticulo = '';
        $this->selectedInventoryId = null;
        $this->selectedInventory = null;
    }

    public function selectInventory($inventoryId)
    {
        $inventory = \App\Models\Inventory::find($inventoryId);
        $this->selectedInventoryId = $inventoryId;
        $this->selectedInventory = $inventory;
        // Si el primer parámetro es 'objetivo', concatenar al textarea obj_sol
        //==============================================================================
        if ($this->inventoryModalType === 'objetivo') {
            $info = "INVENTARIO: NI: {$inventory->ni}, SN: {$inventory->ns}, TYPE: {$inventory->type}, ARTICULO: {$inventory->articulo}";
            if (!empty($this->obj_sol)) {
                $this->obj_sol .= "\n" . $info;
            } else {
                $this->obj_sol = $info;
            }
        }
        //==============================================================================
        if ($this->inventoryModalType === 'actividades') {
            $info = "INVENTARIO: NI: {$inventory->ni}, SN: {$inventory->ns}, TYPE: {$inventory->type}, ARTICULO: {$inventory->articulo}";
            if (!empty($this->actividades)) {
                $this->actividades .= "\n" . $info;
            } else {
                $this->actividades = $info;
            }
        }
        //==============================================================================
        if ($this->inventoryModalType === 'observaciones') {
            $info = "INVENTARIO: NI: {$inventory->ni}, SN: {$inventory->ns}, TYPE: {$inventory->type}, ARTICULO: {$inventory->articulo}";
            if (!empty($this->observaciones)) {
                $this->observaciones .= "\n" . $info;
            } else {
                $this->observaciones = $info;
            }
        }
        //==============================================================================    /*  */
        if ($this->inventoryModalType === 'mantenimiento') {
            $info = "INVENTARIO: NI: {$inventory->ni}, SN: {$inventory->ns}, TYPE: {$inventory->type}, ARTICULO: {$inventory->articulo}";
            if (!empty($this->mantenimiento)) {
                $this->mantenimiento .= "\n" . $info;
            } else {
                $this->mantenimiento = $info;
            }
        }
        //==============================================================================    mantenimiento
        $this->closeInventoryModal();

    }

    public function closeInventoryModal()
    {
        $this->showInventoryModal = false;
        $this->inventoryModalTitle = '';
        $this->inventoryModalType = '';
        $this->inventoryParam1 = null;
        $this->inventoryParam2 = null;
        $this->inventoryParam3 = null;
        $this->inventoryParam4 = null;
        $this->inventoryParam5 = null;
        $this->inventorySearchNi = '';
        $this->inventorySearchSn = '';
        $this->inventorySearchType = '';
        $this->inventorySearchArticulo = '';
        $this->selectedInventoryId = null;
        $this->selectedInventory = null;
    }
    // --- FIN: Métodos Modal Inventario ---=================================================

    protected $rules = [
        'id_s' => 'nullable|string|max:25',
        'F_serv' => 'nullable|date',
        'solicitante_id' => 'required|exists:users,id',
        'efectuo_id' => 'required|exists:users,id',
        'vobo_id' => 'required|exists:users,id',
        'obj_sol' => 'required|string',
        'actividades' => 'required|string',
        'mantenimiento' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'correctivo' => 'boolean',
        'preventivo' => 'boolean',
        'transparencia' => 'boolean',
        'a_tec' => 'boolean',
        'web_ins' => 'boolean',
        'print' => 'boolean',
        'email' => 'boolean',
        'tel' => 'boolean',
        'sol_ser' => 'boolean',
        'oficio' => 'boolean',
        'calendario' => 'boolean',
        'capturo' => 'required|exists:users,id',
        'status' => 'boolean',
        'impressions' => 'boolean',
    ];

    protected $messages = [
        'F_serv.date' => 'La fecha debe ser válida',
        'solicitante_id.exists' => 'El solicitante debe ser un usuario válido',
        'efectuo_id.exists' => 'El usuario que efectuó debe ser válido',
        'vobo_id.exists' => 'El usuario de VºBº debe ser válido',
        'capturo.exists' => 'El usuario que captura debe ser válido',
    ];

    public function mount($id = null, $componente = null)
    {
        $now = now();
        $this->id_s = $now->format('Y-m-d/H:i:s');
        $this->F_serv = $now->format('Y-m-d');
        
        // Set capturo field with currently authenticated user's ID
        if (Auth::check()) {
            $this->capturo = Auth::id();
        }
    }

    // --- INICIO: Métodos Modal Usuario ---
    public function openUserModal($type, $param1 = null, $param2 = null, $param3 = null, $param4 = null)
    {
        $this->modalType = $type;
        $this->modalParam1 = ($param1 === 'null') ? '' : $param1;
        $this->modalParam2 = ($param2 === 'null') ? '' : $param2;
        $this->modalParam3 = ($param3 === 'null') ? '' : $param3;
        $this->modalParam4 = ($param4 === 'null') ? '' : $param4;

        // Aplica los filtros iniciales
        if (!empty($this->modalParam1)) {
            $this->userSearchName = $this->modalParam1;
        }
        if (!empty($this->modalParam2)) {
            $this->userSearchDirection = $this->modalParam2;
        }
        if (!empty($this->modalParam3)) {
            $this->userSearchLvl = $this->modalParam3;
        }
        if (!empty($this->modalParam4)) {
            $this->userSearchPosition = $this->modalParam4;
        }

        $this->showModal = true;
        $this->selectedUserId = null;
        $this->selectedUserName = '';
    }
    
    public function selectUser($userId, $userName)
    {
        Log::info('selectUser ejecutado', ['id' => $userId, 'name' => $userName, 'modalType' => $this->modalType]);
        $miperfil = User::find($userId);
        $this->selectedUserId = $userId;
        $this->selectedUserName = $userName;

        // Dependiendo del tipo, envía la info al campo correspondiente
        if ($this->modalType === 'Solicitante') {
            $this->solicitante_id = $userId;
            $this->solicitante_name = $userName;
            $this->solicitante_position = $miperfil->position;
            $this->solicitante_direction = $miperfil->direction;
        } elseif ($this->modalType === 'efectuo') {
            $this->efectuo_id = $userId;
            $this->efectuo_name = $userName;
            $this->efectuo_position = $miperfil->position;
            $this->efectuo_direction = $miperfil->direction;
        } elseif ($this->modalType === 'vobo') {
            $this->vobo_id = $userId;
            $this->vobo_name = $userName;
            $this->vobo_position = $miperfil->position;
            $this->vobo_direction = $miperfil->direction;
        } elseif ($this->modalType === 'objetivo') {
            // Concatenar a obj_sol
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->obj_sol)) {
                $this->obj_sol .= "\n" . $userInfo;
            } else {
                $this->obj_sol = $userInfo;
            }
        } elseif ($this->modalType === 'actividades') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->actividades)) {
                $this->actividades .= "\n" . $userInfo;
            } else {
                $this->actividades = $userInfo;
            }
        } elseif ($this->modalType === 'observaciones') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->observaciones)) {
                $this->observaciones .= "\n" . $userInfo;
            } else {
                $this->observaciones = $userInfo;
            }
        }elseif ($this->modalType === 'mantenimiento') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->mantenimiento)) {
                $this->mantenimiento .= "\n" . $userInfo;
            } else {
                $this->mantenimiento = $userInfo;
            }
        }

        $this->closeModal();   //mantenimiento 
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->modalType = '';
        $this->modalTitle = '';
        $this->userSearch = '';
        $this->userSearchName = '';
        $this->userSearchPosition = '';
        $this->userSearchDirection = '';
        $this->userSearchLvl = '';
        $this->selectedUserId = null;
        $this->selectedUserName = '';
    }
    // --- FIN: Métodos Modal Usuario ---====================================================

    public function saveService()
    {
        $this->validate();

        // Validación personalizada: al menos una vía de solicitud
        if (!($this->email || $this->tel || $this->sol_ser || $this->oficio || $this->calendario)) {
            $this->addError('via_solicitud', 'Debes seleccionar al menos una opción en Vía de Solicitud.');
            return;
        }
        // Validación personalizada: al menos un tipo de servicio
        if (!($this->correctivo || $this->preventivo || $this->transparencia || $this->a_tec || $this->web_ins || $this->print)) {
            $this->addError('tipo_servicio', 'Debes seleccionar al menos una opción en Tipo de Servicio.');
            return;
        }

        // Guardar el servicio
        Service::create([
            'id_s' => $this->id_s,
            'F_serv' => $this->F_serv,
            'solicitante_id' => $this->solicitante_id,
            'efectuo_id' => $this->efectuo_id,
            'vobo_id' => $this->vobo_id,
            'obj_sol' => $this->obj_sol,
            'actividades' => $this->actividades,
            'mantenimiento' => $this->mantenimiento,
            'observaciones' => $this->observaciones,
            'correctivo' => $this->correctivo,
            'preventivo' => $this->preventivo,
            'transparencia' => $this->transparencia,
            'a_tec' => $this->a_tec,
            'web_ins' => $this->web_ins,
            'print' => $this->print,
            'email' => $this->email,
            'tel' => $this->tel,
            'sol_ser' => $this->sol_ser,
            'oficio' => $this->oficio,
            'calendario' => $this->calendario,
            'capturo' => $this->capturo,
            'status' => $this->status,
            'impressions' => $this->impressions,
        ]);

        // Redirigir a la lista de servicios
        return redirect()->route('servicios.index');
    }

    public function render()
    {
        $users = User::where('status', true)->orderBy('name')->get();

        // Filtrar usuarios para el modal
        $filteredUsers = User::where('status', true)
            ->when($this->userSearchName, function ($query) {
                $query->where('name', 'like', '%' . $this->userSearchName . '%');
            })
            ->when($this->userSearchPosition, function ($query) {
                $query->where('position', 'like', '%' . $this->userSearchPosition . '%');
            })
            ->when($this->userSearchDirection, function ($query) {
                $query->where('direction', 'like', '%' . $this->userSearchDirection . '%');
            })
            ->when($this->userSearchLvl, function ($query) {
                $query->where('lvl', 'like', '%' . $this->userSearchLvl . '%');
            })
            ->orderBy('name')
            ->get();

        // Filtrar inventarios para el modal
        $filteredInventories = \App\Models\Inventory::where('status', true)
            ->when($this->inventorySearchNi, function ($query) {
                $query->where('ni', 'like', '%' . $this->inventorySearchNi . '%');
            })
            ->when($this->inventorySearchSn, function ($query) {
                $query->where('ns', 'like', '%' . $this->inventorySearchSn . '%');
            })
            ->when($this->inventorySearchType, function ($query) {
                $query->where('type', 'like', '%' . $this->inventorySearchType . '%');
            })
            ->when($this->inventorySearchArticulo, function ($query) {
                $query->where('articulo', 'like', '%' . $this->inventorySearchArticulo . '%');
            })
            ->orderBy('ni')
            ->get();

        return view('livewire.service.create', [
            'users' => $users,
            'filteredUsers' => $filteredUsers,
            'filteredInventories' => $filteredInventories,
        ]);
    }
}
