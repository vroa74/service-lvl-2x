<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $editing = false;
    public $inventoryId = null;

    // Propiedades para reportes
    public $showReportModal = false;
    public $reportType = '';
    public $reportDateFrom = '';
    public $reportDateTo = '';
    public $reportUser = '';
    public $reportStatus = '';

    // Campos del formulario para edición
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

    public $filterNi = '';
    public $filterNs = '';
    public $filterArticulo = '';
    public $filterMarca = '';
    public $filterModelo = '';
    public $filterFechaInv = '';
    public $perPage = 10;

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

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function editInventory($inventoryId)
    {
        // Redirigir a la página de edición
        return redirect()->route('inventario.edit', $inventoryId);
    }

    public function toggleStatus($inventoryId)
    {
        $inventory = Inventory::find($inventoryId);
        $inventory->update(['status' => !$inventory->status]);
        session()->flash('message', 'Estado del artículo actualizado.');
    }

    // Métodos para reportes
    public function openReportModal($type = 'general')
    {
        $this->reportType = $type;
        $this->reportDateFrom = now()->startOfMonth()->format('Y-m-d');
        $this->reportDateTo = now()->format('Y-m-d');
        $this->reportUser = '';
        $this->reportStatus = '';
        $this->showReportModal = true;
    }

    public function closeReportModal()
    {
        $this->showReportModal = false;
        $this->reportType = '';
        $this->reportDateFrom = '';
        $this->reportDateTo = '';
        $this->reportUser = '';
        $this->reportStatus = '';
    }

    public function generateReport()
    {
        try {
            $query = Inventory::with(['user', 'responsible']);

            // Aplicar filtros según el tipo de reporte
            if ($this->reportDateFrom && $this->reportDateTo) {
                $query->whereBetween('fecha', [$this->reportDateFrom, $this->reportDateTo]);
            }

            if ($this->reportUser) {
                $query->where(function ($q) {
                    $q->where('user_id', $this->reportUser)
                      ->orWhere('res_id', $this->reportUser);
                });
            }

            if ($this->reportStatus !== '') {
                $query->where('status', $this->reportStatus);
            }

            $inventories = $query->orderBy('fecha', 'desc')->get();

            // Generar el reporte según el tipo
            switch ($this->reportType) {
                case 'general':
                    $filename = $this->generateGeneralReport($inventories);
                    break;
                case 'por_usuario':
                    $filename = $this->generateUserReport($inventories);
                    break;
                case 'por_tipo':
                    $filename = $this->generateTypeReport($inventories);
                    break;
                case 'por_fecha':
                    $filename = $this->generateDateReport($inventories);
                    break;
                default:
                    $filename = $this->generateGeneralReport($inventories);
                    break;
            }

            // Cerrar el modal
            $this->closeReportModal();

            // Emitir evento para descargar el archivo
            $this->dispatch('download-report', url: '/storage/temp/' . $filename);

            session()->flash('message', 'Reporte generado correctamente. La descarga comenzará automáticamente.');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }

    // Método para generar reporte individual de inventario
    public function generateIndividualInventoryReport($inventoryId)
    {
        try {
            // Emitir evento inmediatamente para abrir el PDF en nueva pestaña
            $this->dispatch('openPdfInNewTab', url: route('inventory.pdf', $inventoryId));
            
            session()->flash('message', 'Reporte del artículo generado correctamente.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al generar el reporte del artículo: ' . $e->getMessage());
        }
    }

    private function generateGeneralReport($inventories)
    {
        $data = [
            'title' => 'Reporte General de Inventario',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'inventories' => $inventories,
            'totalItems' => $inventories->count(),
            'activeItems' => $inventories->where('status', true)->count(),
            'inactiveItems' => $inventories->where('status', false)->count(),
        ];

        $pdf = PDF::loadView('reports.inventory.general', $data);
        $filename = 'reporte_general_inventario_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    private function generateUserReport($inventories)
    {
        $userInventories = $inventories->groupBy('user_id');
        $data = [
            'title' => 'Reporte de Inventario por Usuario',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'userInventories' => $userInventories,
            'totalItems' => $inventories->count(),
        ];

        $pdf = PDF::loadView('reports.inventory.by_user', $data);
        $filename = 'reporte_inventario_por_usuario_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    private function generateTypeReport($inventories)
    {
        $typeStats = [
            'PC' => $inventories->where('is_pc', true)->count(),
            'Otros' => $inventories->where('is_pc', false)->count(),
        ];

        $data = [
            'title' => 'Reporte de Inventario por Tipo',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'typeStats' => $typeStats,
            'totalItems' => $inventories->count(),
        ];

        $pdf = PDF::loadView('reports.inventory.by_type', $data);
        $filename = 'reporte_inventario_por_tipo_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    private function generateDateReport($inventories)
    {
        $dateStats = $inventories->groupBy(function ($inventory) {
            return $inventory->fecha ? $inventory->fecha->format('Y-m') : 'Sin fecha';
        });

        $data = [
            'title' => 'Reporte de Inventario por Fecha',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'dateStats' => $dateStats,
            'totalItems' => $inventories->count(),
        ];

        $pdf = PDF::loadView('reports.inventory.by_date', $data);
        $filename = 'reporte_inventario_por_fecha_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    // Método de prueba para verificar DomPDF
    public function testPdf()
    {
        $this->dispatch('openPdfInNewTab', url: route('test.pdf'));
    }

    private function cleanString($string)
    {
        if (empty($string)) {
            return '';
        }
        
        // Intentar diferentes codificaciones
        $encodings = ['UTF-8', 'ISO-8859-1', 'Windows-1252', 'ASCII'];
        
        foreach ($encodings as $encoding) {
            if (mb_check_encoding($string, $encoding)) {
                $cleaned = mb_convert_encoding($string, 'UTF-8', $encoding);
                if (mb_check_encoding($cleaned, 'UTF-8')) {
                    return $cleaned;
                }
            }
        }
        
        // Si nada funciona, intentar limpiar caracteres problemáticos
        return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $string);
    }

    public function render()
    {
        $inventories = Inventory::query()
            ->with(['assignedUser', 'responsible'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('articulo', 'like', '%' . $this->search . '%')
                      ->orWhere('ni', 'like', '%' . $this->search . '%')
                      ->orWhere('ns', 'like', '%' . $this->search . '%')
                      ->orWhere('marca', 'like', '%' . $this->search . '%')
                      ->orWhere('resguardante', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterNi, function ($query) {
                $query->where('ni', 'like', '%' . $this->filterNi . '%');
            })
            ->when($this->filterNs, function ($query) {
                $query->where('ns', 'like', '%' . $this->filterNs . '%');
            })
            ->when($this->filterArticulo, function ($query) {
                $query->where('articulo', 'like', '%' . $this->filterArticulo . '%');
            })
            ->when($this->filterMarca, function ($query) {
                $query->where('marca', 'like', '%' . $this->filterMarca . '%');
            })
            ->when($this->filterModelo, function ($query) {
                $query->where('modelo', 'like', '%' . $this->filterModelo . '%');
            })
            ->when($this->filterFechaInv, function ($query) {
                $query->where('fecha_inv', $this->filterFechaInv);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        $users = User::where('status', true)->orderBy('name')->get();
        $uniqueFechasInv = Inventory::query()->select('fecha_inv')->distinct()->orderBy('fecha_inv', 'desc')->pluck('fecha_inv')->filter()->values();

        return view('livewire.inventory.index', [
            'inventories' => $inventories,
            'users' => $users,
            'uniqueFechasInv' => $uniqueFechasInv,
        ]);
    }
} 