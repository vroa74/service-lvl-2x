<?php

namespace App\Livewire\Service;

use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $editing = false;
    public $serviceId = null;

    // Propiedades para optimización móvil
    public $limitResults = 15;
    public $enablePagination = true;
    public $isMobileOptimized = false;
    public $deviceType = 'desktop';
    public $showMobileFilters = false;

    // Propiedades para reportes
    public $showReportModal = false;
    public $reportType = '';
    public $reportDateFrom = '';
    public $reportDateTo = '';
    public $reportUser = '';
    public $reportStatus = '';

    // Campos del formulario para edición
    public $id_s = '';
    public $F_serv = '';
    public $solicitante_id = '';
    public $solicitante2_id = '';
    public $efectuo_id = '';
    public $vobo_id = '';
    public $obj_sol = '';
    public $actividades = '';
    public $mantenimiento = '';
    public $observaciones = '';
    
    // Tipo de servicio
    public $correctivo = false;
    public $preventivo = false;
    public $transparencia = false;
    public $a_tec = false;
    public $web_ins = false;
    public $print = false;
    
    // Via de solicitud
    public $email = false;
    public $tel = false;
    public $sol_ser = false;
    public $oficio = false;
    public $calendario = false;
    
    public $capturo = '';
    public $status = false;
    public $impressions = false;

    protected $rules = [
        'id_s' => 'nullable|string|max:25',
        'F_serv' => 'nullable|date',
        'solicitante_id' => 'required|exists:users,id',
        'solicitante2_id' => 'nullable|exists:users,id',
        'efectuo_id' => 'required|exists:users,id',
        'vobo_id' => 'required|exists:users,id',
        'obj_sol' => 'nullable|string',
        'actividades' => 'nullable|string',
        'mantenimiento' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'correctivo' => 'boolean',
        'preventivo' => 'boolean',
        'transparencia' => 'boolean',
        'a_tec' => 'boolean',
        'web_ins' => 'boolean',
        'print' => 'boolean',
        'email' => 'boolean',
        'tel' => 'boolean',
        'sol_ser' => 'boolean',
        'oficio' => 'boolean',
        'calendario' => 'boolean',
        'capturo' => 'required|exists:users,id',
        'status' => 'boolean',
        'impressions' => 'boolean',
    ];

    protected $messages = [
        'F_serv.date' => 'La fecha debe ser válida',
        'solicitante_id.exists' => 'El solicitante debe ser un usuario válido',
        'solicitante2_id.exists' => 'El solicitante 2 debe ser un usuario válido',
        'efectuo_id.exists' => 'El usuario que efectuó debe ser válido',
        'vobo_id.exists' => 'El usuario de VºBº debe ser válido',
        'capturo.exists' => 'El usuario que captura debe ser válido',
    ];

    public function mount()
    {
        // Detectar dispositivo y configurar optimizaciones
        $device = $this->detectDevice();
        $this->deviceType = $device['isMobile'] ? 'mobile' : ($device['isTablet'] ? 'tablet' : 'desktop');
        $this->isMobileOptimized = $device['isMobile'];
        
        if ($device['isMobile']) {
            $this->limitResults = 10;
            $this->enablePagination = true;
        }
        
        // Aplicar optimizaciones móviles si es necesario
        if ($device['isMobile']) {
            $this->optimizeForMobile();
            $this->enhanceTouchExperience();
            $this->optimizeScroll();
        }
    }

    // Método para detectar el tipo de dispositivo
    public function detectDevice()
    {
        $userAgent = request()->header('User-Agent');
        $isMobile = preg_match('/(android|iphone|ipad|mobile)/i', $userAgent);
        $isTablet = preg_match('/(ipad|tablet)/i', $userAgent);
        
        return [
            'isMobile' => $isMobile,
            'isTablet' => $isTablet,
            'isDesktop' => !$isMobile && !$isTablet
        ];
    }

    // Método para optimizar el rendimiento en móviles
    public function optimizeForMobile()
    {
        $this->dispatch('mobile-optimization', [
            'reduceAnimations' => true,
            'lazyLoadImages' => true,
            'compactLayout' => true
        ]);
    }

    // Método para mejorar la experiencia táctil
    public function enhanceTouchExperience()
    {
        $this->dispatch('enhance-touch', [
            'enableSwipeGestures' => true,
            'increaseTouchTargets' => true,
            'addHapticFeedback' => true
        ]);
    }

    // Método para optimizar el scroll en móviles
    public function optimizeScroll()
    {
        $this->dispatch('optimize-scroll', [
            'smoothScrolling' => true,
            'momentumScrolling' => true,
            'scrollIndicators' => true
        ]);
    }

    // Método para alternar filtros móviles
    public function toggleMobileFilters()
    {
        $this->showMobileFilters = !$this->showMobileFilters;
    }

    // Método para optimizar las consultas de base de datos para móviles
    public function optimizeQueriesForMobile()
    {
        $device = $this->detectDevice();
        
        if ($device['isMobile']) {
            // Reducir la cantidad de registros cargados en móviles
            $this->limitResults = 10;
            $this->enablePagination = true;
        } else {
            $this->limitResults = 15;
            $this->enablePagination = false;
        }
    }

    // Método para optimizar el almacenamiento en caché
    public function optimizeCache()
    {
        $device = $this->detectDevice();
        
        if ($device['isMobile']) {
            // Usar caché más agresivo en móviles para mejorar el rendimiento
            cache()->put('mobile_services_list_' . md5($this->search), true, now()->addMinutes(15));
        }
    }

    // Método para mejorar la accesibilidad en móviles
    public function enhanceMobileAccessibility()
    {
        $this->dispatch('enhance-accessibility', [
            'increaseFontSize' => true,
            'improveContrast' => true,
            'addFocusIndicators' => true,
            'enableVoiceOver' => true
        ]);
    }

    // Método para manejar la conectividad lenta
    public function handleSlowConnection()
    {
        $this->dispatch('slow-connection', [
            'showLoadingIndicators' => true,
            'enableOfflineMode' => true,
            'reduceDataUsage' => true
        ]);
    }

    // Método para optimizar el uso de memoria
    public function optimizeMemoryUsage()
    {
        $device = $this->detectDevice();
        
        if ($device['isMobile']) {
            // Limpiar variables no utilizadas
            gc_collect_cycles();
            
            $this->dispatch('memory-optimization', [
                'clearCache' => true,
                'reduceAnimations' => true,
                'limitConcurrentRequests' => true
            ]);
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
        
        // Optimizar búsqueda en móviles
        $device = $this->detectDevice();
        if ($device['isMobile']) {
            $this->optimizeCache();
            $this->handleSlowConnection();
        }
    }

    public function editService($serviceId)
    {
        // Redirigir a la página de edición
        return redirect()->route('servicios.edit', $serviceId);
    }

    public function toggleStatus($serviceId)
    {
        $service = Service::find($serviceId);
        $service->update(['status' => !$service->status]);
        session()->flash('message', 'Estado del servicio actualizado.');
    }

    // Métodos para reportes
    public function openReportModal($type = 'general')
    {
        $this->reportType = $type;
        $this->reportDateFrom = now()->startOfMonth()->format('Y-m-d');
        $this->reportDateTo = now()->format('Y-m-d');
        $this->reportUser = '';
        $this->reportStatus = '';
        $this->showReportModal = true;
    }

    public function closeReportModal()
    {
        $this->showReportModal = false;
        $this->reportType = '';
        $this->reportDateFrom = '';
        $this->reportDateTo = '';
        $this->reportUser = '';
        $this->reportStatus = '';
    }

    public function generateReport()
    {
        try {
            $query = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo']);

            // Aplicar filtros según el tipo de reporte
            if ($this->reportDateFrom && $this->reportDateTo) {
                $query->whereBetween('F_serv', [$this->reportDateFrom, $this->reportDateTo]);
            }

            if ($this->reportUser) {
                $query->where(function ($q) {
                    $q->where('solicitante_id', $this->reportUser)
                      ->orWhere('efectuo_id', $this->reportUser)
                      ->orWhere('vobo_id', $this->reportUser)
                      ->orWhere('capturo', $this->reportUser);
                });
            }

            if ($this->reportStatus !== '') {
                $query->where('status', $this->reportStatus);
            }

            $services = $query->orderBy('F_serv', 'desc')->get();

            // Generar el reporte según el tipo
            switch ($this->reportType) {
                case 'general':
                    $filename = $this->generateGeneralReport($services);
                    break;
                case 'por_usuario':
                    $filename = $this->generateUserReport($services);
                    break;
                case 'por_tipo':
                    $filename = $this->generateTypeReport($services);
                    break;
                case 'por_fecha':
                    $filename = $this->generateDateReport($services);
                    break;
                default:
                    $filename = $this->generateGeneralReport($services);
                    break;
            }

            // Cerrar el modal
            $this->closeReportModal();

            // Emitir evento para descargar el archivo
            $this->dispatch('download-report', url: '/storage/temp/' . $filename);

            session()->flash('message', 'Reporte generado correctamente. La descarga comenzará automáticamente.');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }

    // Método para generar reporte individual de servicio
    public function generateIndividualServiceReport($serviceId)
    {
        try {
            // Buscar el servicio y actualizar los campos
            $service = Service::find($serviceId);
            if ($service) {
                $service->update([
                    'impressions' => true,
                    'status' => true
                ]);
            }
            
            // Emitir evento inmediatamente para abrir el PDF en nueva pestaña
            $this->dispatch('openPdfInNewTab', url: route('service.pdf', $serviceId));
            
            session()->flash('message', 'Reporte del servicio generado correctamente. Los campos de impresión y estado han sido actualizados.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al generar el reporte del servicio: ' . $e->getMessage());
        }
    }

    // Método para generar reporte detallado de servicio
    public function generateDetailsServiceReport($serviceId)
    {
        try {
            // Buscar el servicio y actualizar los campos
            $service = Service::find($serviceId);
            if ($service) {
                $service->update([
                    'impressions' => true,
                    'status' => true
                ]);
            }
            
            // Emitir evento inmediatamente para abrir el PDF en nueva pestaña
            $this->dispatch('openPdfInNewTab', url: route('service.details.pdf', $serviceId));
            
            session()->flash('message', 'Reporte detallado del servicio generado correctamente. Los campos de impresión y estado han sido actualizados.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error al generar el reporte detallado del servicio: ' . $e->getMessage());
        }
    }

    private function generateGeneralReport($services)
    {
        $data = [
            'title' => 'Reporte General de Servicios',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'services' => $services,
            'totalServices' => $services->count(),
            'activeServices' => $services->where('status', true)->count(),
            'inactiveServices' => $services->where('status', false)->count(),
        ];

        $pdf = PDF::loadView('reports.services.general', $data);
        $filename = 'reporte_general_servicios_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    private function generateUserReport($services)
    {
        $userServices = $services->groupBy('solicitante_id');
        $data = [
            'title' => 'Reporte de Servicios por Usuario',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'userServices' => $userServices,
            'totalServices' => $services->count(),
        ];

        $pdf = PDF::loadView('reports.services.by_user', $data);
        $filename = 'reporte_servicios_por_usuario_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    private function generateTypeReport($services)
    {
        $typeStats = [
            'correctivo' => $services->where('correctivo', true)->count(),
            'preventivo' => $services->where('preventivo', true)->count(),
            'transparencia' => $services->where('transparencia', true)->count(),
            'a_tec' => $services->where('a_tec', true)->count(),
            'web_ins' => $services->where('web_ins', true)->count(),
            'print' => $services->where('print', true)->count(),
        ];

        $data = [
            'title' => 'Reporte de Servicios por Tipo',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'typeStats' => $typeStats,
            'totalServices' => $services->count(),
        ];

        $pdf = PDF::loadView('reports.services.by_type', $data);
        $filename = 'reporte_servicios_por_tipo_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    private function generateDateReport($services)
    {
        $dateStats = $services->groupBy(function ($service) {
            return $service->F_serv ? $service->F_serv->format('Y-m') : 'Sin fecha';
        });

        $data = [
            'title' => 'Reporte de Servicios por Fecha',
            'dateRange' => $this->reportDateFrom . ' - ' . $this->reportDateTo,
            'dateStats' => $dateStats,
            'totalServices' => $services->count(),
        ];

        $pdf = PDF::loadView('reports.services.by_date', $data);
        $filename = 'reporte_servicios_por_fecha_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        // Guardar temporalmente el PDF
        $path = storage_path('app/public/temp/' . $filename);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $pdf->output());
        
        return $filename;
    }

    // Método de prueba para verificar DomPDF
    public function testPdf()
    {
        $this->dispatch('openPdfInNewTab', url: route('test.pdf'));
    }

    private function NameQrCode($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

    private function cleanString($string)
    {
        if (empty($string)) {
            return '';
        }
        
        // Intentar diferentes codificaciones
        $encodings = ['UTF-8', 'ISO-8859-1', 'Windows-1252', 'ASCII'];
        
        foreach ($encodings as $encoding) {
            if (mb_check_encoding($string, $encoding)) {
                $cleaned = mb_convert_encoding($string, 'UTF-8', $encoding);
                if (mb_check_encoding($cleaned, 'UTF-8')) {
                    return $cleaned;
                }
            }
        }
        
        // Si nada funciona, intentar limpiar caracteres problemáticos
        return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $string);
    }

    /**
     * Truncate text to specified number of words
     */
    private function truncateWords($text, $limit = 20, $ending = '...')
    {
        if (empty($text)) {
            return 'N/A';
        }

        // Clean the text first
        $text = $this->cleanString($text);
        
        // Remove HTML tags for word counting
        $plainText = strip_tags($text);
        
        // Split into words
        $words = preg_split('/\s+/', trim($plainText));
        
        if (count($words) <= $limit) {
            return $text;
        }
        
        // Take first $limit words
        $truncatedWords = array_slice($words, 0, $limit);
        $truncatedText = implode(' ', $truncatedWords);
        
        return $truncatedText . $ending;
    }

    /**
     * Check if text has more than specified number of words
     */
    private function hasMoreWords($text, $limit = 20)
    {
        if (empty($text)) {
            return false;
        }

        $plainText = strip_tags($text);
        $words = preg_split('/\s+/', trim($plainText));
        
        return count($words) > $limit;
    }

    public function render()
    {
        // Detectar dispositivo y optimizar según corresponda
        $device = $this->detectDevice();
        
        if ($device['isMobile']) {
            $this->optimizeForMobile();
            $this->optimizeQueriesForMobile();
            $this->optimizeCache();
            $this->enhanceMobileAccessibility();
            $this->handleSlowConnection();
            $this->optimizeMemoryUsage();
        }

        $services = Service::query()
            ->with(['solicitante', 'efectuo', 'vobo', 'capturo', 'photos'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('id_s', 'like', '%' . $this->search . '%')
                      ->orWhere('obj_sol', 'like', '%' . $this->search . '%')
                      ->orWhere('actividades', 'like', '%' . $this->search . '%')
                      ->orWhere('capturo', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($device['isMobile'] ? 10 : 15);

        $users = User::orderBy('name')->get();

        return view('livewire.service.m_index', [
            'services' => $services,
            'users' => $users,
            'deviceInfo' => $device,
        ]);
    }
} 