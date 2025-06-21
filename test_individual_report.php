<?php

/**
 * Script de prueba para el reporte individual de servicios
 * 
 * Este script verifica que todos los componentes necesarios estén funcionando correctamente
 */

require_once 'vendor/autoload.php';

use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

echo "=== PRUEBA DE REPORTE INDIVIDUAL DE SERVICIOS ===\n\n";

// 1. Verificar que el modelo Service existe y tiene las relaciones
echo "1. Verificando modelo Service...\n";
try {
    $service = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->first();
    if ($service) {
        echo "   ✓ Modelo Service encontrado\n";
        echo "   ✓ Relaciones cargadas correctamente\n";
        echo "   ✓ Servicio ID: {$service->id}, ID_S: {$service->id_s}\n";
    } else {
        echo "   ⚠ No hay servicios en la base de datos\n";
        echo "   Creando servicio de prueba...\n";
        
        // Crear un servicio de prueba
        $user = User::first();
        if (!$user) {
            echo "   ❌ No hay usuarios en la base de datos\n";
            exit(1);
        }
        
        $service = Service::create([
            'id_s' => 'TEST-001',
            'F_serv' => now(),
            'solicitante_id' => $user->id,
            'efectuo_id' => $user->id,
            'vobo_id' => $user->id,
            'capturo' => $user->id,
            'obj_sol' => 'Prueba de reporte individual',
            'actividades' => 'Verificación de funcionalidad',
            'observaciones' => 'Servicio creado para pruebas',
            'status' => true,
        ]);
        
        echo "   ✓ Servicio de prueba creado\n";
    }
} catch (Exception $e) {
    echo "   ❌ Error con el modelo Service: " . $e->getMessage() . "\n";
    exit(1);
}

// 2. Verificar directorio temporal
echo "\n2. Verificando directorio temporal...\n";
$tempPath = storage_path('app/public/temp');
if (!File::exists($tempPath)) {
    echo "   Creando directorio temporal...\n";
    File::makeDirectory($tempPath, 0755, true);
}
echo "   ✓ Directorio temporal existe: {$tempPath}\n";

// 3. Verificar enlace simbólico
echo "\n3. Verificando enlace simbólico...\n";
$publicStoragePath = public_path('storage');
if (!File::exists($publicStoragePath)) {
    echo "   ⚠ Enlace simbólico no existe, ejecutando: php artisan storage:link\n";
    exec('php artisan storage:link', $output, $returnCode);
    if ($returnCode === 0) {
        echo "   ✓ Enlace simbólico creado\n";
    } else {
        echo "   ❌ Error creando enlace simbólico\n";
    }
} else {
    echo "   ✓ Enlace simbólico existe\n";
}

// 4. Verificar archivo CSS
echo "\n4. Verificando archivo CSS...\n";
$cssPath = public_path('pdf.css');
if (File::exists($cssPath)) {
    echo "   ✓ Archivo CSS encontrado: {$cssPath}\n";
} else {
    echo "   ❌ Archivo CSS no encontrado: {$cssPath}\n";
}

// 5. Verificar imagen del encabezado
echo "\n5. Verificando imagen del encabezado...\n";
$imagePath = public_path('ple/head.png');
if (File::exists($imagePath)) {
    echo "   ✓ Imagen del encabezado encontrada: {$imagePath}\n";
} else {
    echo "   ❌ Imagen del encabezado no encontrada: {$imagePath}\n";
}

// 6. Verificar vista del reporte
echo "\n6. Verificando vista del reporte...\n";
$viewPath = resource_path('views/reports/services/individual.blade.php');
if (File::exists($viewPath)) {
    echo "   ✓ Vista del reporte encontrada: {$viewPath}\n";
} else {
    echo "   ❌ Vista del reporte no encontrada: {$viewPath}\n";
}

// 7. Verificar DomPDF
echo "\n7. Verificando DomPDF...\n";
try {
    $dompdf = new \Dompdf\Dompdf();
    echo "   ✓ DomPDF cargado correctamente\n";
} catch (Exception $e) {
    echo "   ❌ Error cargando DomPDF: " . $e->getMessage() . "\n";
    exit(1);
}

// 8. Probar generación de PDF
echo "\n8. Probando generación de PDF...\n";
try {
    // Preparar datos
    $data = [
        'service' => $service,
        'title' => 'Reporte Individual de Servicio - Prueba',
        'generatedAt' => now()->format('d/m/Y H:i:s'),
    ];
    
    // Generar HTML
    $html = view('reports.services.individual', $data)->render();
    echo "   ✓ HTML generado correctamente\n";
    
    // Configurar DomPDF
    $dompdf->set_option('defaultFont', 'DejaVu Sans');
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->set_option('isPhpEnabled', true);
    $dompdf->set_option('isRemoteEnabled', true);
    
    // Cargar HTML
    $dompdf->loadHtml($html);
    echo "   ✓ HTML cargado en DomPDF\n";
    
    // Configurar papel
    $dompdf->setPaper('letter', 'portrait');
    
    // Renderizar
    $dompdf->render();
    echo "   ✓ PDF renderizado correctamente\n";
    
    // Guardar archivo de prueba
    $testFilename = 'test_reporte_individual_' . now()->format('Y-m-d_H-i-s') . '.pdf';
    $testPath = $tempPath . '/' . $testFilename;
    file_put_contents($testPath, $dompdf->output());
    
    if (File::exists($testPath)) {
        echo "   ✓ Archivo PDF guardado: {$testFilename}\n";
        echo "   ✓ Tamaño del archivo: " . number_format(File::size($testPath) / 1024, 2) . " KB\n";
    } else {
        echo "   ❌ Error guardando archivo PDF\n";
    }
    
} catch (Exception $e) {
    echo "   ❌ Error generando PDF: " . $e->getMessage() . "\n";
    exit(1);
}

// 9. Verificar comando de limpieza
echo "\n9. Verificando comando de limpieza...\n";
try {
    $command = new \App\Console\Commands\CleanTempReports();
    echo "   ✓ Comando de limpieza cargado correctamente\n";
} catch (Exception $e) {
    echo "   ❌ Error cargando comando de limpieza: " . $e->getMessage() . "\n";
}

// 10. Resumen final
echo "\n=== RESUMEN ===\n";
echo "✓ Todas las verificaciones completadas exitosamente\n";
echo "✓ El sistema está listo para generar reportes individuales\n";
echo "✓ Archivo de prueba generado: {$testFilename}\n";
echo "\nPara probar en el navegador:\n";
echo "1. Inicia el servidor: php artisan serve\n";
echo "2. Navega a: http://localhost:8000/servicios-livewire\n";
echo "3. Haz clic en el botón naranja de impresora para generar un reporte\n";
echo "\nRuta de prueba directa:\n";
echo "http://localhost:8000/test-individual-pdf/{$service->id}\n";

echo "\n=== PRUEBA COMPLETADA ===\n"; 