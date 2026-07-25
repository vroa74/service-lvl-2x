# Sistema de Gestión de Servicios - Poder Legislativo de Campeche

Sistema web desarrollado en Laravel para la gestión de servicios del Poder Legislativo de Campeche.

## Características principales

- **Gestión de Servicios**: Captura, edición y seguimiento de servicios técnicos
- **Gestión de Inventario**: Control de equipos y recursos
- **Gestión de Usuarios**: Administración de personal y permisos
- **Reportes**: Generación de reportes en PDF
- **Responsive Design**: Optimizado para dispositivos móviles y desktop
- **Fotos de Perfil**: Sistema de gestión de fotos de usuario

## Tecnologías utilizadas

- **Backend**: Laravel 11
- **Frontend**: Livewire, Tailwind CSS
- **Base de datos**: MySQL
- **Autenticación**: Laravel Jetstream con Fortify
- **Reportes**: DomPDF
- **Iconos**: Lucide Icons

## Instalación

1. Clonar el repositorio
2. Instalar dependencias: `composer install`
3. Configurar archivo `.env`
4. Ejecutar migraciones: `php artisan migrate`
5. Crear enlace simbólico: `php artisan storage:link`
6. Instalar fuentes: Ejecutar `install-fonts.bat`

## Estructura del proyecto

- `app/Livewire/`: Componentes Livewire para la interfaz
- `app/Models/`: Modelos de datos
- `resources/views/`: Vistas Blade
- `storage/app/public/`: Archivos subidos por usuarios

## Contribución

Este proyecto es desarrollado para el Poder Legislativo de Campeche.

## Licencia

Proyecto interno del Poder Legislativo de Campeche.