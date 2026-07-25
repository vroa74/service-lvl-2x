<?php

namespace App\Http\Controllers;

use App\View\Components\DeviceDetector;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        // Crear instancia del componente
        $deviceDetector = new DeviceDetector();
        
        // Obtener información del dispositivo
        $deviceInfo = $deviceDetector->getDeviceInfo();
        
        // Ejemplos de uso individual
        $isMobile = $deviceDetector->isMobileDevice();
        $isDesktop = $deviceDetector->isDesktopDevice();
        $deviceType = $deviceDetector->getDeviceType();
        $userAgent = $deviceDetector->getUserAgent();
        
        return view('example.index', compact(
            'deviceInfo',
            'isMobile',
            'isDesktop', 
            'deviceType',
            'userAgent'
        ));
    }

    public function apiDeviceInfo()
    {
        $deviceDetector = new DeviceDetector();
        
        return response()->json([
            'success' => true,
            'data' => $deviceDetector->getDeviceInfo()
        ]);
    }

    public function conditionalContent()
    {
        $deviceDetector = new DeviceDetector();
        
        // Contenido condicional basado en el dispositivo
        if ($deviceDetector->isMobileDevice()) {
            $content = 'Contenido optimizado para móvil';
        } else {
            $content = 'Contenido optimizado para desktop';
        }
        
        return view('example.conditional', compact('content', 'deviceDetector'));
    }
} 