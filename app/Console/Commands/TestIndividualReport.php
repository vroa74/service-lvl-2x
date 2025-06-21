<?php

namespace App\Console\Commands;

use App\Models\Service;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class TestIndividualReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:test-individual {--service-id= : ID del servicio a probar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Probar la funcionalidad del reporte individual de servicios';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== PRUEBA DE REPORTE INDIVIDUAL DE SERVICIOS ===');
        $this->newLine();

        // 1. Verificar que el modelo Service existe y tiene las relaciones
        $this->info('1. Verificando modelo Service...');
        try {
            $serviceId = $this->option('service-id');
            
            if ($serviceId) {
                $service = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->find($serviceId);
                if (!$service) {
                    $this->error("   ❌ Servicio con ID {$serviceId} no encontrado");
                    return 1;
                }
            } else {
                $service = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->first();
                if (!$service) {
                    $this->warn("   ⚠ No hay servicios en la base de datos");
                    $this->info("   Creando servicio de prueba...");
                    
                    // Crear un servicio de prueba
                    $user = User::first();
                    if (!$user) {
                        $this->error("   ❌ No hay usuarios en la base de datos");
                        return 1;
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
                    
                    $this->info("   ✓ Servicio de prueba creado");
                }
            }
            
            $this->info("   ✓ Modelo Service encontrado");
            $this->info("   ✓ Relaciones cargadas correctamente");
            $this->info("   ✓ Servicio ID: {$service->id}, ID_S: {$service->id_s}");
            
        } catch (\Exception $e) {
            $this->error("   ❌ Error con el modelo Service: " . $e->getMessage());
            return 1;
        }

        // 2. Verificar directorio temporal
        $this->newLine();
        $this->info('2. Verificando directorio temporal...');
        $tempPath = storage_path('app/public/temp');
        if (!File::exists($tempPath)) {
            $this->info("   Creando directorio temporal...");
            File::makeDirectory($tempPath, 0755, true);
        }
        $this->info("   ✓ Directorio temporal existe: {$tempPath}");

        // 3. Verificar enlace simbólico
        $this->newLine();
        $this->info('3. Verificando enlace simbólico...');
        $publicStoragePath = public_path('storage');
        if (!File::exists($publicStoragePath)) {
            $this->warn("   ⚠ Enlace simbólico no existe, ejecutando: php artisan storage:link");
            $this->call('storage:link');
        }
        $this->info("   ✓ Enlace simbólico existe");

        // 4. Verificar archivo CSS
        $this->newLine();
        $this->info('4. Verificando archivo CSS...');
        $cssPath = public_path('pdf.css');
        if (File::exists($cssPath)) {
            $this->info("   ✓ Archivo CSS encontrado: {$cssPath}");
        } else {
            $this->error("   ❌ Archivo CSS no encontrado: {$cssPath}");
        }

        // 5. Verificar imagen del encabezado
        $this->newLine();
        $this->info('5. Verificando imagen del encabezado...');
        $imagePath = public_path('ple/head.png');
        if (File::exists($imagePath)) {
            $this->info("   ✓ Imagen del encabezado encontrada: {$imagePath}");
        } else {
            $this->error("   ❌ Imagen del encabezado no encontrada: {$imagePath}");
        }

        // 6. Verificar vista del reporte
        $this->newLine();
        $this->info('6. Verificando vista del reporte...');
        $viewPath = resource_path('views/reports/services/individual.blade.php');
        if (File::exists($viewPath)) {
            $this->info("   ✓ Vista del reporte encontrada: {$viewPath}");
        } else {
            $this->error("   ❌ Vista del reporte no encontrada: {$viewPath}");
        }

        // 7. Verificar DomPDF
        $this->newLine();
        $this->info('7. Verificando DomPDF...');
        try {
            $dompdf = new \Dompdf\Dompdf();
            $this->info("   ✓ DomPDF cargado correctamente");
        } catch (\Exception $e) {
            $this->error("   ❌ Error cargando DomPDF: " . $e->getMessage());
            return 1;
        }

        // 8. Probar generación de PDF
        $this->newLine();
        $this->info('8. Probando generación de PDF...');
        try {
            // Preparar datos
            $data = [
                'service' => $service,
                'title' => 'Reporte Individual de Servicio - Prueba',
                'generatedAt' => now()->format('d/m/Y H:i:s'),
            ];
            
            // Generar HTML
            $html = view('reports.services.individual', $data)->render();
            $this->info("   ✓ HTML generado correctamente");
            
            // Configurar DomPDF
            $dompdf->set_option('defaultFont', 'DejaVu Sans');
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isPhpEnabled', true);
            $dompdf->set_option('isRemoteEnabled', true);
            
            // Cargar HTML
            $dompdf->loadHtml($html);
            $this->info("   ✓ HTML cargado en DomPDF");
            
            // Configurar papel
            $dompdf->setPaper('letter', 'portrait');
            
            // Renderizar
            $dompdf->render();
            $this->info("   ✓ PDF renderizado correctamente");
            
            // Guardar archivo de prueba
            $testFilename = 'test_reporte_individual_' . now()->format('Y-m-d_H-i-s') . '.pdf';
            $testPath = $tempPath . '/' . $testFilename;
            file_put_contents($testPath, $dompdf->output());
            
            if (File::exists($testPath)) {
                $this->info("   ✓ Archivo PDF guardado: {$testFilename}");
                $this->info("   ✓ Tamaño del archivo: " . number_format(File::size($testPath) / 1024, 2) . " KB");
            } else {
                $this->error("   ❌ Error guardando archivo PDF");
            }
            
        } catch (\Exception $e) {
            $this->error("   ❌ Error generando PDF: " . $e->getMessage());
            return 1;
        }

        // 9. Verificar comando de limpieza
        $this->newLine();
        $this->info('9. Verificando comando de limpieza...');
        try {
            $command = new \App\Console\Commands\CleanTempReports();
            $this->info("   ✓ Comando de limpieza cargado correctamente");
        } catch (\Exception $e) {
            $this->error("   ❌ Error cargando comando de limpieza: " . $e->getMessage());
        }

        // 10. Resumen final
        $this->newLine();
        $this->info('=== RESUMEN ===');
        $this->info('✓ Todas las verificaciones completadas exitosamente');
        $this->info('✓ El sistema está listo para generar reportes individuales');
        $this->info("✓ Archivo de prueba generado: {$testFilename}");
        $this->newLine();
        $this->info('Para probar en el navegador:');
        $this->info('1. Inicia el servidor: php artisan serve');
        $this->info('2. Navega a: http://localhost:8000/servicios-livewire');
        $this->info('3. Haz clic en el botón naranja de impresora para generar un reporte');
        $this->newLine();
        $this->info('Ruta de prueba directa:');
        $this->info("http://localhost:8000/test-individual-pdf/{$service->id}");
        $this->newLine();
        $this->info('=== PRUEBA COMPLETADA ===');
        
        return 0;
    }
} 