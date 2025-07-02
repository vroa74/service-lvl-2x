<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            color: #6b7280;
        }
        
        .info-section {
            margin-bottom: 25px;
        }
        
        .info-section h2 {
            font-size: 16px;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 3px;
            font-size: 11px;
        }
        
        .info-value {
            color: #111827;
            font-size: 12px;
            padding: 5px 0;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .table th {
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
            font-weight: 600;
            font-size: 11px;
            color: #374151;
        }
        
        .table td {
            border: 1px solid #d1d5db;
            padding: 8px;
            font-size: 11px;
            color: #111827;
        }
        
        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 500;
        }
        
        .status-active {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-inactive {
            background-color: #fef2f2;
            color: #dc2626;
        }
        
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CARTA RESPONSIVA</h1>
        <p>{{ $responsiva->codigo }}</p>
        <p>Generado el: {{ $generatedAt }}</p>
    </div>

    <!-- Información General -->
    <div class="info-section">
        <h2>Información General</h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Código:</span>
                <span class="info-value">{{ $responsiva->codigo }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Fecha:</span>
                <span class="info-value">{{ $responsiva->fecha ? $responsiva->fecha->format('d/m/Y') : 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Auditoría:</span>
                <span class="info-value">
                    @if($responsiva->auditoria)
                        <span class="status-badge status-active">Sí</span>
                    @else
                        <span class="status-badge status-inactive">No</span>
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Total Artículos:</span>
                <span class="info-value">{{ $responsiva->inventoryResponsivas->count() }}</span>
            </div>
        </div>
        
        @if($responsiva->observacion)
        <div class="info-item" style="margin-top: 15px;">
            <span class="info-label">Observaciones:</span>
            <span class="info-value">{{ $responsiva->observacion }}</span>
        </div>
        @endif
    </div>

    <!-- Información de Usuarios -->
    <div class="info-section">
        <h2>Información de Usuarios</h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Usuario que Genera:</span>
                <span class="info-value">
                    @if($responsiva->user)
                        {{ $responsiva->user->name }}<br>
                        <small style="color: #6b7280;">{{ $responsiva->user->email }}</small>
                    @else
                        Sin usuario asignado
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Responsable:</span>
                <span class="info-value">
                    @if($responsiva->responsable)
                        {{ $responsiva->responsable->name }}<br>
                        <small style="color: #6b7280;">{{ $responsiva->responsable->email }}</small>
                    @else
                        Sin responsable asignado
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Informática:</span>
                <span class="info-value">
                    @if($responsiva->informatica)
                        {{ $responsiva->informatica->name }}<br>
                        <small style="color: #6b7280;">{{ $responsiva->informatica->email }}</small>
                    @else
                        Sin informática asignado
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Lista de Artículos -->
    @if($responsiva->inventoryResponsivas->count() > 0)
    <div class="info-section">
        <h2>Artículos Asignados</h2>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>NI</th>
                        <th>SN</th>
                        <th>Marca/Modelo</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($responsiva->inventoryResponsivas as $inventoryResponsiva)
                        @if($inventoryResponsiva->inventory)
                        <tr>
                            <td>{{ $inventoryResponsiva->inventory->articulo ?? 'N/A' }}</td>
                            <td>{{ $inventoryResponsiva->inventory->ni ?? 'N/A' }}</td>
                            <td>{{ $inventoryResponsiva->inventory->ns ?? 'N/A' }}</td>
                            <td>
                                {{ $inventoryResponsiva->inventory->marca ?? 'N/A' }}
                                @if($inventoryResponsiva->inventory->modelo)
                                    / {{ $inventoryResponsiva->inventory->modelo }}
                                @endif
                            </td>
                            <td>{{ $inventoryResponsiva->description ?? 'Sin descripción' }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="info-section">
        <h2>Artículos Asignados</h2>
        <p style="color: #6b7280; font-style: italic;">No hay artículos asignados a esta carta responsiva.</p>
    </div>
    @endif

    <!-- Información Adicional -->
    <div class="info-section">
        <h2>Información Adicional</h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Fecha de Creación:</span>
                <span class="info-value">{{ $responsiva->created_at->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Última Actualización:</span>
                <span class="info-value">{{ $responsiva->updated_at->format('d/m/Y H:i:s') }}</span>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Este documento fue generado automáticamente por el sistema de gestión de inventarios.</p>
        <p>Para cualquier consulta, contacte al administrador del sistema.</p>
    </div>
</body>
</html> 