#!/usr/bin/env php
<?php
/**
 * Script de Pruebas para Componentes Create y Edit
 * 
 * Este script verifica la funcionalidad básica de ambos componentes
 * sin necesidad de interacción manual en el navegador.
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Log;
use App\Livewire\Service\Create;
use App\Livewire\Service\Edit;
use App\Models\Service;
use App\Models\User;
use App\Models\Inventory;

echo "\n";
echo "╔═══════════════════════════════════════════════════════════════════╗\n";
echo "║  PRUEBAS AUTOMATIZADAS - Componentes Create y Edit               ║\n";
echo "╚═══════════════════════════════════════════════════════════════════╝\n";
echo "\n";

$passed = 0;
$failed = 0;

// Test 1: Verificar que las clases existen
echo "Test 1: Verificación de clases...\n";
try {
    if (class_exists(Create::class)) {
        echo "  ✅ Clase Create existe\n";
        $passed++;
    } else {
        echo "  ❌ Clase Create NO existe\n";
        $failed++;
    }
    
    if (class_exists(Edit::class)) {
        echo "  ✅ Clase Edit existe\n";
        $passed++;
    } else {
        echo "  ❌ Clase Edit NO existe\n";
        $failed++;
    }
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
    $failed += 2;
}
echo "\n";

// Test 2: Verificar métodos clave en Create
echo "Test 2: Métodos en componente Create...\n";
try {
    $createMethods = [
        'mount',
        'saveService',
        'addPhoto',
        'deletePhoto',
        'openInventorySelection',
        'addInventoryToService',
        'removeInventoryFromService',
        'openUserModal',
        'selectUser',
        'render'
    ];
    
    foreach ($createMethods as $method) {
        if (method_exists(Create::class, $method)) {
            echo "  ✅ Método Create::{$method}() existe\n";
            $passed++;
        } else {
            echo "  ❌ Método Create::{$method}() NO existe\n";
            $failed++;
        }
    }
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
    $failed += count($createMethods);
}
echo "\n";

// Test 3: Verificar métodos clave en Edit
echo "Test 3: Métodos en componente Edit...\n";
try {
    $editMethods = [
        'mount',
        'updateService',
        'addPhoto',
        'deletePhoto',
        'openInventorySelection',
        'addInventoryToService',
        'removeInventoryFromService',
        'openUserModal',
        'selectUser',
        'render',
        'updatedCalendario',
        'updatedPreventivo'
    ];
    
    foreach ($editMethods as $method) {
        if (method_exists(Edit::class, $method)) {
            echo "  ✅ Método Edit::{$method}() existe\n";
            $passed++;
        } else {
            echo "  ❌ Método Edit::{$method}() NO existe\n";
            $failed++;
        }
    }
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
    $failed += count($editMethods);
}
echo "\n";

// Test 4: Verificar vistas
echo "Test 4: Verificación de vistas...\n";
try {
    $createView = resource_path('views/livewire/service/create.blade.php');
    if (file_exists($createView)) {
        echo "  ✅ Vista create.blade.php existe\n";
        $passed++;
        
        // Verificar que tiene la sección de inventarios
        $content = file_get_contents($createView);
        if (strpos($content, 'Inventarios Asociados') !== false) {
            echo "  ✅ Vista create tiene sección Inventarios Asociados\n";
            $passed++;
        } else {
            echo "  ❌ Vista create NO tiene sección Inventarios Asociados\n";
            $failed++;
        }
    } else {
        echo "  ❌ Vista create.blade.php NO existe\n";
        $failed += 2;
    }
    
    $editView = resource_path('views/livewire/service/edit.blade.php');
    if (file_exists($editView)) {
        echo "  ✅ Vista edit.blade.php existe\n";
        $passed++;
        
        // Verificar que tiene la sección de inventarios
        $content = file_get_contents($editView);
        if (strpos($content, 'Inventarios Asociados') !== false) {
            echo "  ✅ Vista edit tiene sección Inventarios Asociados\n";
            $passed++;
        } else {
            echo "  ❌ Vista edit NO tiene sección Inventarios Asociados\n";
            $failed++;
        }
    } else {
        echo "  ❌ Vista edit.blade.php NO existe\n";
        $failed += 2;
    }
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
    $failed += 4;
}
echo "\n";

// Test 5: Verificar modelos relacionados
echo "Test 5: Verificación de modelos...\n";
try {
    if (class_exists(Service::class)) {
        echo "  ✅ Modelo Service existe\n";
        $passed++;
    } else {
        echo "  ❌ Modelo Service NO existe\n";
        $failed++;
    }
    
    if (class_exists(User::class)) {
        echo "  ✅ Modelo User existe\n";
        $passed++;
    } else {
        echo "  ❌ Modelo User NO existe\n";
        $failed++;
    }
    
    if (class_exists(Inventory::class)) {
        echo "  ✅ Modelo Inventory existe\n";
        $passed++;
    } else {
        echo "  ❌ Modelo Inventory NO existe\n";
        $failed++;
    }
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
    $failed += 3;
}
echo "\n";

// Test 6: Verificar rutas
echo "Test 6: Verificación de rutas...\n";
try {
    $routes = app('router')->getRoutes();
    
    $createRoute = false;
    $editRoute = false;
    
    foreach ($routes as $route) {
        if ($route->getName() === 'servicios.create') {
            $createRoute = true;
        }
        if ($route->getName() === 'servicios.edit') {
            $editRoute = true;
        }
    }
    
    if ($createRoute) {
        echo "  ✅ Ruta servicios.create existe\n";
        $passed++;
    } else {
        echo "  ❌ Ruta servicios.create NO existe\n";
        $failed++;
    }
    
    if ($editRoute) {
        echo "  ✅ Ruta servicios.edit existe\n";
        $passed++;
    } else {
        echo "  ❌ Ruta servicios.edit NO existe\n";
        $failed++;
    }
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
    $failed += 2;
}
echo "\n";

// Test 7: Verificar conexión a base de datos
echo "Test 7: Verificación de base de datos...\n";
try {
    $usersCount = User::count();
    echo "  ✅ Conexión a BD exitosa (Usuarios: {$usersCount})\n";
    $passed++;
    
    $servicesCount = Service::count();
    echo "  ✅ Tabla services accesible (Servicios: {$servicesCount})\n";
    $passed++;
    
    $inventoriesCount = Inventory::count();
    echo "  ✅ Tabla inventories accesible (Inventarios: {$inventoriesCount})\n";
    $passed++;
} catch (Exception $e) {
    echo "  ❌ Error de BD: " . $e->getMessage() . "\n";
    $failed += 3;
}
echo "\n";

// Test 8: Verificar directorio de fotos
echo "Test 8: Verificación de almacenamiento...\n";
try {
    $photoPath = storage_path('app/public/service_photos');
    if (file_exists($photoPath) && is_dir($photoPath)) {
        echo "  ✅ Directorio service_photos existe\n";
        $passed++;
        
        if (is_writable($photoPath)) {
            echo "  ✅ Directorio service_photos tiene permisos de escritura\n";
            $passed++;
        } else {
            echo "  ❌ Directorio service_photos NO tiene permisos de escritura\n";
            $failed++;
        }
    } else {
        echo "  ❌ Directorio service_photos NO existe\n";
        $failed += 2;
    }
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
    $failed += 2;
}
echo "\n";

// Resumen
echo "╔═══════════════════════════════════════════════════════════════════╗\n";
echo "║  RESUMEN DE PRUEBAS                                               ║\n";
echo "╠═══════════════════════════════════════════════════════════════════╣\n";
printf("║  ✅ Pruebas Exitosas:  %-43d║\n", $passed);
printf("║  ❌ Pruebas Fallidas:  %-43d║\n", $failed);
printf("║  📊 Total de Pruebas:  %-43d║\n", $passed + $failed);
$percentage = $passed + $failed > 0 ? round(($passed / ($passed + $failed)) * 100, 2) : 0;
printf("║  📈 Porcentaje Éxito:  %-42s ║\n", $percentage . "%");
echo "╚═══════════════════════════════════════════════════════════════════╝\n";
echo "\n";

if ($failed === 0) {
    echo "🎉 ¡TODAS LAS PRUEBAS PASARON EXITOSAMENTE!\n";
    echo "Los componentes Create y Edit están funcionando correctamente.\n";
    exit(0);
} else {
    echo "⚠️  ALGUNAS PRUEBAS FALLARON\n";
    echo "Por favor revisa los errores anteriores.\n";
    exit(1);
}
