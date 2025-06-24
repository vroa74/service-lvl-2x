<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CartasResponsivasController;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

// Ruta de prueba para DomPDF
Route::get('/test-pdf', function () {
    try {
        // Obtener servicios para el reporte
        $services = \App\Models\Service::with(['solicitante'])->get();
        
        // Preparar datos para la vista
        $data = [
            'title' => 'Reporte General de Servicios',
            'dateRange' => 'Todos los registros',
            'services' => $services,
            'totalServices' => $services->count(),
            'activeServices' => $services->where('status', true)->count(),
            'inactiveServices' => $services->where('status', false)->count(),
        ];
        
        // Crear una nueva instancia de DOMPDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->set_option('defaultFont', 'DejaVu Sans');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isPhpEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        
        // Generar el HTML con la vista
        $html = view('reports.services.general', $data)->render();
        
        // Cargar el HTML en DOMPDF
        $dompdf->loadHtml($html);
        
        // Configurar el tamaño del papel
        $dompdf->setPaper('letter', 'portrait');
        
        // Renderizar el PDF
        $dompdf->render();
        
        // Mostrar el PDF directamente en el navegador
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename=reporte_servicios.pdf');
        
    } catch (\Exception $e) {
        abort(500, 'Error generando el PDF: ' . $e->getMessage());
    }
})->name('test.pdf');

// Ruta de prueba para reporte individual de servicio
Route::get('/test-individual-pdf/{id}', function ($id) {
    try {
        // Obtener el servicio específico con todas sus relaciones
        $service = \App\Models\Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->findOrFail($id);
        
        // Preparar datos para la vista
        $data = [
            'service' => $service,
            'title' => 'Reporte Individual de Servicio',
            'generatedAt' => now()->format('d/m/Y H:i:s'),
        ];
        
        // Crear una nueva instancia de DOMPDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->set_option('defaultFont', 'DejaVu Sans');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isPhpEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        
        // Generar el HTML con la vista
        $html = view('reports.services.individual', $data)->render();
        
        // Cargar el HTML en DOMPDF
        $dompdf->loadHtml($html);
        
        // Configurar el tamaño del papel
        $dompdf->setPaper('letter', 'portrait');
        
        // Renderizar el PDF
        $dompdf->render();
        
        // Mostrar el PDF directamente en el navegador
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename=reporte_servicio_' . $service->id_s . '.pdf');
        
    } catch (\Exception $e) {
        abort(500, 'Error generando el PDF: ' . $e->getMessage());
    }
})->name('test.individual.pdf');

// Ruta para generar reporte individual de servicio y mostrarlo directamente
Route::get('/service-pdf/{id}', function ($id) {
    try {
        // Obtener el servicio específico con todas sus relaciones
        $service = \App\Models\Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->findOrFail($id);
        
        // Preparar datos para la vista (re-agregando las variables que podrían faltar)
        $data = [
            'service' => $service,
            'title' => 'Reporte Individual de Servicio',
            'generatedAt' => now()->format('d/m/Y H:i:s'),
        ];
        
        // Cargar la vista y generar el PDF para transmitirlo
        $pdf = PDF::loadView('reports.services.individual', $data)
                  ->setPaper('letter', 'portrait');
        
        // Hacer stream del PDF directamente al navegador
        return $pdf->stream('reporte_servicio_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $service->id_s) . '.pdf');
        
    } catch (\Exception $e) {
        // Log del error para depuración
        \Illuminate\Support\Facades\Log::error('Error generando PDF para servicio ' . $id . ': ' . $e->getMessage());
        abort(500, 'Error al generar el PDF. Por favor, revise los logs.');
    }
})->name('service.pdf');

Route::get('/inventory-pdf/{id}', function ($id) {
    try {
        $inventory = \App\Models\Inventory::with(['assignedUser', 'responsible'])->findOrFail($id);
        
        $data = [
            'inventory' => $inventory,
            'title' => 'Reporte Individual de Inventario',
            'generatedAt' => now()->format('d/m/Y H:i:s'),
        ];
        
        $pdf = PDF::loadView('reports.inventory.individual', $data)
                  ->setPaper('letter', 'portrait');
        
        return $pdf->stream('reporte_inventario_' . $inventory->id . '.pdf');
        
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Error generando PDF para inventario ' . $id . ': ' . $e->getMessage());
        abort(500, 'Error al generar el PDF. Por favor, revise los logs.');
    }
})->name('inventory.pdf');

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'),'verified', ])->group(function () {
    
    Route::resource('cartasresponsivas', CartasResponsivasController::class)->names('cartasresponsivas');
    
    Route::resource('usuarios', UsuariosController::class)->names('usuarios');
    Route::resource('service', ServiceController::class)->names('servicios');
    Route::resource('inventario', InventoryController::class)->names('inventario');
    Route::get('/inventory-user-inv', [InventoryController::class, 'userinv'])->name('inventory.user-inv');
    
    // Ruta para el componente Livewire de usuarios
    Route::get('/usuarios-livewire', function () {
        return view('usuarios-livewire');
    })->name('usuarios.livewire');
    
    // Ruta para el componente Livewire de servicios
    Route::get('/servicios-livewire', function () {
        return view('service.index');
    })->name('servicios.livewire');

    // Ruta para el componente Livewire de inventario por usuario

    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    
});
