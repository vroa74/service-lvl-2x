<?php

namespace App\Livewire\Service;

use App\Models\Service;
use App\Models\ServicePhoto;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

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
    public $inventorySearchUserName = '';
    public $inventorySearchUserDirection = '';
    public $selectedInventoryId = null;
    public $selectedInventory = null;

    // --- INICIO: Métodos Modal Inventario ---=================================================
    public $inventoryModalType = '';
    public $inventoryParam1 = null;
    public $inventoryParam2 = null;
    public $inventoryParam3 = null;
    public $inventoryParam4 = null;
    public $inventoryParam5 = null;

    // --- INICIO: Propiedades para Fotos ---=================================================
    public $servicePhotos = [];
    public $photoDescriptions = [];
    public $photoPreview = [];
    public $showPhotoForm = false;
    public $activePhotoFormId = null;
    public $modalPhoto = null;
    public $modalPhotoPreview = null;
    public $modalPhotoDescription = '';

    // --- FIN: Propiedades para Fotos ---=================================================

    public $editingPhotoDescriptionIndex = null;
    public $editingPhotoDescriptionValue = '';
    public $editingPhotoIndex = null;
    
    // Track temporary photos for cleanup
    public $temporaryPhotos = [];

    public function startEditingPhotoDescription($index)
    {
        $this->editingPhotoDescriptionIndex = $index;
        $this->editingPhotoDescriptionValue = $this->servicePhotos[$index]['description'] ?? '';
    }

    public function saveEditingPhotoDescription()
    {
        if ($this->editingPhotoDescriptionIndex !== null) {
            $this->servicePhotos[$this->editingPhotoDescriptionIndex]['description'] = $this->editingPhotoDescriptionValue;
            $this->editingPhotoDescriptionIndex = null;
            $this->editingPhotoDescriptionValue = '';
        }
    }

    public function cancelEditingPhotoDescription()
    {
        $this->editingPhotoDescriptionIndex = null;
        $this->editingPhotoDescriptionValue = '';
    }

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
        $this->inventorySearchUserName = '';
        $this->inventorySearchUserDirection = '';
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
        $this->inventorySearchUserName = '';
        $this->inventorySearchUserDirection = '';
        $this->selectedInventoryId = null;
        $this->selectedInventory = null;
    }
    // --- FIN: Métodos Modal Inventario ---=================================================

    // --- INICIO: Métodos para Fotos ---=================================================
    public function openPhotoForm($index = null)
    {
        if ($index !== null) {
            // Editar descripción de foto existente
            $this->editingPhotoIndex = $index;
            $this->modalPhotoDescription = $this->servicePhotos[$index]['description'] ?? '';
            $this->modalPhotoPreview = $this->servicePhotos[$index]['preview'] ?? null;
            $this->showPhotoForm = true;
        } else {
            // Agregar nueva foto
            $this->editingPhotoIndex = null;
            $this->showPhotoForm = true;
            $this->modalPhoto = null;
            $this->modalPhotoPreview = null;
            $this->modalPhotoDescription = '';
        }
    }

    public function closePhotoForm()
    {
        $this->showPhotoForm = false;
        $this->modalPhoto = null;
        $this->modalPhotoPreview = null;
        $this->modalPhotoDescription = '';
    }

    public function updatedModalPhoto()
    {
        if ($this->modalPhoto) {
            $this->modalPhotoPreview = $this->modalPhoto->temporaryUrl();
        }
    }

    public function addPhoto()
    {
        $this->validate([
            'modalPhoto' => 'required|image|max:2048',
            'modalPhotoDescription' => 'nullable|string|max:255',
        ]);

        $path = $this->modalPhoto->store('service_photos', 'public');
        
        // Track temporary photo for cleanup if service creation fails
        $this->temporaryPhotos[] = $path;
        
        $this->servicePhotos[] = [
            'path' => $path,
            'description' => $this->modalPhotoDescription,
            'preview' => $this->modalPhotoPreview
        ];

        $this->closePhotoForm();
        session()->flash('message', 'Foto agregada correctamente.');
    }

    public function deletePhoto($index)
    {
        if (isset($this->servicePhotos[$index])) {
            $photo = $this->servicePhotos[$index];
            if (isset($photo['path']) && Storage::disk('public')->exists($photo['path'])) {
                Storage::disk('public')->delete($photo['path']);
                // Remove from temporary photos if it's there
                $key = array_search($photo['path'], $this->temporaryPhotos);
                if ($key !== false) {
                    unset($this->temporaryPhotos[$key]);
                }
            }
            unset($this->servicePhotos[$index]);
            $this->servicePhotos = array_values($this->servicePhotos); // Reindexar array
        }
    }

    public function deletePhotoFromDatabase($photoId)
    {
        $photo = ServicePhoto::find($photoId);
        if ($photo) {
            Storage::disk('public')->delete($photo->photo_path);
            $photo->delete();
            session()->flash('message', 'Foto eliminada correctamente.');
        }
    }

    public function savePhotoDescriptionEdit()
    {
        if ($this->editingPhotoIndex !== null) {
            // If a new photo was uploaded, replace the old one
            if ($this->modalPhoto) {
                $this->validate([
                    'modalPhoto' => 'required|image|max:2048',
                ]);
                
                // Delete old photo
                $oldPhoto = $this->servicePhotos[$this->editingPhotoIndex];
                if (isset($oldPhoto['path']) && Storage::disk('public')->exists($oldPhoto['path'])) {
                    Storage::disk('public')->delete($oldPhoto['path']);
                    // Remove from temporary photos if it's there
                    $key = array_search($oldPhoto['path'], $this->temporaryPhotos);
                    if ($key !== false) {
                        unset($this->temporaryPhotos[$key]);
                    }
                }
                
                // Store new photo
                $newPath = $this->modalPhoto->store('service_photos', 'public');
                $this->temporaryPhotos[] = $newPath;
                
                // Update photo data
                $this->servicePhotos[$this->editingPhotoIndex]['path'] = $newPath;
                $this->servicePhotos[$this->editingPhotoIndex]['preview'] = $this->modalPhotoPreview;
            }
            
            // Update description
            $this->servicePhotos[$this->editingPhotoIndex]['description'] = $this->modalPhotoDescription;
            
            $this->editingPhotoIndex = null;
            $this->showPhotoForm = false;
            $this->modalPhotoDescription = '';
            $this->modalPhotoPreview = null;
            $this->modalPhoto = null;
        }
    }

    public function cancelPhotoDescriptionEdit()
    {
        $this->editingPhotoIndex = null;
        $this->showPhotoForm = false;
        $this->modalPhotoDescription = '';
        $this->modalPhotoPreview = null;
    }
    // --- FIN: Métodos para Fotos ---=================================================

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
    public function testUpdateObjSol()
    {
        $this->obj_sol = "PRUEBA CREATE: " . now()->format('H:i:s') . " - Esto es una prueba directa";
        $this->dispatch('update-textarea', field: 'obj_sol', value: $this->obj_sol);
    }

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
            $this->dispatch('update-textarea', field: 'obj_sol', value: $this->obj_sol);
        } elseif ($this->modalType === 'actividades') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->actividades)) {
                $this->actividades .= "\n" . $userInfo;
            } else {
                $this->actividades = $userInfo;
            }
            $this->dispatch('update-textarea', field: 'actividades', value: $this->actividades);
        } elseif ($this->modalType === 'observaciones') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->observaciones)) {
                $this->observaciones .= "\n" . $userInfo;
            } else {
                $this->observaciones = $userInfo;
            }
            $this->dispatch('update-textarea', field: 'observaciones', value: $this->observaciones);
        }elseif ($this->modalType === 'mantenimiento') {
            $userInfo = "NOMBRE: {$miperfil->name}    DIRECCION: {$miperfil->direction}    CARGO: {$miperfil->position}";
            if (!empty($this->mantenimiento)) {
                $this->mantenimiento .= "\n" . $userInfo;
            } else {
                $this->mantenimiento = $userInfo;
            }
            $this->dispatch('update-textarea', field: 'mantenimiento', value: $this->mantenimiento);
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

        try {
            // Guardar el servicio
            $service = Service::create([
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

            // Guardar las fotos del servicio
            foreach ($this->servicePhotos as $photoData) {
                ServicePhoto::create([
                    'service_id' => $service->id,
                    'photo_path' => $photoData['path'],
                    'description' => $photoData['description'],
                ]);
            }

            // Clear temporary photos tracking since service was saved successfully
            $this->temporaryPhotos = [];

            // Redirigir a la lista de servicios
            return redirect()->route('servicios.index');
        } catch (\Exception $e) {
            // If service creation fails, cleanup temporary photos
            $this->cleanupTemporaryPhotos();
            throw $e;
        }
    }

    public function cleanupTemporaryPhotos()
    {
        foreach ($this->temporaryPhotos as $photoPath) {
            if (Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
        }
        $this->temporaryPhotos = [];
    }

    public function dehydrate()
    {
        // Cleanup temporary photos when component is destroyed
        $this->cleanupTemporaryPhotos();
    }

    public function updated($propertyName)
    {
        // If user navigates away without saving, cleanup temporary photos
        if ($propertyName === 'servicePhotos' && empty($this->servicePhotos)) {
            $this->cleanupTemporaryPhotos();
        }
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
        $filteredInventories = \App\Models\Inventory::with(['assignedUser', 'responsible'])
            ->where('status', true)
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
            ->when($this->inventorySearchUserName, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereHas('assignedUser', function ($userQuery) {
                        $userQuery->where('name', 'like', '%' . $this->inventorySearchUserName . '%');
                    })
                    ->orWhereHas('responsible', function ($userQuery) {
                        $userQuery->where('name', 'like', '%' . $this->inventorySearchUserName . '%');
                    });
                });
            })
            ->when($this->inventorySearchUserDirection, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereHas('assignedUser', function ($userQuery) {
                        $userQuery->where('direction', 'like', '%' . $this->inventorySearchUserDirection . '%');
                    })
                    ->orWhereHas('responsible', function ($userQuery) {
                        $userQuery->where('direction', 'like', '%' . $this->inventorySearchUserDirection . '%');
                    });
                });
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
