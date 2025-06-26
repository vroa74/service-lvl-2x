<?php

namespace App\Livewire\Cartasresponsivas;

use App\Models\Responsiva;
use App\Models\User;
use App\Models\Inventory;
use App\Models\InventoryResponsiva;
use App\Models\InventoryPhoto;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithPagination, WithFileUploads;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $user_id;
    public $responsable_id;
    public $informatica_id;
    public $fecha;
    public $codigo;
    public $auditoria = false;
    public $users;
    public $inventories;
    public $selected_inventories = [];
    
    // Modal de inventarios
    public $showInventoryModal = false;
    public $inventorySearch = '';
    public $filteredInventories = [];
    
    // Descripciones
    public $inventoryDescriptions = [];

    // Fotos
    public $selectedInventoryForPhotos = null;
    public $photo = [];
    public $photoPreview = [];
    public $photoDescription = [];
    public $openPhotoAccordion = [];
    public $showAddPhotoForm = [];

    public $showPhotoModal = [];
    public $modalPhoto = [];
    public $modalPhotoPreview = [];
    public $modalPhotoDescription = [];

    public $showUserModal = false;
    public $userModalTarget = null; // 'user_id', 'responsable_id', 'informatica_id'
    public $userModalFilter = '';
    public $userModalList = [];

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'responsable_id' => 'required|exists:users,id',
        'informatica_id' => 'required|exists:users,id',
        'fecha' => 'required|date',
        'codigo' => 'required|string|max:20|unique:responsivas,codigo',
        'auditoria' => 'boolean',
        'selected_inventories' => 'required|array|min:1',
        'selected_inventories.*' => 'exists:inventories,id',
        'photo' => 'nullable|image|max:2048',
        'photoDescription' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->users = User::where('status', true)->orderBy('name')->get();
        $this->inventories = Inventory::where('status', true)->orderBy('id', 'desc')->get();
        $this->filteredInventories = $this->inventories;
        $this->fecha = now()->format('Y-m-d');
        $this->codigo = 'CR/' . now()->format('Ymd/His');
    }

    public function openInventoryModal()
    {
        $this->showInventoryModal = true;
        $this->inventorySearch = '';
        $this->resetPage();
    }

    public function closeInventoryModal()
    {
        $this->showInventoryModal = false;
        $this->inventorySearch = '';
        $this->resetPage();
    }

    public function updatedInventorySearch()
    {
        $this->resetPage();
    }

    public function selectInventory($inventoryId)
    {
        if (!in_array($inventoryId, $this->selected_inventories)) {
            $this->selected_inventories[] = $inventoryId;
            $this->inventoryDescriptions[$inventoryId] = '';
            $this->openPhotoAccordion[$inventoryId] = true;
            $this->showAddPhotoForm[$inventoryId] = true;
            $this->openPhotoModal($inventoryId);
        }
        $this->closeInventoryModal();
    }

    public function removeInventory($inventoryId)
    {
        $this->selected_inventories = array_filter($this->selected_inventories, function($id) use ($inventoryId) {
            return $id != $inventoryId;
        });
        unset($this->inventoryDescriptions[$inventoryId]);
        if ($this->selectedInventoryForPhotos == $inventoryId) {
            $this->selectedInventoryForPhotos = null;
        }
    }

    public function getSelectedInventoryItems()
    {
        $items = Inventory::whereIn('id', $this->selected_inventories)->get()->keyBy('id');
        return collect($this->selected_inventories)->map(fn($id) => $items[$id])->filter();
    }

    public function getFilteredInventoriesPaginated()
    {
        $query = Inventory::where('status', true);
        
        if (!empty($this->inventorySearch)) {
            $search = strtolower($this->inventorySearch);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(articulo) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(ni) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(ns) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(marca) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(modelo) LIKE ?', ['%' . $search . '%']);
            });
        }
        
        return $query->orderBy('id', 'desc')->paginate(10);
    }

    // --- Fotos ---
    public function selectInventoryForPhotos($inventoryId)
    {
        $this->openPhotoAccordion[$inventoryId] = true;
        $this->selectedInventoryForPhotos = $inventoryId;
        $this->resetPhotoForm($inventoryId);
        $this->showAddPhotoForm[$inventoryId] = true;
    }

    public function resetPhotoForm($inventoryId)
    {
        $this->photo[$inventoryId] = null;
        $this->photoPreview[$inventoryId] = null;
        $this->photoDescription[$inventoryId] = '';
    }

    public function updatedPhoto($value, $name)
    {
        // $name is like 'photo.5' where 5 is the inventory id
        $parts = explode('.', $name);
        $inventoryId = $parts[1] ?? null;
        if ($inventoryId && isset($this->photo[$inventoryId])) {
            $this->photoPreview[$inventoryId] = $this->photo[$inventoryId]->temporaryUrl();
        }
    }

    public function addPhoto($inventoryId)
    {
        $this->validate([
            'photo.' . $inventoryId => 'required|image|max:2048',
            'photoDescription.' . $inventoryId => 'nullable|string|max:255',
        ]);
        $path = $this->photo[$inventoryId]->store('inventory_photos', 'public');
        InventoryPhoto::create([
            'inventory_id' => $inventoryId,
            'path' => $path,
            'description' => $this->photoDescription[$inventoryId],
        ]);
        $this->photo[$inventoryId] = null;
        $this->photoPreview[$inventoryId] = null;
        $this->photoDescription[$inventoryId] = '';
        $this->showAddPhotoForm[$inventoryId] = false;
        session()->flash('message', 'Foto agregada correctamente.');
    }

    public function showAddPhotoForm($inventoryId)
    {
        $this->showAddPhotoForm[$inventoryId] = true;
    }

    public function deletePhoto($photoId)
    {
        $photo = InventoryPhoto::find($photoId);
        if ($photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }
    }

    public function getPhotosForSelectedInventory()
    {
        if ($this->selectedInventoryForPhotos) {
            return InventoryPhoto::where('inventory_id', $this->selectedInventoryForPhotos)->get();
        }
        return collect();
    }

    public function openPhotoModal($inventoryId)
    {
        $this->showPhotoModal = array_merge($this->showPhotoModal, [$inventoryId => true]);
        $this->modalPhoto[$inventoryId] = null;
        $this->modalPhotoPreview[$inventoryId] = null;
        $this->modalPhotoDescription[$inventoryId] = '';
        $this->dispatch('$refresh');
    }

    public function closePhotoModal($inventoryId)
    {
        $this->showPhotoModal[$inventoryId] = false;
        $this->modalPhoto[$inventoryId] = null;
        $this->modalPhotoPreview[$inventoryId] = null;
        $this->modalPhotoDescription[$inventoryId] = '';
    }

    public function updatedModalPhoto($value, $name)
    {
        $parts = explode('.', $name);
        $inventoryId = $parts[1] ?? null;
        if ($inventoryId && isset($this->modalPhoto[$inventoryId])) {
            $this->modalPhotoPreview[$inventoryId] = $this->modalPhoto[$inventoryId]->temporaryUrl();
        }
    }

    public function savePhotoFromModal($inventoryId)
    {
        $this->validate([
            'modalPhoto.' . $inventoryId => 'required|image|max:2048',
            'modalPhotoDescription.' . $inventoryId => 'nullable|string|max:255',
        ]);
        $path = $this->modalPhoto[$inventoryId]->store('inventory_photos', 'public');
        InventoryPhoto::create([
            'inventory_id' => $inventoryId,
            'path' => $path,
            'description' => $this->modalPhotoDescription[$inventoryId],
        ]);
        $this->closePhotoModal($inventoryId);
        session()->flash('message', 'Foto agregada correctamente.');
    }

    public function openUserModal($target)
    {
        logger('openUserModal called', ['target' => $target]);
        $this->userModalTarget = $target;
        $this->userModalFilter = '';
        $this->showUserModal = true;
        $this->updateUserModalList();
    }

    public function closeUserModal()
    {
        $this->showUserModal = false;
        $this->userModalTarget = null;
        $this->userModalFilter = '';
        $this->userModalList = [];
    }

    public function updatedUserModalFilter()
    {
        $this->updateUserModalList();
    }

    public function updateUserModalList()
    {
        $query = User::where('status', true);
        if (!empty($this->userModalFilter)) {
            $search = strtolower($this->userModalFilter);
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(email) LIKE ?', ['%' . $search . '%']);
        }
        $this->userModalList = $query->orderBy('name')->limit(20)->get();
    }

    public function selectUserFromModal($userId)
    {
        $user = User::find($userId);
        if ($user && in_array($this->userModalTarget, ['user_id', 'responsable_id', 'informatica_id'])) {
            $this->{$this->userModalTarget} = $user->id;
        }
        $this->closeUserModal();
    }

    public function save()
    {
        $this->validate();
        $responsiva = Responsiva::create([
            'user_id' => $this->user_id,
            'responsable_id' => $this->responsable_id,
            'informatica_id' => $this->informatica_id,
            'fecha' => $this->fecha,
            'codigo' => $this->codigo,
            'auditoria' => $this->auditoria,
        ]);
        
        foreach ($this->selected_inventories as $inventory_id) {
            InventoryResponsiva::create([
                'responsiva_id' => $responsiva->id,
                'inventory_id' => $inventory_id,
                'description' => $this->inventoryDescriptions[$inventory_id] ?? null,
            ]);
        }
        
        session()->flash('message', 'Carta responsiva creada correctamente.');
        $this->reset(['user_id', 'responsable_id', 'informatica_id', 'fecha', 'codigo', 'auditoria', 'selected_inventories', 'inventoryDescriptions', 'selectedInventoryForPhotos', 'photo', 'photoDescription']);
    }

    public function render()
    {
        return view('livewire.cartasresponsivas.create');
    }
}
