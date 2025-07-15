<?php

namespace App\Livewire\Service;

use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Componente Livewire para editar servicios existentes
 * 
 * Este componente está diseñado específicamente para la edición de servicios.
 * Requiere un ID de servicio válido para funcionar correctamente.
 */
class Edit extends Component
{
    use WithFileUploads;

    // ======================= INICIO: Propiedades del componente =======================
    // ID del servicio a editar
    public $serviceId;
    public $contenido = '';
    // Campos del formulario
    public $id_s = '';
    public $F_serv = '';
    public $solicitante_id = '';
    public $efectuo_id = '';
    public $vobo_id = '';
    public $obj_sol = '';
    public $actividades = '';
    public $mantenimiento = '';
    public $observaciones = '';
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
    public $estatus_servicio = false;
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
    // ======================= FIN: Propiedades del componente =======================

    // --- INICIO: Propiedades para Fotos ---
    public $servicePhotos = [];
    public $showPhotoForm = false;
    public $modalPhoto = null;
    public $modalPhotoPreview = null;
    public $modalPhotoDescription = '';
    public $editingPhotoIndex = null;
    // --- FIN: Propiedades para Fotos ---

    // ======================= INICIO: Métodos Modal Inventario =======================
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
            $this->dispatch('update-textarea', field: 'obj_sol', value: $this->obj_sol);
        }
        //==============================================================================
        if ($this->inventoryModalType === 'actividades') {
            $info = "INVENTARIO: NI: {$inventory->ni}, SN: {$inventory->ns}, TYPE: {$inventory->type}, ARTICULO: {$inventory->articulo}";
            if (!empty($this->actividades)) {
                $this->actividades .= "\n" . $info;
            } else {
                $this->actividades = $info;
            }
            $this->dispatch('update-textarea', field: 'actividades', value: $this->actividades);
        }
        //==============================================================================
        if ($this->inventoryModalType === 'observaciones') {
            $info = "INVENTARIO: NI: {$inventory->ni}, SN: {$inventory->ns}, TYPE: {$inventory->type}, ARTICULO: {$inventory->articulo}";
            if (!empty($this->observaciones)) {
                $this->observaciones .= "\n" . $info;
            } else {
                $this->observaciones = $info;
            }
            $this->dispatch('update-textarea', field: 'observaciones', value: $this->observaciones);
        }
        //==============================================================================    /*  */
        if ($this->inventoryModalType === 'mantenimiento') {
            $info = "INVENTARIO: NI: {$inventory->ni}, SN: {$inventory->ns}, TYPE: {$inventory->type}, ARTICULO: {$inventory->articulo}";
            if (!empty($this->mantenimiento)) {
                $this->mantenimiento .= "\n" . $info;
            } else {
                $this->mantenimiento = $info;
            }
            $this->dispatch('update-textarea', field: 'mantenimiento', value: $this->mantenimiento);
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
    // ======================= FIN: Métodos Modal Inventario =======================

    // ======================= INICIO: Reglas y mensajes de validación =======================
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
        'capturo' => 'nullable|exists:users,id',
        'estatus_servicio' => 'boolean',
        'impressions' => 'boolean',
    ];

    protected $messages = [
        'F_serv.date' => 'La fecha debe ser válida',
        'solicitante_id.exists' => 'El solicitante debe ser un usuario válido',
        'efectuo_id.exists' => 'El usuario que efectuó debe ser válido',
        'vobo_id.exists' => 'El usuario de VºBº debe ser válido',
    ];
    // ======================= FIN: Reglas y mensajes de validación =======================

    // ======================= INICIO: Carga de datos en mount =======================
    public function mount($id = null, $componente = null)
    {
        if (!$id) {
            // Si no hay ID, redirigir a la lista de servicios
            return redirect()->route('servicios.index');
        }

        $this->serviceId = $id;
        $service = Service::with(['solicitante', 'efectuo', 'vobo', 'photos'])->findOrFail($id);
        
        // Cargar los datos del servicio existente
        $this->id_s = $service->id_s;
        $this->F_serv = $service->F_serv ? $service->F_serv->format('Y-m-d') : '';
        $this->solicitante_id = $service->solicitante_id;
        $this->efectuo_id = $service->efectuo_id;
        $this->vobo_id = $service->vobo_id;
        $this->obj_sol = $service->obj_sol;
        $this->actividades = $service->actividades;
        $this->mantenimiento = $service->mantenimiento;
        $this->observaciones = $service->observaciones;
        
        // Cargar información de usuarios relacionados
        if ($service->solicitante) {
            $this->solicitante_name = $service->solicitante->name;
            $this->solicitante_position = $service->solicitante->position;
            $this->solicitante_direction = $service->solicitante->direction;
        }
        if ($service->efectuo) {
            $this->efectuo_name = $service->efectuo->name;
            $this->efectuo_position = $service->efectuo->position;
            $this->efectuo_direction = $service->efectuo->direction;
        }
        if ($service->vobo) {
            $this->vobo_name = $service->vobo->name;
            $this->vobo_position = $service->vobo->position;
            $this->vobo_direction = $service->vobo->direction;
        }
        
        // Cargar tipos de servicio
        $this->correctivo = $service->correctivo;
        $this->preventivo = $service->preventivo;
        $this->transparencia = $service->transparencia;
        $this->a_tec = $service->a_tec;
        $this->web_ins = $service->web_ins;
        $this->print = $service->print;
        
        // Cargar vías de solicitud
        $this->email = $service->email;
        $this->tel = $service->tel;
        $this->sol_ser = $service->sol_ser;
        $this->oficio = $service->oficio;
        $this->calendario = $service->calendario;
        
        // Otros campos
        $this->capturo = $service->capturo;
        $this->estatus_servicio = $service->estatus_servicio;
        $this->impressions = $service->impressions;

        // Cargar fotos existentes
        $this->servicePhotos = [];
        foreach ($service->photos as $photo) {
            $this->servicePhotos[] = [
                'id' => $photo->id,
                'path' => $photo->photo_path,
                'description' => $photo->description,
                'preview' => asset('storage/' . $photo->photo_path),
                'is_existing' => true,
            ];
        }

        Log::info('ID recibido en mount', ['id' => $id]);
    }
    // ======================= FIN: Carga de datos en mount =======================

    // ======================= INICIO: Métodos Modal Usuario =======================
    public function testUpdateObjSol()
    {
        $this->obj_sol = "PRUEBA: " . now()->format('H:i:s') . " - Esto es una prueba directa";
        $this->dispatch('textarea-updated', field: 'obj_sol');
        $this->dispatch('update-textarea', field: 'obj_sol', value: $this->obj_sol);
    }

    public function openUserModal($type, $param1 = null, $param2 = null, $param3 = null, $param4 = null)
    {
        Log::info('openUserModal ejecutado', ['type' => $type, 'param1' => $param1, 'param2' => $param2, 'param3' => $param3, 'param4' => $param4]);
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
        Log::info('Modal abierto', ['modalType' => $this->modalType, 'showModal' => $this->showModal]);
    }
    
    public function selectUser($userId, $userName)
    {
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
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->obj_sol)) {
                $this->obj_sol .= "\n" . $userInfo;
            } else {
                $this->obj_sol = $userInfo;
            }
            $this->dispatch('textarea-updated', field: 'obj_sol');
            $this->dispatch('update-textarea', field: 'obj_sol', value: $this->obj_sol);
        } elseif ($this->modalType === 'actividades') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->actividades)) {
                $this->actividades .= "\n" . $userInfo;
            } else {
                $this->actividades = $userInfo;
            }
            $this->dispatch('textarea-updated', field: 'actividades');
            $this->dispatch('update-textarea', field: 'actividades', value: $this->actividades);
        } elseif ($this->modalType === 'observaciones') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->observaciones)) {
                $this->observaciones .= "\n" . $userInfo;
            } else {
                $this->observaciones = $userInfo;
            }
            $this->dispatch('textarea-updated', field: 'observaciones');
            $this->dispatch('update-textarea', field: 'observaciones', value: $this->observaciones);
        } elseif ($this->modalType === 'mantenimiento') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->mantenimiento)) {
                $this->mantenimiento .= "\n" . $userInfo;
            } else {
                $this->mantenimiento = $userInfo;
            }
            $this->dispatch('textarea-updated', field: 'mantenimiento');
            $this->dispatch('update-textarea', field: 'mantenimiento', value: $this->mantenimiento);
        }

        $this->closeModal();
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
    // ======================= FIN: Métodos Modal Usuario =======================

    // ======================= INICIO: Guardar Edición de Servicio =======================
    public function saveService()
    {
        // Forzar todos los campos booleanos a ser booleanos antes de validar
        $this->correctivo = (bool) $this->correctivo;
        $this->preventivo = (bool) $this->preventivo;
        $this->transparencia = (bool) $this->transparencia;
        $this->a_tec = (bool) $this->a_tec;
        $this->web_ins = (bool) $this->web_ins;
        $this->print = (bool) $this->print;
        $this->email = (bool) $this->email;
        $this->tel = (bool) $this->tel;
        $this->sol_ser = (bool) $this->sol_ser;
        $this->oficio = (bool) $this->oficio;
        $this->calendario = (bool) $this->calendario;
        $this->estatus_servicio = (bool) $this->estatus_servicio;
        $this->impressions = (bool) $this->impressions;

        try {
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

            $service = Service::findOrFail($this->serviceId);

            // Sanitizar campos antes de guardar
            $allowedTags = '<ul><li><ol><b><i><u><br><strong><em>';
            $this->obj_sol = strip_tags($this->obj_sol, $allowedTags);
            $this->actividades = strip_tags($this->actividades, $allowedTags);
            $this->mantenimiento = strip_tags($this->mantenimiento, $allowedTags);
            $this->observaciones = strip_tags($this->observaciones, $allowedTags);

            $updateData = [
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
                'capturo' => Auth::id(),
                'estatus_servicio' => $this->estatus_servicio,
                'impressions' => $this->impressions,
            ];

            $result = $service->update($updateData);

            if ($result) {
                session()->flash('message', 'Servicio actualizado correctamente.');
                // En Livewire, usamos redirect() en lugar de return redirect()
                return $this->redirect(route('servicios.index'));
            } else {
                $this->addError('general', 'No se pudo actualizar el servicio. Inténtalo de nuevo.');
            }

        } catch (\Exception $e) {
            $this->addError('general', 'Error al guardar el servicio: ' . $e->getMessage());
        }
    }
    // ======================= FIN: Guardar Edición de Servicio =======================

    // ======================= INICIO: Métodos para Fotos =======================
    public function openPhotoForm($index = null)
    {
        if ($index !== null) {
            $this->editingPhotoIndex = $index;
            $this->modalPhotoDescription = $this->servicePhotos[$index]['description'] ?? '';
            $this->modalPhotoPreview = $this->servicePhotos[$index]['preview'] ?? null;
            $this->showPhotoForm = true;
        } else {
            $this->editingPhotoIndex = null;
            $this->showPhotoForm = true;
            $this->modalPhoto = null;
            $this->modalPhotoPreview = null;
            $this->modalPhotoDescription = '';
        }
    }

    public function addPhoto()
    {
        $this->validate([
            'modalPhoto' => 'required|image|max:2048',
            'modalPhotoDescription' => 'nullable|string|max:255',
        ]);
        $path = $this->modalPhoto->store('service_photos', 'public');
        $this->servicePhotos[] = [
            'path' => $path,
            'description' => $this->modalPhotoDescription,
            'preview' => asset('storage/' . $path),
            'is_existing' => false,
        ];
        $this->closePhotoForm();
        session()->flash('message', 'Foto agregada correctamente.');
    }

    public function deletePhoto($index)
    {
        if (isset($this->servicePhotos[$index])) {
            unset($this->servicePhotos[$index]);
            $this->servicePhotos = array_values($this->servicePhotos);
        }
    }

    public function savePhotoDescriptionEdit()
    {
        if ($this->editingPhotoIndex !== null) {
            $this->servicePhotos[$this->editingPhotoIndex]['description'] = $this->modalPhotoDescription;
            $this->editingPhotoIndex = null;
            $this->showPhotoForm = false;
            $this->modalPhotoDescription = '';
            $this->modalPhotoPreview = null;
        }
    }

    public function cancelPhotoDescriptionEdit()
    {
        $this->editingPhotoIndex = null;
        $this->showPhotoForm = false;
        $this->modalPhotoDescription = '';
        $this->modalPhotoPreview = null;
    }

    public function closePhotoForm()
    {
        $this->showPhotoForm = false;
        $this->modalPhoto = null;
        $this->modalPhotoPreview = null;
        $this->modalPhotoDescription = '';
        $this->editingPhotoIndex = null;
    }
    // ======================= FIN: Métodos para Fotos =======================

    // ======================= INICIO: Render y utilitarios =======================
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

        return view('livewire.service.edit', [
            'users' => $users,
            'filteredUsers' => $filteredUsers,
            'filteredInventories' => $filteredInventories,
        ]);
    }
    // ======================= FIN: Render y utilitarios =======================

    protected function sanitizeInput($input)
    {
        // Elimina scripts y eventos on*
        $input = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $input);
        $input = preg_replace('/on\w+="[^"]*"/i', '', $input);
        return $input;
    }

    function cleanAttributes($input) {
        // Elimina cualquier atributo on* (ej: onclick, onmouseover, etc.)
        $input = preg_replace('/on\w+="[^"]*"/i', '', $input);
        $input = preg_replace("/on\w+='[^']*'/i", '', $input);
        // Elimina cualquier <script>...</script>
        $input = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $input);
        return $input;
    }
}
