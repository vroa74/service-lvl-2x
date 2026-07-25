<?php

namespace App\Http\Controllers;

use App\View\Components\DeviceDetector;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Crear instancia del componente DeviceDetector
        $deviceDetector = new DeviceDetector();
        
        // Obtener información del dispositivo
        $deviceInfo = $deviceDetector->getDeviceInfo();
        
        // Información individual para usar en Blade
        $isMobile = $deviceDetector->isMobileDevice();
        $isDesktop = $deviceDetector->isDesktopDevice();
        $deviceType = $deviceDetector->getDeviceType();
        $breakpoint = $deviceDetector->getBreakpoint();
        $scale = $deviceDetector->getScale();
        $screenWidth = $deviceDetector->getScreenWidth();
        $screenHeight = $deviceDetector->getScreenHeight();
        $userAgent = $deviceDetector->getUserAgent();
        
        return view('dashboard', compact(
            'deviceDetector',
            'deviceInfo',
            'isMobile',
            'isDesktop',
            'deviceType',
            'breakpoint',
            'scale',
            'screenWidth',
            'screenHeight',
            'userAgent'
        ));
    }
} 