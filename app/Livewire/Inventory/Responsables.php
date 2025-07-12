<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\User;
use Livewire\WithPagination;


class Responsables extends Component
{
    use WithPagination;
    protected $listeners = [
        'asignarResguardante',
        'asignacionResguardanteCancelada',
        'refresh' => '$refresh',
    ];

    public $resguardanteFilter = '';
    public $mensaje = '';
    public $tipoMensaje = '';
    public $filtroConUsuario = false;
    public $totalAbsoluto = 0;
    public $querySQL = '';

    public function updatedResguardanteFilter()
    {
        $this->resetPage('usersPage');
        $this->resetPage('inventoryPage');
    }

    public function updatedFiltroConUsuario()
    {
        $this->resetPage('inventoryPage');
    }

    public function asignarUsuario()
    {
        // Contar usuarios que coinciden con el filtro
        $userCount = User::query()
            ->where('status', true)
            ->when($this->resguardanteFilter, function ($query) {
                $valor = strtolower($this->resguardanteFilter);
                $query->whereRaw('LOWER(name) LIKE ?', ["%{$valor}%"]);
            })
            ->count();

        if ($userCount === 0) {
            $this->mensaje = 'Error: No se encontraron usuarios que coincidan con el filtro.';
            $this->tipoMensaje = 'error';
            $this->resguardanteFilter = '';
            return;
        }

        if ($userCount > 1) {
            $this->mensaje = 'Error: Debe haber exactamente un usuario para realizar la asignación. Actualmente hay ' . $userCount . ' usuarios.';
            $this->tipoMensaje = 'error';
            $this->resguardanteFilter = '';
            return;
        }

        // Obtener el usuario único
        $user = User::query()
            ->where('status', true)
            ->when($this->resguardanteFilter, function ($query) {
                $valor = strtolower($this->resguardanteFilter);
                $query->whereRaw('LOWER(name) LIKE ?', ["%{$valor}%"]);
            })
            ->first();

        if (!$user) {
            $this->mensaje = 'Error: No se pudo encontrar el usuario.';
            $this->tipoMensaje = 'error';
            $this->resguardanteFilter = '';
            return;
        }

        // Actualizar todos los registros de inventory que coincidan con el filtro
        $inventoriesToUpdate = Inventory::query()
            ->when($this->resguardanteFilter, function ($query) {
                $valor = strtolower($this->resguardanteFilter);
                $query->where(function ($subQuery) use ($valor) {
                    $subQuery->whereRaw('LOWER(resguardante) LIKE ?', ["%{$valor}%"])
                             ->orWhereHas('responsible', function ($relationQuery) use ($valor) {
                                 $relationQuery->whereRaw('LOWER(name) LIKE ?', ["%{$valor}%"]);
                             });
                });
            })
            ->get();

        $updatedCount = 0;
        foreach ($inventoriesToUpdate as $inventory) {
            $inventory->user_id = $user->id;
            $inventory->res_id = $user->id;
            $inventory->save();
            $updatedCount++;
        }

        $this->mensaje = "Asignación exitosa: Se asignaron {$updatedCount} artículos al usuario {$user->name}.";
        $this->tipoMensaje = 'success';
        $this->resguardanteFilter = '';
    }

    public function render()
    {
        $users = User::query()
            ->where('status', true)
            ->when($this->resguardanteFilter, function ($query) {
                $valor = strtolower($this->resguardanteFilter);
                $query->whereRaw('LOWER(name) LIKE ?', ["%{$valor}%"]);
            })
            ->orderBy('id')
            ->paginate(30, ['*'], 'usersPage');

        // Construir la consulta base para inventory
        $inventoryQuery = Inventory::query()
            ->with(['assignedUser', 'responsible'])
            ->when($this->resguardanteFilter, function ($query) {
                $valor = strtolower($this->resguardanteFilter);
                $query->where(function ($subQuery) use ($valor) {
                    $subQuery->whereRaw('LOWER(resguardante) LIKE ?', ["%{$valor}%"])
                             ->orWhereHas('responsible', function ($relationQuery) use ($valor) {
                                 $relationQuery->whereRaw('LOWER(name) LIKE ?', ["%{$valor}%"]);
                             });
                });
            })
            ->when($this->filtroConUsuario !== null, function ($query) {
                if ($this->filtroConUsuario) {
                    // Mostrar solo registros CON usuario
                    $query->whereNotNull('user_id');
                } else {
                    // Mostrar solo registros SIN usuario
                    $query->whereNull('user_id');
                }
            });

        // Obtener el total absoluto (sin paginación)
        $this->totalAbsoluto = $inventoryQuery->count();

        // Obtener el query SQL
        $this->querySQL = $inventoryQuery->toSql();
        $bindings = $inventoryQuery->getBindings();
        
        // Reemplazar los placeholders con los valores reales
        foreach ($bindings as $binding) {
            $this->querySQL = preg_replace('/\?/', "'" . addslashes($binding) . "'", $this->querySQL, 1);
        }

        // Aplicar paginación
        $inventories = $inventoryQuery->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'inventoryPage');

        return view('livewire.inventory.responsables', [
            'users' => $users,
            'inventories' => $inventories,
        ]);        
    }
}
