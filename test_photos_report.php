<?php

require_once 'vendor/autoload.php';

use App\Models\Service;
use App\Models\ServicePhoto;

// Simular el entorno de Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== PRUEBA DE FOTOS EN REPORTES ===\n\n";

// Obtener servicios con fotos
$services = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo', 'photos'])->get();

echo "Total de servicios: " . $services->count() . "\n";
echo "Servicios con fotos: " . $services->where('photos.count', '>', 0)->count() . "\n\n";

foreach ($services as $service) {
    echo "Servicio ID: " . $service->id_s . "\n";
    echo "Fotos: " . $service->photos->count() . "\n";
    
    foreach ($service->photos as $photo) {
        echo "  - Foto: " . $photo->photo_path . "\n";
        echo "    Descripción: " . ($photo->description ?: 'Sin descripción') . "\n";
        
        // Verificar si el archivo existe
        $imagePath = storage_path('app/public/' . $photo->photo_path);
        if (file_exists($imagePath)) {
            echo "    ✅ Archivo existe\n";
            
            // Probar la conversión a base64
            try {
                $imageData = base64_encode(file_get_contents($imagePath));
                $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                $imageSrc = "data:image/$imageType;base64,$imageData";
                echo "    ✅ Base64 generado correctamente\n";
                echo "    Tamaño base64: " . strlen($imageData) . " caracteres\n";
            } catch (Exception $e) {
                echo "    ❌ Error al generar base64: " . $e->getMessage() . "\n";
            }
        } else {
            echo "    ❌ Archivo no existe: " . $imagePath . "\n";
        }
        echo "\n";
    }
    echo "---\n";
}

echo "\n=== FIN DE PRUEBA ===\n"; 