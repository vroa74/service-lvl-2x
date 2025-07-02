<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CartasCesponsivasController;
use App\Http\Controllers\CartasResponsivaController;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ============================================================================
// RUTAS PÚBLICAS
// ============================================================================

Route::get('/', function () {
    return view('welcome');
});

// ============================================================================
// RUTAS DE REPORTES PDF (PÚBLICAS PARA PRUEBAS)
// ============================================================================

// Reporte individual de servicio
Route::get('/service-pdf/{id}', function ($id) {
    try {
        $service = \App\Models\Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->findOrFail($id);
        
        $data = [
            'service' => $service,
            'title' => 'Reporte Individual de Servicio',
            'generatedAt' => now()->format('d/m/Y H:i:s'),
        ];
        
        $pdf = PDF::loadView('reports.services.individual', $data)
                  ->setPaper('letter', 'portrait');
        
        return $pdf->stream('reporte_servicio_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $service->id_s) . '.pdf');
        
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Error generando PDF para servicio ' . $id . ': ' . $e->getMessage());
        abort(500, 'Error al generar el PDF. Por favor, revise los logs.');
    }
})->name('service.pdf');

// Reporte individual de inventario
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

// ============================================================================
// RUTAS PROTEGIDAS (REQUIEREN AUTENTICACIÓN)
// ============================================================================

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    // ========================================================================
    // DASHBOARD
    // ========================================================================
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ========================================================================
    // GESTIÓN DE USUARIOS
    // ========================================================================
    
    Route::resource('usuarios', UsuariosController::class)->names('usuarios');
    
    // Componente Livewire de usuarios
    Route::get('/usuarios-livewire', function () {
        return view('usuarios-livewire');
    })->name('usuarios.livewire');

    // ========================================================================
    // GESTIÓN DE SERVICIOS
    // ========================================================================
    
    Route::resource('service', ServiceController::class)->names('servicios');
    
    // Componente Livewire de servicios
    Route::get('/servicios-livewire', function () {
        return view('service.index');
    })->name('servicios.livewire');

    // ========================================================================
    // GESTIÓN DE INVENTARIO
    // ========================================================================
    
    Route::resource('inventario', InventoryController::class)->names('inventario');
    Route::get('/inventory-user-inv', [InventoryController::class, 'userinv'])->name('inventory.user-inv');

    // ========================================================================
    // GESTIÓN DE CARTAS RESPONSIVAS
    // ========================================================================
    
    // Rutas principales de cartas responsivas
    Route::resource('cartasresponsivas', CartasCesponsivasController::class)->names('cartasresponsivas');
    
    // Rutas para la página de carta responsiva
    Route::get('/cartasresponsiva/{id}', [CartasResponsivaController::class, 'show'])->name('cartasresponsiva.show');
    Route::get('/cartasresponsiva-codigo/{codigo}', [CartasResponsivaController::class, 'showByCode'])->name('cartasresponsiva.showByCode');
    
    // Ruta para generar PDF
    Route::get('/cartasresponsiva-pdf/{id}', [CartasResponsivaController::class, 'generatePdf'])->name('cartasresponsiva.pdf');
});
