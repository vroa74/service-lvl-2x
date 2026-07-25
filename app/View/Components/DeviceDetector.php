<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeviceDetector extends Component
{
    public $deviceType;
    public $breakpoint;
    public $scale;
    public $isMobile;
    public $screenWidth;
    public $screenHeight;
    public $userAgent;

    public function __construct()
    {
        $this->detectDevice();
    }

    private function detectDevice()
    {
        $this->userAgent = request()->header('User-Agent');
        $isMobileDevice = preg_match('/mobile|android|iphone|ipad|ipod|blackberry|iemobile|opera mini/i', strtolower($this->userAgent));
        
        $this->isMobile = $isMobileDevice;
        $this->deviceType = $isMobileDevice ? 'Móvil' : 'Desktop';
        $this->breakpoint = 'base'; // Se actualizará con JavaScript
        $this->scale = 1; // Se actualizará con JavaScript
        $this->screenWidth = 0; // Se actualizará con JavaScript
        $this->screenHeight = 0; // Se actualizará con JavaScript
    }

    /**
     * Obtiene el tipo de dispositivo (Móvil o Desktop)
     */
    public function getDeviceType(): string
    {
        return $this->deviceType;
    }

    /**
     * Verifica si es un dispositivo móvil
     */
    public function isMobileDevice(): bool
    {
        return $this->isMobile;
    }

    /**
     * Verifica si es un dispositivo desktop
     */
    public function isDesktopDevice(): bool
    {
        return !$this->isMobile;
    }

    /**
     * Obtiene el breakpoint de Tailwind CSS
     */
    public function getBreakpoint(): string
    {
        return $this->breakpoint;
    }

    /**
     * Obtiene la escala de la pantalla
     */
    public function getScale(): int
    {
        return $this->scale;
    }

    /**
     * Obtiene el ancho de la pantalla
     */
    public function getScreenWidth(): int
    {
        return $this->screenWidth;
    }

    /**
     * Obtiene el alto de la pantalla
     */
    public function getScreenHeight(): int
    {
        return $this->screenHeight;
    }

    /**
     * Obtiene el User Agent
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Obtiene información completa del dispositivo como array
     */
    public function getDeviceInfo(): array
    {
        return [
            'deviceType' => $this->deviceType,
            'isMobile' => $this->isMobile,
            'isDesktop' => !$this->isMobile,
            'breakpoint' => $this->breakpoint,
            'scale' => $this->scale,
            'screenWidth' => $this->screenWidth,
            'screenHeight' => $this->screenHeight,
            'userAgent' => $this->userAgent,
        ];
    }

    /**
     * Obtiene información del dispositivo como JSON
     */
    public function getDeviceInfoJson(): string
    {
        return json_encode($this->getDeviceInfo());
    }

    public function render()
    {
        return view('components.device-detector');
    }
} 