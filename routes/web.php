<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CartasCesponsivasController;
use App\Http\Controllers\CartasResponsivaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
// RUTAS DE AUTENTICACIÓN PERSONALIZADAS
// ============================================================================

// Rutas de Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de Registro (DESHABILITADAS)
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// ============================================================================
// RUTAS DE REPORTES PDF (PÚBLICAS PARA PRUEBAS)
// ============================================================================

// Reporte individual de servicio
Route::get('/service-pdf/{id}', [ServiceController::class, 'generatePdf'])->name('service.pdf');

// Reporte detallado de servicio
Route::get('/service-details-pdf/{id}', [ServiceController::class, 'generateDetailsPdf'])->name('service.details.pdf');

// Reporte individual de inventario
Route::get('/inventory-pdf/{id}', [InventoryController::class, 'generatePdf'])->name('inventory.pdf');

// ============================================================================
// RUTAS PROTEGIDAS (REQUIEREN AUTENTICACIÓN)
// ============================================================================

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    // ========================================================================
    // DASHBOARD
    // ========================================================================
    
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

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
    Route::get('/inventory-responsables', [InventoryController::class, 'responsables'])->name('inventory.responsables');
    Route::get('/inventario/export/csv', [InventoryController::class, 'exportCSV'])->name('inventario.export.csv');
    Route::get('/inventario/export/html', [InventoryController::class, 'exportHTML'])->name('inventario.export.html');

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
    
    // Ruta temporal para probar Livewire
    Route::get('/test-livewire', function () {
        return view('test-livewire');
    })->name('test.livewire');
});
