<?php
/**
 * Script de Diagnóstico para Subida de Imágenes
 * 
 * Este script verifica:
 * 1. Permisos de directorios
 * 2. Configuración de PHP para subida de archivos
 * 3. Enlace simbólico de storage
 * 4. Configuración de Laravel filesystem
 * 5. Prueba de escritura en storage
 */

echo "=== DIAGNÓSTICO DE SUBIDA DE IMÁGENES ===\n\n";

// 1. Información del sistema
echo "1. INFORMACIÓN DEL SISTEMA\n";
echo "   - PHP Version: " . PHP_VERSION . "\n";
echo "   - Sistema Operativo: " . PHP_OS . "\n";
echo "   - Usuario del servidor: " . get_current_user() . "\n\n";

// 2. Configuración de PHP
echo "2. CONFIGURACIÓN PHP PARA ARCHIVOS\n";
echo "   - upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "   - post_max_size: " . ini_get('post_max_size') . "\n";
echo "   - max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "   - memory_limit: " . ini_get('memory_limit') . "\n";
echo "   - file_uploads: " . (ini_get('file_uploads') ? 'Habilitado' : 'Deshabilitado') . "\n\n";

// 3. Directorios y permisos
echo "3. DIRECTORIOS Y PERMISOS\n";

$directories = [
    'storage/app/public',
    'storage/app/public/service_photos',
    'storage/app/public/inventory_photos',
    'storage/app/public/profile-photos',
    'public/storage',
];

foreach ($directories as $dir) {
    $fullPath = __DIR__ . '/' . $dir;
    echo "   - {$dir}:\n";
    
    if (file_exists($fullPath)) {
        echo "     ✓ Existe\n";
        echo "     - Es directorio: " . (is_dir($fullPath) ? 'Sí' : 'No') . "\n";
        echo "     - Es link simbólico: " . (is_link($fullPath) ? 'Sí' : 'No') . "\n";
        echo "     - Escribible: " . (is_writable($fullPath) ? 'Sí' : 'No') . "\n";
        echo "     - Permisos: " . substr(sprintf('%o', fileperms($fullPath)), -4) . "\n";
        
        if (is_link($fullPath)) {
            echo "     - Apunta a: " . readlink($fullPath) . "\n";
        }
    } else {
        echo "     ✗ NO EXISTE\n";
    }
    echo "\n";
}

// 4. Prueba de escritura
echo "4. PRUEBA DE ESCRITURA\n";
$testDir = __DIR__ . '/storage/app/public/service_photos';
$testFile = $testDir . '/test_' . time() . '.txt';

try {
    if (!file_exists($testDir)) {
        mkdir($testDir, 0755, true);
        echo "   ✓ Directorio creado: {$testDir}\n";
    }
    
    $result = file_put_contents($testFile, 'Test de escritura: ' . date('Y-m-d H:i:s'));
    
    if ($result !== false) {
        echo "   ✓ Escritura exitosa en: {$testFile}\n";
        echo "   - Bytes escritos: {$result}\n";
        
        // Limpiar archivo de prueba
        if (unlink($testFile)) {
            echo "   ✓ Archivo de prueba eliminado\n";
        }
    } else {
        echo "   ✗ ERROR: No se pudo escribir en {$testFile}\n";
    }
} catch (Exception $e) {
    echo "   ✗ EXCEPCIÓN: " . $e->getMessage() . "\n";
}
echo "\n";

// 5. Verificar configuración de Laravel (si está disponible)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
    
    try {
        $app = require_once __DIR__ . '/bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        
        echo "5. CONFIGURACIÓN DE LARAVEL\n";
        
        $filesystemDisk = config('filesystems.default');
        echo "   - Disco por defecto: {$filesystemDisk}\n";
        
        $publicDiskConfig = config('filesystems.disks.public');
        echo "   - Configuración disco 'public':\n";
        echo "     - Driver: " . ($publicDiskConfig['driver'] ?? 'N/A') . "\n";
        echo "     - Root: " . ($publicDiskConfig['root'] ?? 'N/A') . "\n";
        echo "     - URL: " . ($publicDiskConfig['url'] ?? 'N/A') . "\n";
        echo "     - Visibility: " . ($publicDiskConfig['visibility'] ?? 'N/A') . "\n\n";
        
        // Verificar enlace simbólico
        $links = config('filesystems.links');
        echo "   - Enlaces simbólicos configurados:\n";
        foreach ($links as $link => $target) {
            echo "     - {$link} => {$target}\n";
            echo "       Existe: " . (file_exists($link) ? 'Sí' : 'No') . "\n";
        }
        
    } catch (Exception $e) {
        echo "5. ERROR AL CARGAR LARAVEL\n";
        echo "   - " . $e->getMessage() . "\n";
    }
} else {
    echo "5. Laravel no está disponible para diagnóstico\n";
}

echo "\n=== FIN DEL DIAGNÓSTICO ===\n";
echo "\nINSTRUCCIONES PARA EL SERVIDOR:\n";
echo "1. Sube este archivo al servidor\n";
echo "2. Ejecuta: php diagnostico_imagenes.php\n";
echo "3. Revisa la salida y compárala con este resultado local\n";
echo "4. Si 'public/storage' no existe en el servidor, ejecuta: php artisan storage:link\n";
echo "5. Si hay problemas de permisos, ejecuta: chmod -R 755 storage bootstrap/cache\n";
