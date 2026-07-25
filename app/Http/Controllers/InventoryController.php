<?php

namespace App\Http\Controllers;

use App\Traits\DeviceDetectionTrait;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    use DeviceDetectionTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('inventory.index', $deviceInfo);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('inventory.create', $deviceInfo);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('inventory.show', array_merge(['id' => $id], $deviceInfo));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('inventory.edit', array_merge(['id' => $id], $deviceInfo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function userinv() {
        $deviceInfo = $this->getDeviceInfo();
        return view('inventory.user-inv', $deviceInfo);
    }

    public function responsables() {
        $deviceInfo = $this->getDeviceInfo();
        return view('inventory.responsables', $deviceInfo);
    }

    /**
     * Generate PDF for individual inventory
     */
    public function generatePdf($id)
    {
        try {
            $inventory = Inventory::with(['assignedUser', 'responsible'])->findOrFail($id);
            
            $data = [
                'inventory' => $inventory,
                'title' => 'Reporte Individual de Inventario',
                'generatedAt' => now()->format('d/m/Y H:i:s'),
            ];
            
            $pdf = PDF::loadView('reports.inventory.individual', $data)
                      ->setPaper('letter', 'portrait');
            
            return $pdf->stream('reporte_inventario_' . $inventory->id . '.pdf');
            
        } catch (\Exception $e) {
            Log::error('Error generando PDF para inventario ' . $id . ': ' . $e->getMessage());
            abort(500, 'Error al generar el PDF. Por favor, revise los logs.');
        }
    }

    public function exportCSV(Request $request)
    {
        $query = Inventory::query()->with(['assignedUser', 'responsible', 'services']);

        // Aplicar filtros desde la sesión o request
        if ($request->has('filters')) {
            $filters = json_decode($request->filters, true);
            
            if (!empty($filters['search'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('ni', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('articulo', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('marca', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('modelo', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('ns', 'like', '%' . $filters['search'] . '%');
                });
            }

            if (!empty($filters['filterNi'])) {
                $query->where('ni', 'like', '%' . $filters['filterNi'] . '%');
            }
            if (!empty($filters['filterDireccion'])) {
                $query->whereHas('assignedUser', function ($q) use ($filters) {
                    $q->where('direction', 'like', '%' . $filters['filterDireccion'] . '%');
                });
            }
            if (!empty($filters['filterUserName'])) {
                $query->whereHas('assignedUser', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['filterUserName'] . '%');
                });
            }
            if (!empty($filters['filterResponsibleName'])) {
                $query->whereHas('responsible', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['filterResponsibleName'] . '%');
                });
            }
            if (!empty($filters['filterNs'])) {
                $query->where('ns', 'like', '%' . $filters['filterNs'] . '%');
            }
            if (!empty($filters['filterArticulo'])) {
                $query->where('articulo', 'like', '%' . $filters['filterArticulo'] . '%');
            }
            if (!empty($filters['filterMarca'])) {
                $query->where('marca', 'like', '%' . $filters['filterMarca'] . '%');
            }
            if (!empty($filters['filterModelo'])) {
                $query->where('modelo', 'like', '%' . $filters['filterModelo'] . '%');
            }
            if (!empty($filters['filterFechaInv'])) {
                $query->where('fecha_inv', $filters['filterFechaInv']);
            }
        }

        $inventories = $query->orderBy('created_at', 'desc')->get();

        $filename = 'inventario_' . now()->format('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($inventories) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                'NI', 'Artículo', 'Marca', 'Modelo', 'N/S', 'Usuario Asignado', 
                'Dirección', 'Responsable', 'Fecha Inventario', 'Servicios Asociados', 'Estado'
            ]);

            foreach ($inventories as $inventory) {
                $serviciosAsociados = $inventory->services->count() > 0 
                    ? $inventory->services->pluck('service_date')->map(function($date) {
                        return \Carbon\Carbon::parse($date)->format('d/m/Y');
                    })->implode(', ')
                    : 'Sin servicios';

                fputcsv($file, [
                    $inventory->ni,
                    $inventory->articulo,
                    $inventory->marca,
                    $inventory->modelo,
                    $inventory->ns,
                    $inventory->assignedUser->name ?? 'N/A',
                    $inventory->assignedUser->direction ?? 'N/A',
                    $inventory->responsible->name ?? 'N/A',
                    $inventory->fecha_inv,
                    $serviciosAsociados,
                    $inventory->status ? 'Activo' : 'Inactivo'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportHTML(Request $request)
    {
        $query = Inventory::query()->with(['assignedUser', 'responsible', 'services']);

        // Aplicar filtros desde la sesión o request
        if ($request->has('filters')) {
            $filters = json_decode($request->filters, true);
            
            if (!empty($filters['search'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('ni', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('articulo', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('marca', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('modelo', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('ns', 'like', '%' . $filters['search'] . '%');
                });
            }

            if (!empty($filters['filterNi'])) {
                $query->where('ni', 'like', '%' . $filters['filterNi'] . '%');
            }
            if (!empty($filters['filterDireccion'])) {
                $query->whereHas('assignedUser', function ($q) use ($filters) {
                    $q->where('direction', 'like', '%' . $filters['filterDireccion'] . '%');
                });
            }
            if (!empty($filters['filterUserName'])) {
                $query->whereHas('assignedUser', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['filterUserName'] . '%');
                });
            }
            if (!empty($filters['filterResponsibleName'])) {
                $query->whereHas('responsible', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['filterResponsibleName'] . '%');
                });
            }
            if (!empty($filters['filterNs'])) {
                $query->where('ns', 'like', '%' . $filters['filterNs'] . '%');
            }
            if (!empty($filters['filterArticulo'])) {
                $query->where('articulo', 'like', '%' . $filters['filterArticulo'] . '%');
            }
            if (!empty($filters['filterMarca'])) {
                $query->where('marca', 'like', '%' . $filters['filterMarca'] . '%');
            }
            if (!empty($filters['filterModelo'])) {
                $query->where('modelo', 'like', '%' . $filters['filterModelo'] . '%');
            }
            if (!empty($filters['filterFechaInv'])) {
                $query->where('fecha_inv', $filters['filterFechaInv']);
            }
        }

        $inventories = $query->orderBy('created_at', 'desc')->get();

        $html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - ' . now()->format('d/m/Y H:i') . '</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(to bottom right, #1a1a2e, #0f0f1e);
            color: #d1d5db;
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2em;
            font-weight: bold;
        }
        .info {
            text-align: center;
            color: #9ca3af;
            margin-bottom: 20px;
            font-size: 0.9em;
        }
        .table-container {
            background-color: #1f2937;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            border: 1px solid #374151;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background-color: #374151;
        }
        th {
            padding: 12px;
            text-align: left;
            font-size: 0.75em;
            font-weight: 500;
            color: #d1d5db;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        tbody {
            background-color: #1f2937;
        }
        tr {
            border-bottom: 1px solid #374151;
            transition: background-color 0.2s;
        }
        tr:hover {
            background-color: #374151;
        }
        td {
            padding: 16px 12px;
            font-size: 0.875em;
            color: #d1d5db;
            vertical-align: top;
        }
        .font-medium {
            font-weight: 500;
            color: #fff;
        }
        .text-xs {
            font-size: 0.75em;
            color: #9ca3af;
        }
        .detail-line {
            margin-bottom: 4px;
        }
        .label {
            font-weight: 600;
        }
        .user-section {
            margin-bottom: 12px;
        }
        .user-label {
            font-size: 0.75em;
            color: #9ca3af;
            margin-bottom: 2px;
        }
        .user-name-assigned {
            font-weight: 500;
            color: #fbbf24;
        }
        .user-position-assigned {
            font-size: 0.75em;
            color: #fcd34d;
        }
        .user-name-responsible {
            font-weight: 500;
            color: #f472b6;
        }
        .user-position-responsible {
            font-size: 0.75em;
            color: #f9a8d4;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75em;
            font-weight: 600;
            text-align: center;
        }
        .badge-pc {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .badge-other {
            background-color: #f3f4f6;
            color: #1f2937;
        }
        .service-box {
            background-color: #1e3a8a;
            border: 1px solid #1e40af;
            border-radius: 8px;
            padding: 8px;
            margin-bottom: 6px;
        }
        .service-title {
            font-size: 0.75em;
            color: #bfdbfe;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .service-detail {
            font-size: 0.75em;
            color: #93c5fd;
            margin-bottom: 2px;
        }
        .status-active {
            color: #10b981;
            font-weight: 600;
        }
        .status-inactive {
            color: #ef4444;
            font-weight: 600;
        }
        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: 600;
            color: #fff;
            padding: 10px 20px;
        }
        @media print {
            body {
                background: #1a1a2e;
            }
            tr:hover {
                background-color: transparent;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventario de Equipos</h1>
        <div class="info">
            <p>Fecha de generación: ' . now()->format('d/m/Y H:i:s') . '</p>
            <p>Total de registros: ' . $inventories->count() . '</p>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 15%;">Artículo</th>
                        <th style="width: 15%;">Detalles</th>
                        <th style="width: 20%;">Resguardante</th>
                        <th style="width: 20%;">Usuarios</th>
                        <th style="width: 10%; text-align: center;">Tipo</th>
                        <th style="width: 15%;">Servicios Asociados</th>
                        <th style="width: 10%; text-align: center;">Estado</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($inventories as $inventory) {
            $statusClass = $inventory->status ? 'status-active' : 'status-inactive';
            $statusText = $inventory->status ? 'Activo' : 'Inactivo';

            // Columna Artículo
            $articuloHtml = '<div class="font-medium">' . e($inventory->articulo ?? 'N/A') . '</div>';
            $articuloHtml .= '<div class="text-xs">NI: ' . e($inventory->ni ?? 'N/A') . '</div>';

            // Columna Detalles
            $detallesHtml = '<div class="detail-line"><span class="label">NS:</span> ' . e($inventory->ns ?? 'N/A') . '</div>';
            $detallesHtml .= '<div class="detail-line"><span class="label">Marca:</span> ' . e($inventory->marca ?? 'N/A') . '</div>';
            $detallesHtml .= '<div class="detail-line"><span class="label">Modelo:</span> ' . e($inventory->modelo ?? 'N/A') . '</div>';

            // Columna Resguardante
            $resguardanteHtml = '<div class="font-medium">';
            $resguardanteHtml .= $inventory->responsible ? e($inventory->responsible->name ?? 'SN') : 'SN';
            $resguardanteHtml .= '</div>';
            $resguardanteHtml .= '<div class="text-xs">';
            $resguardanteHtml .= ($inventory->responsible && $inventory->responsible->position) ? e($inventory->responsible->position) : 'S/C';
            $resguardanteHtml .= '</div>';

            // Columna Usuarios
            $usuariosHtml = '';
            if ($inventory->assignedUser) {
                $usuariosHtml .= '<div class="user-section">';
                $usuariosHtml .= '<div class="user-label">Usuario:</div>';
                $usuariosHtml .= '<div class="user-name-assigned">' . e($inventory->assignedUser->name ?? 'N/A') . '</div>';
                $usuariosHtml .= '<div class="user-position-assigned">' . e($inventory->assignedUser->position ?? 'Sin posición') . '</div>';
                $usuariosHtml .= '</div>';
            }
            if ($inventory->responsible) {
                $usuariosHtml .= '<div class="user-section">';
                $usuariosHtml .= '<div class="user-label">Resguardante:</div>';
                $usuariosHtml .= '<div class="user-name-responsible">' . e($inventory->responsible->name ?? 'N/A') . '</div>';
                $usuariosHtml .= '<div class="user-position-responsible">' . e($inventory->responsible->position ?? 'Sin posición') . '</div>';
                $usuariosHtml .= '</div>';
            }

            // Columna Tipo
            $tipoHtml = $inventory->is_pc 
                ? '<span class="badge badge-pc">PC</span>' 
                : '<span class="badge badge-other">Otro</span>';

            // Columna Servicios Asociados
            $serviciosHtml = '';
            if ($inventory->services && $inventory->services->count() > 0) {
                foreach ($inventory->services as $service) {
                    $serviciosHtml .= '<div class="service-box">';
                    $serviciosHtml .= '<div class="service-title">Servicio #' . $service->id . '</div>';
                    
                    if ($service->solicitante) {
                        $serviciosHtml .= '<div class="service-detail"><span class="label">Usuario:</span> ' . e($service->solicitante->name) . '</div>';
                        $serviciosHtml .= '<div class="service-detail"><span class="label">Cargo:</span> ' . e($service->solicitante->position ?? 'S/C') . '</div>';
                        $serviciosHtml .= '<div class="service-detail"><span class="label">Dirección:</span> ' . e($service->solicitante->direction ?? 'S/C') . '</div>';
                    }
                    
                    if ($service->service_date) {
                        $serviciosHtml .= '<div class="service-detail"><span class="label">Fecha:</span> ' . \Carbon\Carbon::parse($service->service_date)->format('d/m/Y') . '</div>';
                    }
                    
                    $serviciosHtml .= '</div>';
                }
            } else {
                $serviciosHtml = '<div style="color: #9ca3af;">Sin servicios</div>';
            }

            $html .= '<tr>
                <td>' . $articuloHtml . '</td>
                <td>' . $detallesHtml . '</td>
                <td>' . $resguardanteHtml . '</td>
                <td>' . $usuariosHtml . '</td>
                <td style="text-align: center;">' . $tipoHtml . '</td>
                <td>' . $serviciosHtml . '</td>
                <td style="text-align: center;"><span class="' . $statusClass . '">' . $statusText . '</span></td>
            </tr>';
        }

        $html .= '
                </tbody>
            </table>
        </div>
        <div class="total">
            Total de registros: ' . $inventories->count() . '
        </div>
    </div>
</body>
</html>';

        $filename = 'inventario_' . now()->format('Y-m-d_H-i-s') . '.html';
        
        return response($html, 200)
            ->header('Content-Type', 'text/html; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
