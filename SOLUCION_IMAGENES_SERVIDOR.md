# 🔧 SOLUCIÓN: Problema de Subida de Imágenes en el Servidor

## 📋 Resumen del Problema

Las imágenes no se están subiendo correctamente en el servidor `http://service-lvl-2x.ask.me/`

## ✅ Diagnóstico Realizado

### Sistema de Subida de Imágenes
- **Tabla**: `service_photos`
- **Modelo**: `App\Models\ServicePhoto`
- **Ubicación física**: `storage/app/public/service_photos/`
- **Método de almacenamiento**: `Storage::disk('public')->store('service_photos')`

### Archivos Involucrados
1. `app/Livewire/Service/m_Edit.php` - Edición de servicios
2. `app/Livewire/Service/Create.php` - Creación de servicios
3. `resources/views/reports/services/detalles.blade.php` - Vista PDF (✅ Ya corregida)

## 🔍 Verificación en el Servidor

### Paso 1: Subir Script de Diagnóstico

Sube el archivo `diagnostico_imagenes.php` a la raíz del proyecto en el servidor y ejecuta:

```bash
php diagnostico_imagenes.php
```

### Paso 2: Revisar el Resultado

Compara la salida con el resultado local. Busca especialmente:

**❌ Problemas Comunes:**
- `public/storage` no existe → Falta crear el enlace simbólico
- Permisos insuficientes → Directorios sin permisos de escritura
- `upload_max_filesize` muy bajo → PHP no puede recibir archivos grandes
- `post_max_size` muy bajo → Limita el tamaño de las peticiones

## 🛠️ Soluciones por Problema

### Problema 1: Enlace Simbólico Faltante

**Síntoma**: `public/storage` no existe o no es un link simbólico

**Solución**:
```bash
cd /ruta/del/proyecto
php artisan storage:link
```

**Verificación**:
```bash
ls -la public/storage
# Debe mostrar: public/storage -> ../storage/app/public
```

---

### Problema 2: Permisos Incorrectos

**Síntoma**: Los directorios no son escribibles

**Solución Linux/Unix**:
```bash
# Dar permisos de escritura a storage y cache
chmod -R 775 storage bootstrap/cache

# Asegurar que el servidor web sea el dueño
chown -R www-data:www-data storage bootstrap/cache

# O si usas Apache con un usuario diferente:
chown -R apache:apache storage bootstrap/cache

# O si usas nginx:
chown -R nginx:nginx storage bootstrap/cache
```

**Solución cPanel/Shared Hosting**:
```bash
# Desde el File Manager de cPanel:
# 1. Navega a storage/
# 2. Click derecho -> Permissions
# 3. Establece: 755 para directorios
# 4. Establece: 644 para archivos
# 5. Marca "Recurse into subdirectories"
```

---

### Problema 3: Límites de PHP Muy Bajos

**Síntoma**: Archivos grandes no se suben

**Solución**: Edita el archivo `php.ini` (o `.user.ini` en shared hosting)

```ini
upload_max_filesize = 10M
post_max_size = 10M
max_file_uploads = 20
memory_limit = 256M
```

**En cPanel**:
1. Ve a "Select PHP Version" o "MultiPHP INI Editor"
2. Ajusta los valores:
   - `upload_max_filesize`: 10M
   - `post_max_size`: 10M
   - `memory_limit`: 256M

**Reiniciar servicios**:
```bash
# Apache
sudo systemctl restart apache2

# Nginx + PHP-FPM
sudo systemctl restart php8.2-fpm  # Ajusta la versión
sudo systemctl restart nginx
```

---

### Problema 4: Directorios No Existen

**Síntoma**: Error "directory does not exist"

**Solución**:
```bash
# Crear directorios si no existen
mkdir -p storage/app/public/service_photos
mkdir -p storage/app/public/inventory_photos
mkdir -p storage/app/public/profile-photos

# Dar permisos
chmod -R 775 storage/app/public
```

---

### Problema 5: SELinux Bloqueando (Solo CentOS/RHEL)

**Síntoma**: Permisos correctos pero aún no funciona

**Verificación**:
```bash
getenforce
# Si responde "Enforcing", SELinux está activo
```

**Solución**:
```bash
# Permitir que Apache escriba en storage
chcon -R -t httpd_sys_rw_content_t storage/
setsebool -P httpd_can_network_connect 1
```

---

## 🧪 Pruebas de Funcionamiento

### Prueba 1: Crear Servicio con Foto
1. Ir a: `http://service-lvl-2x.ask.me/service/create`
2. Llenar el formulario
3. Agregar una foto
4. Guardar
5. Verificar que la foto aparezca en la base de datos

### Prueba 2: Ver PDF con Fotos
1. Ir a: `http://service-lvl-2x.ask.me/service-details-pdf/43`
2. Verificar que las fotos se muestren correctamente

### Prueba 3: Verificar Archivo Físico
```bash
ls -lh storage/app/public/service_photos/
# Debe mostrar los archivos de imagen
```

---

## 📝 Logs de Error

### Ver errores de Laravel:
```bash
tail -f storage/logs/laravel.log
```

### Ver errores de PHP:
```bash
# Apache
tail -f /var/log/apache2/error.log

# Nginx
tail -f /var/log/nginx/error.log
```

### Buscar errores específicos de subida:
```bash
grep -i "upload\|storage\|permission" storage/logs/laravel.log | tail -20
```

---

## 🔄 Cambios Realizados en el Código

### ✅ Archivo Corregido: `resources/views/reports/services/detalles.blade.php`

**Problema**: Intentaba usar `asset('storage/...')` que requiere enlace simbólico

**Solución**: Ahora usa `storage_path('app/public/...')` y convierte a base64

```php
// ANTES (❌)
$photoUrl = asset('storage/' . $photo->photo_path);
<img src="{{ $photoUrl }}" ...>

// AHORA (✅)
$photoPath = storage_path('app/public/' . $photo->photo_path);
if (file_exists($photoPath)) {
    $photoBase64 = base64_encode(file_get_contents($photoPath));
    $imageInfo = getimagesize($photoPath);
    $mimeType = $imageInfo['mime'] ?? 'image/jpeg';
    <img src="data:{{ $mimeType }};base64,{{ $photoBase64 }}" ...>
}
```

**Beneficio**: Las imágenes funcionan en PDFs sin depender del enlace simbólico

---

## 📞 Checklist Final

Ejecuta esto en el servidor:

```bash
# 1. Verificar enlace simbólico
ls -la public/storage

# 2. Verificar permisos
ls -ld storage/app/public/service_photos

# 3. Verificar PHP
php -i | grep -E "upload_max_filesize|post_max_size|memory_limit"

# 4. Probar escritura
touch storage/app/public/service_photos/test.txt && rm storage/app/public/service_photos/test.txt && echo "✅ Escritura OK" || echo "❌ Error de escritura"

# 5. Ver últimos errores
tail -20 storage/logs/laravel.log
```

---

## 🎯 Comando Rápido Todo-en-Uno

Ejecuta esto en el servidor (Linux):

```bash
#!/bin/bash
echo "🔧 Configurando subida de imágenes..."

# Crear enlace simbólico
php artisan storage:link

# Crear directorios
mkdir -p storage/app/public/{service_photos,inventory_photos,profile-photos}

# Permisos
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo "✅ Configuración completada"
echo "📝 Ejecuta: php diagnostico_imagenes.php para verificar"
```

Guarda esto como `setup_storage.sh`, dale permisos y ejecútalo:

```bash
chmod +x setup_storage.sh
./setup_storage.sh
```

---

## 🆘 Soporte

Si después de estos pasos el problema persiste:

1. Ejecuta `php diagnostico_imagenes.php` y guarda la salida
2. Revisa `storage/logs/laravel.log` 
3. Verifica los logs del servidor web
4. Comparte los resultados para análisis más detallado
