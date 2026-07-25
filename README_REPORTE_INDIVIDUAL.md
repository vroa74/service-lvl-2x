# Reporte Individual de Servicios

## Descripción

Esta funcionalidad permite generar reportes PDF individuales para cada servicio registrado en el sistema. El reporte incluye todos los datos del registro y las relaciones con las tablas de usuarios.

## Características

### 📋 Información Incluida en el Reporte

1. **Información Básica del Servicio**
   - ID del Servicio
   - Fecha de Servicio
   - Estado (Activo/Inactivo)
   - Fecha de Creación
   - Última Actualización

2. **Personal Involucrado**
   - Solicitante (nombre y email)
   - Usuario que efectuó el servicio (nombre y email)
   - VºBº (VoBo) - nombre y email
   - Usuario que capturó la información (nombre y email)

3. **Detalles del Servicio**
   - Objetivo de la Solicitud
   - Actividades Realizadas
   - Mantenimiento
   - Observaciones

4. **Tipos de Servicio**
   - Correctivo
   - Preventivo
   - Transparencia
   - A. Técnico
   - Web/Ins
   - Print

5. **Vías de Solicitud**
   - Email
   - Teléfono
   - Solicitud de Servicio
   - Oficio
   - Calendario

6. **Configuraciones Adicionales**
   - Impresiones

## Uso

### En la Interfaz Web

1. Navega a la lista de servicios (`/servicios-livewire`)
2. En la tabla de servicios, busca el botón con icono de impresora naranja
3. Haz clic en el botón para generar el reporte individual
4. El PDF se abrirá automáticamente en una nueva pestaña del navegador

### Botón de Reporte Individual

```html
<button 
    wire:click="generateIndividualServiceReport({{ $service->id }})"
    class="text-orange-400 hover:text-red-500 transition-colors"
    title="Generar el Reporte del Servicio">
    <i class="ri-printer-line"></i>
</button>
```

## Implementación Técnica

### Componente Livewire

El método principal se encuentra en `app/Livewire/Service/Index.php`:

```php
public function generateIndividualServiceReport($serviceId)
{
    try {
        $service = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->findOrFail($serviceId);
        
        $filename = $this->generateIndividualReport($service);
        
        // Emitir evento para abrir el PDF en nueva pestaña
        $this->dispatch('openPdfInNewTab', url: '/storage/temp/' . $filename);
        
        session()->flash('message', 'Reporte del servicio generado correctamente.');
        
    } catch (\Exception $e) {
        session()->flash('error', 'Error al generar el reporte del servicio: ' . $e->getMessage());
    }
}
```

### Vista del Reporte

La vista del reporte se encuentra en `resources/views/reports/services/individual.blade.php` y incluye:

- Diseño responsivo y profesional
- Estilos CSS personalizados
- Información organizada en secciones
- Indicadores visuales para campos booleanos
- Encabezado con logo institucional

### Almacenamiento

Los archivos PDF se almacenan temporalmente en:
- `storage/app/public/temp/`
- Se acceden a través de `/storage/temp/`

### Limpieza Automática

Para mantener el sistema limpio, se incluye un comando para limpiar archivos temporales:

```bash
# Limpiar archivos más antiguos de 1 día
php artisan reports:clean

# Limpiar archivos más antiguos de 7 días
php artisan reports:clean --days=7
```

## Pruebas

### Ruta de Prueba

Se incluye una ruta de prueba para verificar la funcionalidad:

```
GET /test-individual-pdf/{id}
```

Esta ruta permite probar el reporte individual sin necesidad de usar la interfaz Livewire.

### Ejemplo de Uso

```bash
# Probar con el servicio ID 1
curl http://localhost:8000/test-individual-pdf/1
```

## Dependencias

- **DomPDF**: Para la generación de PDFs
- **Livewire**: Para la interactividad en tiempo real
- **Laravel**: Framework base

## Configuración Requerida

1. **Enlace simbólico de storage**:
   ```bash
   php artisan storage:link
   ```

2. **Directorio temporal**:
   ```bash
   mkdir -p storage/app/public/temp
   ```

3. **Permisos de escritura**:
   ```bash
   chmod -R 755 storage/app/public/temp
   ```

## Estructura de Archivos

```
app/
├── Livewire/Service/Index.php          # Lógica del componente
├── Console/Commands/CleanTempReports.php # Comando de limpieza
└── Models/Service.php                  # Modelo con relaciones

resources/views/
├── livewire/service/index.blade.php    # Vista principal
└── reports/services/
    └── individual.blade.php            # Plantilla del reporte

routes/
└── web.php                            # Rutas de prueba

public/
├── pdf.css                            # Estilos CSS para PDF
└── ple/
    └── head.png                       # Logo del encabezado
```

## Eventos JavaScript

El sistema utiliza eventos Livewire para la comunicación:

```javascript
// Escuchar evento de apertura de PDF
Livewire.on('openPdfInNewTab', (event) => {
    window.open(event.url, '_blank');
});
```

## Manejo de Errores

- Validación de existencia del servicio
- Manejo de excepciones en la generación de PDF
- Mensajes de error informativos para el usuario
- Logs de errores para debugging

## Personalización

### Modificar el Diseño

Para personalizar el diseño del reporte, edita:
- `resources/views/reports/services/individual.blade.php`
- `public/pdf.css`

### Agregar Campos

Para agregar nuevos campos al reporte:

1. Actualizar el modelo `Service.php` si es necesario
2. Modificar la vista `individual.blade.php`
3. Actualizar el método `generateIndividualServiceReport()` si se requieren nuevas relaciones

## Mantenimiento

### Limpieza Programada

Se recomienda configurar un cron job para limpiar archivos temporales:

```bash
# Agregar al crontab
0 2 * * * cd /path/to/project && php artisan reports:clean --days=1
```

### Monitoreo

- Verificar el espacio en disco regularmente
- Revisar logs de errores
- Monitorear el rendimiento de generación de PDFs

## Troubleshooting

### Problemas Comunes

1. **PDF no se genera**:
   - Verificar permisos de escritura en `storage/app/public/temp/`
   - Comprobar que DomPDF esté instalado correctamente
   - Revisar logs de Laravel

2. **Imágenes no aparecen**:
   - Verificar que el enlace simbólico de storage esté configurado
   - Comprobar que las imágenes existan en `public/ple/`

3. **Caracteres especiales**:
   - Verificar la codificación UTF-8 en las vistas
   - Comprobar la configuración de fuentes en DomPDF

### Logs de Debug

```php
// Agregar logging para debugging
Log::info('Generando reporte individual', ['service_id' => $serviceId]);
```

## Contribución

Para contribuir a esta funcionalidad:

1. Crear una rama feature
2. Implementar cambios
3. Probar exhaustivamente
4. Crear pull request con documentación actualizada

## Licencia

Esta funcionalidad es parte del sistema de gestión de servicios y sigue la misma licencia del proyecto principal. 