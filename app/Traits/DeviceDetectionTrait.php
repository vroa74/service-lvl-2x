<?php

namespace App\Traits;

use App\View\Components\DeviceDetector;

trait DeviceDetectionTrait
{
    /**
     * Obtener información del dispositivo para todas las vistas
     */
    private function getDeviceInfo()
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
        
        return compact(
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
        );
    }
} 