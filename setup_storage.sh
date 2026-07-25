#!/bin/bash

# =============================================================================
# Script de Configuración de Storage para Laravel
# Proyecto: Sistema de Gestión de Servicios
# =============================================================================

echo "═══════════════════════════════════════════════════════════"
echo "  🔧 CONFIGURACIÓN DE STORAGE PARA SUBIDA DE IMÁGENES"
echo "═══════════════════════════════════════════════════════════"
echo ""

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Función para mostrar mensajes
print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_info() {
    echo -e "${YELLOW}ℹ️  $1${NC}"
}

# Verificar que estamos en el directorio correcto
if [ ! -f "artisan" ]; then
    print_error "Este script debe ejecutarse desde la raíz del proyecto Laravel"
    exit 1
fi

print_success "Directorio de proyecto verificado"
echo ""

# 1. Crear enlace simbólico
echo "1️⃣  Creando enlace simbólico..."
if [ -L "public/storage" ]; then
    print_info "El enlace simbólico ya existe"
    rm public/storage
    print_info "Enlace anterior eliminado, creando nuevo..."
fi

php artisan storage:link

if [ -L "public/storage" ]; then
    print_success "Enlace simbólico creado: public/storage -> storage/app/public"
else
    print_error "No se pudo crear el enlace simbólico"
fi
echo ""

# 2. Crear directorios necesarios
echo "2️⃣  Creando directorios de almacenamiento..."
directories=(
    "storage/app/public"
    "storage/app/public/service_photos"
    "storage/app/public/inventory_photos"
    "storage/app/public/profile-photos"
    "storage/framework/cache"
    "storage/framework/sessions"
    "storage/framework/views"
    "storage/logs"
    "bootstrap/cache"
)

for dir in "${directories[@]}"; do
    if [ ! -d "$dir" ]; then
        mkdir -p "$dir"
        print_success "Creado: $dir"
    else
        print_info "Ya existe: $dir"
    fi
done
echo ""

# 3. Configurar permisos
echo "3️⃣  Configurando permisos..."

# Detectar usuario del servidor web
WEB_USER="www-data"
if id "apache" >/dev/null 2>&1; then
    WEB_USER="apache"
elif id "nginx" >/dev/null 2>&1; then
    WEB_USER="nginx"
fi

print_info "Usuario del servidor web detectado: $WEB_USER"

# Cambiar permisos
chmod -R 775 storage bootstrap/cache
print_success "Permisos establecidos: 775 para storage y bootstrap/cache"

# Intentar cambiar el propietario (requiere sudo)
if [ "$EUID" -eq 0 ]; then
    chown -R $WEB_USER:$WEB_USER storage bootstrap/cache
    print_success "Propietario cambiado a: $WEB_USER"
else
    print_info "Para cambiar el propietario, ejecuta con sudo:"
    echo "    sudo chown -R $WEB_USER:$WEB_USER storage bootstrap/cache"
fi
echo ""

# 4. Crear archivo .gitignore en storage si no existe
echo "4️⃣  Configurando .gitignore..."
if [ ! -f "storage/app/public/.gitignore" ]; then
    echo "*" > storage/app/public/.gitignore
    echo "!.gitignore" >> storage/app/public/.gitignore
    print_success "Creado: storage/app/public/.gitignore"
else
    print_info "Ya existe: storage/app/public/.gitignore"
fi
echo ""

# 5. Limpiar caché de Laravel
echo "5️⃣  Limpiando caché de Laravel..."
php artisan cache:clear >/dev/null 2>&1
print_success "Cache limpiado"

php artisan config:clear >/dev/null 2>&1
print_success "Configuración limpiada"

php artisan view:clear >/dev/null 2>&1
print_success "Vistas limpiadas"

php artisan route:clear >/dev/null 2>&1
print_success "Rutas limpiadas"
echo ""

# 6. Verificación final
echo "6️⃣  Verificación final..."
echo ""

# Verificar enlace simbólico
if [ -L "public/storage" ]; then
    target=$(readlink public/storage)
    print_success "Enlace simbólico: public/storage -> $target"
else
    print_error "Enlace simbólico NO encontrado"
fi

# Verificar permisos
if [ -w "storage/app/public/service_photos" ]; then
    print_success "Directorio service_photos es escribible"
else
    print_error "Directorio service_photos NO es escribible"
fi

# Probar escritura
TEST_FILE="storage/app/public/service_photos/.test_$(date +%s).txt"
if echo "test" > "$TEST_FILE" 2>/dev/null; then
    rm "$TEST_FILE"
    print_success "Prueba de escritura exitosa"
else
    print_error "No se puede escribir en storage/app/public/service_photos"
fi
echo ""

# Mostrar información de PHP
echo "7️⃣  Información de PHP:"
php -r "echo '   - PHP Version: ' . PHP_VERSION . PHP_EOL;"
php -r "echo '   - upload_max_filesize: ' . ini_get('upload_max_filesize') . PHP_EOL;"
php -r "echo '   - post_max_size: ' . ini_get('post_max_size') . PHP_EOL;"
php -r "echo '   - memory_limit: ' . ini_get('memory_limit') . PHP_EOL;"
echo ""

# Resumen final
echo "═══════════════════════════════════════════════════════════"
echo "  ✅ CONFIGURACIÓN COMPLETADA"
echo "═══════════════════════════════════════════════════════════"
echo ""
print_info "Próximos pasos:"
echo "  1. Ejecuta: php diagnostico_imagenes.php"
echo "  2. Prueba subir una imagen desde la aplicación"
echo "  3. Revisa los logs: tail -f storage/logs/laravel.log"
echo ""

# Detectar si hay problemas de SELinux (solo en CentOS/RHEL)
if command -v getenforce >/dev/null 2>&1; then
    if [ "$(getenforce)" = "Enforcing" ]; then
        echo ""
        print_info "⚠️  SELinux está activo. Si tienes problemas, ejecuta:"
        echo "    sudo chcon -R -t httpd_sys_rw_content_t storage/"
        echo "    sudo setsebool -P httpd_can_network_connect 1"
    fi
fi

echo ""
print_success "Script completado con éxito"
echo ""
