<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class UserInv extends Component
{
    use WithPagination;

    public $selectedUserId = null;
    
    // Propiedades para filtros
    public $userNameFilter = '';
    public $resguardanteSearch = '';
    public $filterNi = '';
    public $filterArticulo = '';
    public $showWithResId = false;
    public $showWithUserId = false;

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->resetPage('inventoryPage');
    }

    public function updatedUserNameFilter()
    {
        $this->resetPage('usersPage');
    }

    public function updatedResguardanteSearch()
    {
        $this->resetPage('inventoryPage');
    }

    public function updatedFilterNi()
    {
        $this->resetPage('inventoryPage');
    }

    public function updatedFilterArticulo()
    {
        $this->resetPage('inventoryPage');
    }

    public function updatedShowWithResId()
    {
        $this->resetPage('inventoryPage');
    }

    public function updatedShowWithUserId()
    {
        $this->resetPage('inventoryPage');
    }

    #[On('confirmMarkAsPc')]
    public function markFilteredAsPc()
    {
        if (!$this->areInventoryFiltersActive()) {
            session()->flash('error', 'Debe aplicar al menos un filtro de inventario para usar esta función.');
            return;
        }

        $filteredInventoryIds = $this->getFilteredInventoryQuery()->pluck('id');

        if ($filteredInventoryIds->isEmpty()) {
            session()->flash('error', 'Ningún registro coincide con los filtros de inventario actuales.');
            return;
        }

        Inventory::whereIn('id', $filteredInventoryIds)->update(['is_pc' => true]);

        session()->flash('message', 'Se han marcado ' . $filteredInventoryIds->count() . ' registros como PC.');
    }

    #[On('confirmAssignResponsible')]
    public function assignResponsibleToFiltered()
    {
        session()->flash('debug', 'assignResponsibleToFiltered method called'); // Debug log
        
        $matchingUsers = User::query()
            ->where('status', true)
            ->when($this->userNameFilter, function ($query) {
                $query->where('name', 'like', '%' . $this->userNameFilter . '%');
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

        session()->flash('debug', 'Updating res_id to: ' . $userIdToAssign . ' for ' . $filteredInventoryIds->count() . ' records'); // Debug log
        Inventory::whereIn('id', $filteredInventoryIds)->update(['res_id' => $userIdToAssign]);
        session()->flash('message', 'Se ha asignado el responsable a ' . $filteredInventoryIds->count() . ' registros.');
    }

    #[On('confirmAssignUser')]
    public function assignUserToFiltered()
    {
        session()->flash('debug', 'assignUserToFiltered method called'); // Debug log
        
        $matchingUsers = User::query()
            ->where('status', true)
            ->when($this->userNameFilter, function ($query) {
                $query->where('name', 'like', '%' . $this->userNameFilter . '%');
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

        session()->flash('debug', 'Updating user_id to: ' . $userIdToAssign . ' for ' . $filteredInventoryIds->count() . ' records'); // Debug log
        Inventory::whereIn('id', $filteredInventoryIds)->update(['user_id' => $userIdToAssign]);
        session()->flash('message', 'Se ha asignado el usuario a ' . $filteredInventoryIds->count() . ' registros.');
    }

    private function areInventoryFiltersActive(): bool
    {
        return !empty($this->resguardanteSearch) ||
               !empty($this->filterNi) ||
               !empty($this->filterArticulo) ||
               $this->showWithResId ||
               $this->showWithUserId;
    }
    
    private function getFilteredInventoryQuery()
    {
        return Inventory::query()
            ->when($this->selectedUserId, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('user_id', $this->selectedUserId)
                             ->orWhere('res_id', $this->selectedUserId);
                });
            })
            ->when($this->resguardanteSearch, function ($query) {
                $searchTerm = '%' . $this->resguardanteSearch . '%';
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
            ->when($this->showWithResId, function ($query) {
                $query->whereNotNull('res_id');
            })
            ->when($this->showWithUserId, function ($query) {
                $query->whereNotNull('user_id');
            });
    }

    public function clearFilters()
    {
        $this->userNameFilter = '';
        $this->resguardanteSearch = '';
        $this->filterNi = '';
        $this->filterArticulo = '';
        $this->showWithResId = false;
        $this->showWithUserId = false;
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->where('status', true)
            ->when($this->userNameFilter, function ($query) {
                $query->where('name', 'like', '%' . $this->userNameFilter . '%');
            })
            ->orderBy('id')
            ->paginate(30, ['*'], 'usersPage');

        $inventories = $this->getFilteredInventoryQuery()
            ->with(['assignedUser', 'responsible'])
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'inventoryPage');

        return view('livewire.inventory.user-inv', [
            'users' => $users,
            'inventories' => $inventories,
        ]);
    }
}
