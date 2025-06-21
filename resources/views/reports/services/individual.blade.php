<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ $service->id_s }}</title>
    <style>
        @php
            $cssContent = file_get_contents(public_path('pdf.css'));
            echo $cssContent;
        @endphp
        
        .service-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .service-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .service-info h3 {
            color: #495057;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            color: #495057;
            width: 200px;
            min-width: 200px;
        }
        
        .info-value {
            color: #212529;
            flex: 1;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
        }
        
        .checkbox-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .checkbox-item {
            background: #e9ecef;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            color: #495057;
        }
        
        .checkbox-item.active {
            background: #007bff;
            color: white;
        }
        
        .footer {
            margin-top: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-top: 2px solid #dee2e6;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Encabezado del reporte -->
    <div class="service-header">
        <div style="width: 96%; display: flex; justify-content: center;">
            <table class="tableclean">
                <tr>
                    <td style="width: 20%; text-align: center; vertical-align: middle;"></td>
                    <td style="width: 56%; text-align: center; vertical-align: middle; padding: 10px;">
                        @php
                            $headImagePath = public_path('ple/head.png');
                            $headImageBase64 = base64_encode(file_get_contents($headImagePath));
                        @endphp
                        <img src="data:image/png;base64,{{ $headImageBase64 }}" alt="Logo" style="max-width: 100%; height: auto;">
                        <h1 style="margin: 5px 0; color: white;">REPORTE DE SERVICIO</h1>
                        <h2 style="margin: 5px 0; color: white; font-size: 18px;">{{ $service->id_s ?? 'N/A' }}</h2>
                    </td>
                    <td style="width: 20%; text-align: center; vertical-align: middle;"></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Información básica del servicio -->
    <div class="service-info">
        <h3>📋 Información Básica del Servicio</h3>
        
        <div class="info-row">
            <div class="info-label">ID del Servicio:</div>
            <div class="info-value">{{ $service->id_s ?? 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Fecha de Servicio:</div>
            <div class="info-value">{{ $service->F_serv ? $service->F_serv->format('d/m/Y') : 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Estado:</div>
            <div class="info-value">
                <span class="{{ $service->status ? 'status-active' : 'status-inactive' }}">
                    {{ $service->status ? 'Activo' : 'Inactivo' }}
                </span>
            </div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Fecha de Creación:</div>
            <div class="info-value">{{ $service->created_at ? $service->created_at->format('d/m/Y H:i:s') : 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Última Actualización:</div>
            <div class="info-value">{{ $service->updated_at ? $service->updated_at->format('d/m/Y H:i:s') : 'N/A' }}</div>
        </div>
    </div>

    <!-- Información de involucrados -->
    <div class="service-info">
        <h3>👥 Personal Involucrado</h3>
        
        <div class="info-row">
            <div class="info-label">Solicitante:</div>
            <div class="info-value">
                @if($service->solicitante)
                    <strong>{{ $service->solicitante->name }}</strong><br>
                    <small>
                        <strong>Email:</strong> {{ $service->solicitante->email ?? 'N/A' }}<br>
                        <strong>RFC:</strong> {{ $service->solicitante->rfc ?? 'N/A' }}<br>
                        <strong>Dirección:</strong> {{ $service->solicitante->direction ?? 'N/A' }}<br>
                        <strong>Puesto:</strong> {{ $service->solicitante->position ?? 'N/A' }}<br>
                        <strong>Sexo:</strong> {{ $service->solicitante->sex ?? 'N/A' }}<br>
                        <strong>Nivel:</strong> {{ $service->solicitante->lvl ?? 'N/A' }}<br>
                        <strong>Tipo:</strong> {{ $service->solicitante->tipo ?? 'N/A' }}<br>
                        <strong>Estado:</strong> {{ $service->solicitante->status ? 'Activo' : 'Inactivo' }}
                    </small>
                @else
                    <span style="color: #6c757d;">No asignado</span>
                @endif
            </div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Efectuó el Servicio:</div>
            <div class="info-value">
                @if($service->efectuo)
                    <strong>{{ $service->efectuo->name }}</strong><br>
                    <small>
                        <strong>Email:</strong> {{ $service->efectuo->email ?? 'N/A' }}<br>
                        <strong>RFC:</strong> {{ $service->efectuo->rfc ?? 'N/A' }}<br>
                        <strong>Dirección:</strong> {{ $service->efectuo->direction ?? 'N/A' }}<br>
                        <strong>Puesto:</strong> {{ $service->efectuo->position ?? 'N/A' }}<br>
                        <strong>Sexo:</strong> {{ $service->efectuo->sex ?? 'N/A' }}<br>
                        <strong>Nivel:</strong> {{ $service->efectuo->lvl ?? 'N/A' }}<br>
                        <strong>Tipo:</strong> {{ $service->efectuo->tipo ?? 'N/A' }}<br>
                        <strong>Estado:</strong> {{ $service->efectuo->status ? 'Activo' : 'Inactivo' }}
                    </small>
                @else
                    <span style="color: #6c757d;">No asignado</span>
                @endif
            </div>
        </div>
        
        <div class="info-row">
            <div class="info-label">VºBº (VoBo):</div>
            <div class="info-value">
                @if($service->vobo)
                    <strong>{{ $service->vobo->name }}</strong><br>
                    <small>
                        <strong>Email:</strong> {{ $service->vobo->email ?? 'N/A' }}<br>
                        <strong>RFC:</strong> {{ $service->vobo->rfc ?? 'N/A' }}<br>
                        <strong>Dirección:</strong> {{ $service->vobo->direction ?? 'N/A' }}<br>
                        <strong>Puesto:</strong> {{ $service->vobo->position ?? 'N/A' }}<br>
                        <strong>Sexo:</strong> {{ $service->vobo->sex ?? 'N/A' }}<br>
                        <strong>Nivel:</strong> {{ $service->vobo->lvl ?? 'N/A' }}<br>
                        <strong>Tipo:</strong> {{ $service->vobo->tipo ?? 'N/A' }}<br>
                        <strong>Estado:</strong> {{ $service->vobo->status ? 'Activo' : 'Inactivo' }}
                    </small>
                @else
                    <span style="color: #6c757d;">No asignado</span>
                @endif
            </div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Capturó la Información:</div>
            <div class="info-value">
                @if($service->capturo && is_object($service->capturo))
                    <strong>{{ $service->capturo->name }}</strong><br>
                    <small>
                        <strong>Email:</strong> {{ $service->capturo->email ?? 'N/A' }}<br>
                        <strong>RFC:</strong> {{ $service->capturo->rfc ?? 'N/A' }}<br>
                        <strong>Dirección:</strong> {{ $service->capturo->direction ?? 'N/A' }}<br>
                        <strong>Puesto:</strong> {{ $service->capturo->position ?? 'N/A' }}<br>
                        <strong>Sexo:</strong> {{ $service->capturo->sex ?? 'N/A' }}<br>
                        <strong>Nivel:</strong> {{ $service->capturo->lvl ?? 'N/A' }}<br>
                        <strong>Tipo:</strong> {{ $service->capturo->tipo ?? 'N/A' }}<br>
                        <strong>Estado:</strong> {{ $service->capturo->status ? 'Activo' : 'Inactivo' }}
                    </small>
                @elseif($service->capturo && is_numeric($service->capturo))
                    @php
                        $capturoUser = \App\Models\User::find($service->capturo);
                    @endphp
                    @if($capturoUser)
                        <strong>{{ $capturoUser->name }}</strong><br>
                        <small>
                            <strong>Email:</strong> {{ $capturoUser->email ?? 'N/A' }}<br>
                            <strong>RFC:</strong> {{ $capturoUser->rfc ?? 'N/A' }}<br>
                            <strong>Dirección:</strong> {{ $capturoUser->direction ?? 'N/A' }}<br>
                            <strong>Puesto:</strong> {{ $capturoUser->position ?? 'N/A' }}<br>
                            <strong>Sexo:</strong> {{ $capturoUser->sex ?? 'N/A' }}<br>
                            <strong>Nivel:</strong> {{ $capturoUser->lvl ?? 'N/A' }}<br>
                            <strong>Tipo:</strong> {{ $capturoUser->tipo ?? 'N/A' }}<br>
                            <strong>Estado:</strong> {{ $capturoUser->status ? 'Activo' : 'Inactivo' }}
                        </small>
                    @else
                        <span style="color: #6c757d;">Usuario ID: {{ $service->capturo }} (no encontrado)</span>
                    @endif
                @else
                    <span style="color: #6c757d;">No asignado</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Detalles del servicio -->
    <div class="service-info">
        <h3>📝 Detalles del Servicio</h3>
        
        <div class="info-row">
            <div class="info-label">Objetivo de la Solicitud:</div>
            <div class="info-value">{{ $service->obj_sol ?? 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Actividades Realizadas:</div>
            <div class="info-value">{{ $service->actividades ?? 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Mantenimiento:</div>
            <div class="info-value">{{ $service->mantenimiento ?? 'N/A' }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Observaciones:</div>
            <div class="info-value">{{ $service->observaciones ?? 'N/A' }}</div>
        </div>
    </div>

    <!-- Tipos de servicio -->
    <div class="service-info">
        <h3>🔧 Tipos de Servicio</h3>
        <div class="checkbox-list">
            <div class="checkbox-item {{ $service->correctivo ? 'active' : '' }}">
                {{ $service->correctivo ? '✓' : '✗' }} Correctivo
            </div>
            <div class="checkbox-item {{ $service->preventivo ? 'active' : '' }}">
                {{ $service->preventivo ? '✓' : '✗' }} Preventivo
            </div>
            <div class="checkbox-item {{ $service->transparencia ? 'active' : '' }}">
                {{ $service->transparencia ? '✓' : '✗' }} Transparencia
            </div>
            <div class="checkbox-item {{ $service->a_tec ? 'active' : '' }}">
                {{ $service->a_tec ? '✓' : '✗' }} A. Técnico
            </div>
            <div class="checkbox-item {{ $service->web_ins ? 'active' : '' }}">
                {{ $service->web_ins ? '✓' : '✗' }} Web/Ins
            </div>
            <div class="checkbox-item {{ $service->print ? 'active' : '' }}">
                {{ $service->print ? '✓' : '✗' }} Print
            </div>
        </div>
    </div>

    <!-- Vías de solicitud -->
    <div class="service-info">
        <h3>📞 Vías de Solicitud</h3>
        <div class="checkbox-list">
            <div class="checkbox-item {{ $service->email ? 'active' : '' }}">
                {{ $service->email ? '✓' : '✗' }} Email
            </div>
            <div class="checkbox-item {{ $service->tel ? 'active' : '' }}">
                {{ $service->tel ? '✓' : '✗' }} Teléfono
            </div>
            <div class="checkbox-item {{ $service->sol_ser ? 'active' : '' }}">
                {{ $service->sol_ser ? '✓' : '✗' }} Solicitud de Servicio
            </div>
            <div class="checkbox-item {{ $service->oficio ? 'active' : '' }}">
                {{ $service->oficio ? '✓' : '✗' }} Oficio
            </div>
            <div class="checkbox-item {{ $service->calendario ? 'active' : '' }}">
                {{ $service->calendario ? '✓' : '✗' }} Calendario
            </div>
        </div>
    </div>

    <!-- Configuraciones adicionales -->
    <div class="service-info">
        <h3>⚙️ Configuraciones Adicionales</h3>
        <div class="checkbox-list">
            <div class="checkbox-item {{ $service->impressions ? 'active' : '' }}">
                {{ $service->impressions ? '✓' : '✗' }} Impresiones
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p><strong>Reporte generado el:</strong> {{ $generatedAt }}</p>
        <p>Este reporte contiene toda la información del servicio registrado en el sistema</p>
        <p style="font-size: 12px; margin-top: 10px;">
            Sistema de Gestión de Servicios - Reporte Individual
        </p>
    </div>
</body>
</html> 