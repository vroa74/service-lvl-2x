<?php

require_once 'vendor/autoload.php';

use App\Models\Service;

// Simular el entorno de Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== PRUEBA DE RUTA PDF ===\n\n";

try {
    // 1. Verificar que el servicio existe
    echo "1. Verificando servicio ID 1...\n";
    $service = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->find(1);
    
    if (!$service) {
        echo "   ❌ Servicio no encontrado\n";
        exit(1);
    }
    
    echo "   ✓ Servicio encontrado: {$service->id_s}\n";
    
    // 2. Verificar relaciones
    echo "\n2. Verificando relaciones...\n";
    echo "   Solicitante: " . ($service->solicitante ? $service->solicitante->name : 'No asignado') . "\n";
    echo "   Efectuó: " . ($service->efectuo ? $service->efectuo->name : 'No asignado') . "\n";
    echo "   VºBº: " . ($service->vobo ? $service->vobo->name : 'No asignado') . "\n";
    
    if (is_object($service->capturo)) {
        echo "   Capturó: " . $service->capturo->name . "\n";
    } elseif (is_numeric($service->capturo)) {
        $capturoUser = \App\Models\User::find($service->capturo);
        echo "   Capturó: " . ($capturoUser ? $capturoUser->name : "Usuario ID: {$service->capturo}") . "\n";
    } else {
        echo "   Capturó: No asignado\n";
    }
    
    // 3. Preparar datos para la vista
    echo "\n3. Preparando datos para la vista...\n";
    $data = [
        'service' => $service,
        'title' => 'Reporte Individual de Servicio',
        'generatedAt' => now()->format('d/m/Y H:i:s'),
    ];
    
    echo "   ✓ Datos preparados\n";
    
    // 4. Verificar que la vista existe
    echo "\n4. Verificando vista...\n";
    $viewPath = resource_path('views/reports/services/individual.blade.php');
    if (file_exists($viewPath)) {
        echo "   ✓ Vista encontrada: {$viewPath}\n";
    } else {
        echo "   ❌ Vista no encontrada\n";
        exit(1);
    }
    
    // 5. Probar generación de HTML
    echo "\n5. Probando generación de HTML...\n";
    try {
        $html = view('reports.services.individual', $data)->render();
        echo "   ✓ HTML generado correctamente (" . strlen($html) . " caracteres)\n";
    } catch (\Exception $e) {
        echo "   ❌ Error generando HTML: " . $e->getMessage() . "\n";
        exit(1);
    }
    
    // 6. Probar generación de PDF
    echo "\n6. Probando generación de PDF...\n";
    try {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.services.individual', $data);
        $pdf->setPaper('letter', 'portrait');
        
        echo "   ✓ PDF configurado correctamente\n";
        
        // Generar el contenido
        $pdfContent = $pdf->output();
        echo "   ✓ PDF generado correctamente (" . strlen($pdfContent) . " bytes)\n";
        
    } catch (\Exception $e) {
        echo "   ❌ Error generando PDF: " . $e->getMessage() . "\n";
        echo "   Stack trace:\n" . $e->getTraceAsString() . "\n";
        exit(1);
    }
    
    echo "\n=== PRUEBA EXITOSA ===\n";
    echo "La ruta debería funcionar correctamente.\n";
    echo "URL de prueba: http://localhost:8000/service-pdf/1\n";
    
} catch (\Exception $e) {
    echo "\n❌ ERROR GENERAL: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
} 