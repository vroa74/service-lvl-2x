<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class UserInv extends Component
{
    use WithPagination;

    public $selectedUserId = null;
    
    // Propiedades para filtros
    public $generalSearch = '';
    public $filterNi = '';
    public $filterArticulo = '';
    public $filterEstado = '';
    public $filterUbicacion = '';
    public $showWithResId = false;
    public $showWithUserId = false;

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->resetPage();
    }

    public function updatedGeneralSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterNi()
    {
        $this->resetPage();
    }

    public function updatedFilterArticulo()
    {
        $this->resetPage();
    }

    public function updatedFilterEstado()
    {
        $this->resetPage();
    }

    public function updatedFilterUbicacion()
    {
        $this->resetPage();
    }

    public function updatedShowWithResId()
    {
        $this->resetPage();
    }

    public function updatedShowWithUserId()
    {
        $this->resetPage();
    }

    #[On('confirmMarkAsPc')]
    public function markFilteredAsPc()
    {
        if (!$this->areFiltersActive()) {
            session()->flash('error', 'Debe aplicar al menos un filtro para usar esta función.');
            return;
        }

        $filteredInventoryIds = $this->getFilteredInventoryQuery()->pluck('id');

        if ($filteredInventoryIds->isEmpty()) {
            session()->flash('error', 'Ningún registro coincide con los filtros actuales.');
            return;
        }

        Inventory::whereIn('id', $filteredInventoryIds)->update(['is_pc' => true]);

        session()->flash('message', 'Se han marcado ' . $filteredInventoryIds->count() . ' registros como PC.');
    }

    #[On('confirmAssignResponsible')]
    public function assignResponsibleToFiltered()
    {
        $matchingUsers = User::query()
            ->where('status', true)
            ->when($this->generalSearch, function ($query) {
                $query->where('name', 'like', '%' . $this->generalSearch . '%');
            })
            ->get();

        if ($matchingUsers->count() !== 1) {
            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Error de Selección de Usuario',
                'text' => 'Debe haber exactamente un usuario en la lista para poder asignarlo. Filtre hasta que solo un usuario aparezca.',
            ]);
            return;
        }

        if (!$this->areInventoryFiltersActive()) {
            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Filtros de Inventario no Aplicados',
                'text' => 'Debe aplicar al menos un filtro en el panel superior para usar esta función de asignación.',
            ]);
            return;
        }

        $userIdToAssign = $matchingUsers->first()->id;
        $filteredInventoryIds = $this->getFilteredInventoryQuery()->pluck('id');

        if ($filteredInventoryIds->isEmpty()) {
            $this->dispatch('swal:alert', [
                'icon' => 'info',
                'title' => 'Sin Registros',
                'text' => 'Ningún registro de inventario coincide con los filtros actuales para ser actualizado.',
            ]);
            return;
        }

        Inventory::whereIn('id', $filteredInventoryIds)->update(['res_id' => $userIdToAssign]);
        session()->flash('message', 'Se ha asignado el responsable a ' . $filteredInventoryIds->count() . ' registros.');
    }

    private function areInventoryFiltersActive(): bool
    {
        return !empty($this->generalSearch) ||
               !empty($this->filterNi) ||
               !empty($this->filterArticulo) ||
               !empty($this->filterEstado) ||
               !empty($this->filterUbicacion) ||
               $this->showWithResId ||
               $this->showWithUserId;
    }

    private function areFiltersActive(): bool
    {
        return !empty($this->generalSearch) ||
               !empty($this->filterNi) ||
               !empty($this->filterArticulo) ||
               !empty($this->filterEstado) ||
               !empty($this->filterUbicacion) ||
               $this->showWithResId ||
               $this->showWithUserId ||
               !is_null($this->selectedUserId);
    }

    private function getFilteredInventoryQuery()
    {
        return Inventory::query()
            ->when($this->selectedUserId, function ($query) {
                $query->where('user_id', $this->selectedUserId)
                      ->orWhere('res_id', $this->selectedUserId);
            })
            ->when($this->generalSearch, function ($query) {
                $searchTerm = '%' . $this->generalSearch . '%';
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('resguardante', 'like', $searchTerm)
                             ->orWhereHas('responsible', function ($relationQuery) use ($searchTerm) {
                                 $relationQuery->where('name', 'like', $searchTerm);
                             });
                });
            })
            ->when($this->filterNi, function ($query) {
                $query->where('ni', 'like', '%' . $this->filterNi . '%');
            })
            ->when($this->filterArticulo, function ($query) {
                $query->where('articulo', 'like', '%' . $this->filterArticulo . '%');
            })
            ->when($this->filterEstado !== '', function ($query) {
                $query->where('status', $this->filterEstado);
            })
            ->when($this->filterUbicacion, function ($query) {
                $query->where('dir', 'like', '%' . $this->filterUbicacion . '%');
            })
            ->when($this->showWithResId, function ($query) {
                $query->whereNotNull('res_id');
            })
            ->when($this->showWithUserId, function ($query) {
                $query->whereNotNull('user_id');
            });
    }

    public function clearFilters()
    {
        $this->generalSearch = '';
        $this->filterNi = '';
        $this->filterArticulo = '';
        $this->filterEstado = '';
        $this->filterUbicacion = '';
        $this->showWithResId = false;
        $this->showWithUserId = false;
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->where('status', true)
            ->when($this->generalSearch, function ($query) {
                $query->where('name', 'like', '%' . $this->generalSearch . '%');
            })
            ->orderBy('id')
            ->paginate(10, ['*'], 'usersPage');

        $inventories = $this->getFilteredInventoryQuery()
            ->with(['user', 'responsible'])
            ->orderBy('id', 'asc')
            ->paginate(10, ['*'], 'inventoryPage');

        // Obtener valores únicos para los filtros
        $ubicaciones = Inventory::distinct()->pluck('dir')->filter()->values();

        return view('livewire.inventory.user-inv', [
            'users' => $users,
            'inventories' => $inventories,
            'ubicaciones' => $ubicaciones
        ]);
    }
}
