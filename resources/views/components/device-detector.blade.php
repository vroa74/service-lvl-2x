<div class="p-6" x-data="deviceDetector()">
    <div class="text-gray-300 text-lg">
        <span class="font-semibold">Dispositivo:</span> 
        <span x-text="deviceType" class="text-blue-400"></span>
        <span x-text="scaleInfo" class="ml-2 text-green-400"></span>
    </div>
</div>

<script>
    function deviceDetector() {
        return {
            deviceType: '{{ $deviceType }}',
            scaleInfo: '',
            
            init() {
                this.detectDevice();
                window.addEventListener('resize', () => this.detectDevice());
            },
            
            detectDevice() {
                const userAgent = navigator.userAgent.toLowerCase();
                const isMobileDevice = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);
                const isMobileWidth = window.innerWidth <= 768;
                const isMobile = isMobileDevice || isMobileWidth;
                
                if (isMobile) {
                    this.deviceType = '📱 Móvil';
                    this.scaleInfo = '';
                } else {
                    // Detectar el breakpoint de Tailwind CSS
                    const width = window.innerWidth;
                    let breakpoint = 'base';
                    
                    if (width >= 1536) {
                        breakpoint = '2xl';
                    } else if (width >= 1280) {
                        breakpoint = 'xl';
                    } else if (width >= 1024) {
                        breakpoint = 'lg';
                    } else if (width >= 768) {
                        breakpoint = 'md';
                    } else {
                        breakpoint = 'base';
                    }
                    
                    this.deviceType = `🖥️ Desktop (${breakpoint})`;
                    
                    // Obtener la escala de la pantalla
                    const scale = window.devicePixelRatio || 1;
                    this.scaleInfo = `(Escala: ${scale}x)`;
                }
            }
        }
    }
</script> 