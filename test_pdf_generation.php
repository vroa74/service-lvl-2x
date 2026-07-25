<?php

require_once 'vendor/autoload.php';

use App\Livewire\Service\Index;
use Illuminate\Support\Facades\App;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Probando generación de reporte PDF...\n";
    
    $component = new Index();
    $component->reportType = 'general';
    $component->reportDateFrom = '2025-09-01';
    $component->reportDateTo = '2025-09-23';
    
    $component->generateReport();
    
    echo "Reporte generado exitosamente!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
