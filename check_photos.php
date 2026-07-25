<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== VERIFICACIÓN DE FOTOS ===\n\n";

// 1. Últimas fotos en BD
echo "1. ÚLTIMAS 5 FOTOS EN BASE DE DATOS:\n";
$photos = DB::table('service_photos')
    ->orderBy('id', 'desc')
    ->limit(5)
    ->get(['id', 'service_id', 'photo_path', 'created_at']);

foreach ($photos as $photo) {
    echo "   ID: {$photo->id} | Service: {$photo->service_id} | Path: {$photo->photo_path} | Fecha: {$photo->created_at}\n";
    
    // Verificar si el archivo existe
    $fullPath = storage_path('app/public/' . $photo->photo_path);
    $exists = file_exists($fullPath) ? '✓ EXISTE' : '✗ NO EXISTE';
    echo "   Archivo: {$exists}\n\n";
}

// 2. Archivos en carpeta
echo "\n2. ÚLTIMOS 5 ARCHIVOS EN CARPETA:\n";
$directory = storage_path('app/public/service_photos');
$files = glob($directory . '/*');

// Ordenar por fecha de modificación
usort($files, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

$recentFiles = array_slice($files, 0, 5);
foreach ($recentFiles as $file) {
    $fileName = basename($file);
    $fileDate = date('Y-m-d H:i:s', filemtime($file));
    $fileSize = filesize($file);
    echo "   Archivo: {$fileName}\n";
    echo "   Fecha: {$fileDate} | Tamaño: " . round($fileSize/1024, 2) . " KB\n\n";
}

// 3. Resumen
echo "\n3. RESUMEN:\n";
$totalPhotosDB = DB::table('service_photos')->count();
$totalFilesFolder = count(glob($directory . '/*'));
echo "   Total fotos en BD: {$totalPhotosDB}\n";
echo "   Total archivos en carpeta: {$totalFilesFolder}\n";
echo "   Diferencia: " . ($totalPhotosDB - $totalFilesFolder) . " (debería ser 0)\n";

// 4. Fotos de HOY
echo "\n4. FOTOS CREADAS HOY:\n";
$today = date('Y-m-d');
$todayPhotos = DB::table('service_photos')
    ->whereDate('created_at', $today)
    ->get(['id', 'service_id', 'photo_path', 'created_at']);

echo "   Total fotos de hoy: " . $todayPhotos->count() . "\n";
foreach ($todayPhotos as $photo) {
    echo "   ID: {$photo->id} | Service: {$photo->service_id} | {$photo->created_at}\n";
    $fullPath = storage_path('app/public/' . $photo->photo_path);
    $exists = file_exists($fullPath) ? '✓' : '✗ FALTA ARCHIVO';
    echo "   {$exists} {$photo->photo_path}\n";
}
