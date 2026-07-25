# 🎨 Instrucciones para Activar Ligaduras en Cursor

## 📋 Pasos a seguir:

### 1. **Instalar Fuentes** (Ya ejecutado)
- Se ejecutó el script `install-fonts.bat` como administrador
- Se descargaron e instalaron las fuentes JetBrains Mono, Fira Code y Cascadia Code

### 2. **Actualizar Configuración de Cursor**

Abre tu archivo de configuración de Cursor:
```
C:\Users\vroa74\AppData\Roaming\Cursor\User\settings.json
```

**Reemplaza** estas líneas:
```json
"editor.fontFamily": "Lilex Nerd Font",
"editor.fontLigatures": true,
```

**Por estas** (copia del archivo `cursor-settings-updated.json`):
```json
"editor.fontFamily": "JetBrains Mono, 'Fira Code', 'Cascadia Code', 'Lilex Nerd Font', Consolas, 'Courier New', monospace",
"editor.fontLigatures": true,
"editor.fontSize": 14,
"editor.fontWeight": "400",
"editor.letterSpacing": 0.5,
"editor.lineHeight": 1.5,
"terminal.integrated.fontFamily": "JetBrains Mono, 'Fira Code', 'Cascadia Code', Consolas, monospace",
"terminal.integrated.fontLigatures": true,
"terminal.integrated.fontSize": 14,
"debug.console.fontFamily": "JetBrains Mono, 'Fira Code', 'Cascadia Code', Consolas, monospace",
"debug.console.fontLigatures": true,
```

### 3. **Reiniciar Cursor**
- Cierra completamente Cursor
- Vuelve a abrirlo

### 4. **Verificar que Funcionen**

Deberías ver estas ligaduras en tu código:
- `=>` → Flecha unida
- `!=` → Símbolo de desigualdad unido
- `<=` y `>=` → Símbolos de comparación unidos
- `==` → Doble igual unido
- `->` → Flecha unida
- `++` → Doble más unido
- `--` → Doble menos unido

### 5. **Si No Funcionan**

**Opción A:** Usar el script alternativo
```bash
install-fonts-simple.bat
```

**Opción B:** Instalar manualmente
1. Descarga JetBrains Mono desde: https://www.jetbrains.com/lp/mono/
2. Instala las fuentes
3. Reinicia Cursor

**Opción C:** Verificar fuentes instaladas
```bash
# En PowerShell
Get-ChildItem "C:\Windows\Fonts" | Where-Object {$_.Name -like "*JetBrains*"}
```

### 6. **Configuraciones Adicionales**

Si quieres más personalización, puedes agregar:
```json
"editor.fontSize": 16,
"editor.fontWeight": "500",
"editor.letterSpacing": 1,
"editor.lineHeight": 1.8
```

## 🎯 Resultado Esperado

Después de seguir estos pasos, deberías ver:
- ✅ Ligaduras funcionando en el editor
- ✅ Ligaduras en el terminal integrado
- ✅ Mejor legibilidad del código
- ✅ Símbolos unidos como `=>`, `!=`, `<=`, etc.

## 🔧 Solución de Problemas

**Problema:** Las ligaduras no aparecen
**Solución:** 
1. Verifica que la fuente esté instalada
2. Reinicia Cursor completamente
3. Prueba con una fuente diferente de la lista

**Problema:** El texto se ve borroso
**Solución:**
```json
"editor.fontWeight": "400",
"editor.letterSpacing": 0.5
```

¡Listo! 🎉 