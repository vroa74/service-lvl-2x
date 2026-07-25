# AI_INSTRUCTIONS — Instrucciones para la IA en este proyecto

Propósito
- Proveer contexto y reglas mínimas para que una IA (asistente/Co-pilot) contribuya correctamente al desarrollo.

Qué contiene este repositorio (rápido)
- Configuración de entorno: archivos `.env`, `.env.example`.
- Configuración Laravel: carpeta `config/`.
- Código principal: carpeta `app/` y `routes/`.
- Recursos públicos: `public/`.
- Migraciones y seeds: `database/migrations/`, `database/seeders/`.
- Tests: `tests/` (usar `phpunit`).

Reglas y convenciones importantes
- Sigue las reglas de integridad en `.github/copilot-instructions.md`.
- No pongas lógica de negocio en controladores; usa Actions/Services.
- Si cambias DB, actualiza FormRequests y Migraciones.
- Usa type hints y validación adecuada.
- Mantén DRY: busca helpers/traits antes de añadir funciones.

Qué evitar modificar sin permiso
- No tocar `vendor/`, ni archivos en `storage/` salvo que se indique.
- No subir credenciales ni cambiar `.env` sin instrucciones de despliegue.

Cómo pedir cambios al asistente (formatos recomendados)
- Describir: objetivo, archivos relevantes, branch destino, y si hay migraciones/tests.
- Ejemplo: "Mejorar validación en `app/Http/Requests/ServiceRequest.php` y añadir test unitario. Branch: feature/validacion-service." 

Comandos útiles para reproducir localmente
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
./vendor/bin/phpunit
```

Pruebas y verificación
- Ejecutar `phpunit` para tests.
- Si añades migraciones, indicar cómo revertir (`php artisan migrate:rollback`).

Contacto y contexto adicional
- Revisa `README.md` y `.github/copilot-instructions.md` antes de cambios grandes.
- Si falta contexto, pide: steps to reproduce, env vars relevantes, y un ejemplo de entrada/out.

Notas finales
- Mantén las modificaciones pequeñas y con tests cuando sea posible.
- Documenta cambios en el commit message y en el PR.
