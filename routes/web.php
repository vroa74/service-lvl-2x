<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InventoryController;
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

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'),'verified', ])->group(function () {
    
    
    Route::resource('usuarios', UsuariosController::class)->names('usuarios');
    Route::resource('service', ServiceController::class)->names('servicios');
    Route::resource('inventario', InventoryController::class)->names('inventario');
    
    // Ruta para el componente Livewire de usuarios
    Route::get('/usuarios-livewire', function () {
        return view('usuarios-livewire');
    })->name('usuarios.livewire');
    
    // Ruta para el componente Livewire de servicios
    Route::get('/servicios-livewire', function () {
        return view('service.index');
    })->name('servicios.livewire');

    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    
});
