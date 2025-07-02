<?php

namespace App\Livewire\Cartasresponsivas;

use App\Models\Responsiva;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;

    // Propiedades para búsqueda y filtros
    public $search = '';
    public $filterCodigo = '';
    public $filterFecha = '';
    public $filterAuditoria = '';

    // Propiedades para ordenamiento
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterCodigo' => ['except' => ''],
        'filterFecha' => ['except' => ''],
        'filterAuditoria' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function updatingFilterCodigo()
    {
        $this->resetPage();
    }

    public function updatingFilterFecha()
    {
        $this->resetPage();
    }

    public function updatingFilterAuditoria()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filterCodigo = '';
        $this->filterFecha = '';
        $this->filterAuditoria = '';
        $this->resetPage();
    }

    public function delete($id)
    {
        try {
            $responsiva = Responsiva::findOrFail($id);
            $responsiva->delete();
            session()->flash('message', 'Carta responsiva eliminada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error eliminando carta responsiva: ' . $e->getMessage());
            session()->flash('error', 'Error al eliminar la carta responsiva.');
        }
    }

    public function render()
    {
        try {
            $query = Responsiva::query()
                ->with(['user', 'responsable', 'informatica', 'inventoryResponsivas.inventory'])
                ->when($this->search, function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('codigo', 'like', '%' . $this->search . '%')
                                 ->orWhere('observacion', 'like', '%' . $this->search . '%')
                                 ->orWhereHas('user', function ($userQuery) {
                                     $userQuery->where('name', 'like', '%' . $this->search . '%');
                                 })
                                 ->orWhereHas('responsable', function ($responsableQuery) {
                                     $responsableQuery->where('name', 'like', '%' . $this->search . '%');
                                 })
                                 ->orWhereHas('informatica', function ($informaticaQuery) {
                                     $informaticaQuery->where('name', 'like', '%' . $this->search . '%');
                                 });
                    });
                })

                ->when($this->filterCodigo, function ($query) {
                    $query->where('codigo', 'like', '%' . $this->filterCodigo . '%');
                })
                ->when($this->filterFecha, function ($query) {
                    $query->whereDate('fecha', $this->filterFecha);
                })
                ->when($this->filterAuditoria !== '', function ($query) {
                    $query->where('auditoria', $this->filterAuditoria);
                });

            $responsivas = $query->orderBy($this->sortField, $this->sortDirection)
                                ->paginate(10);


            
            return view('livewire.cartasresponsivas.index', [
                'responsivas' => $responsivas
            ]);
        } catch (\Exception $e) {
            Log::error('Error en render de Index: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Retornar vista con error
            return view('livewire.cartasresponsivas.index', [
                'responsivas' => collect([])
            ]);
        }
    }
}
