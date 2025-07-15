<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @php
            $cssContent = file_get_contents(public_path('pdf.css'));
            echo $cssContent;
        @endphp
        
        /* Estilos adicionales para la plantilla moderna */
        .modern-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .modern-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .modern-subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .modern-stats {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .modern-stat-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            min-width: 150px;
            margin: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .modern-stat-number {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .modern-stat-label {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .modern-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .modern-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .modern-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .modern-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .modern-table tr:hover {
            background-color: #e2e8f0;
        }
        
        .modern-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-active {
            background-color: #10b981;
            color: white;
        }
        
        .status-inactive {
            background-color: #ef4444;
            color: white;
        }
        
        .modern-footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin-top: 30px;
        }
        
        .modern-type-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            margin: 2px;
        }
        
        /* Estilos para las fotos de servicios */
        .photo-row {
            background-color: #f8fafc !important;
        }
        
        .service-photos {
            padding: 15px;
            background: white;
            border-radius: 10px;
            margin: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .photos-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .photos-grid {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .photo-item {
            flex: 0 0 auto;
            text-align: center;
        }
        
        .service-photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .photo-description {
            font-size: 10px;
            color: #6b7280;
            margin-top: 5px;
            max-width: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .more-photos {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }
        
        .more-photos-text {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="modern-header">
        <div class="modern-title">{{ $title }}</div>
        <div class="modern-subtitle">Rango de fechas: {{ $dateRange }}</div>
        <div class="modern-subtitle">Generado el: {{ now()->format('d/m/Y H:i:s') }}</div>
    </div>

    <div class="modern-stats">
        <div class="modern-stat-card">
            <div class="modern-stat-number">{{ $totalServices }}</div>
            <div class="modern-stat-label">Total de Servicios</div>
        </div>
        <div class="modern-stat-card">
            <div class="modern-stat-number">{{ $activeServices }}</div>
            <div class="modern-stat-label">Servicios Activos</div>
        </div>
        <div class="modern-stat-card">
            <div class="modern-stat-number">{{ $inactiveServices }}</div>
            <div class="modern-stat-label">Servicios Inactivos</div>
        </div>
    </div>

    <table class="modern-table">
        <thead>
            <tr>
                <th>ID Servicio</th>
                <th>Fecha</th>
                <th>Solicitante</th>
                <th>Objetivo</th>
                <th>Tipo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td><strong>{{ $service->id_s ?? 'N/A' }}</strong></td>
                    <td>{{ $service->F_serv ? $service->F_serv->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $service->solicitante ? $service->solicitante->name : 'N/A' }}</td>
                                            <td>{{ Str::limit($service->obj_sol, 50) }}</td>
                        <td>
                            @php
                                $types = [];
                                if($service->correctivo) $types[] = 'Correctivo';
                                if($service->preventivo) $types[] = 'Preventivo';
                                if($service->transparencia) $types[] = 'Transparencia';
                                if($service->a_tec) $types[] = 'A. Técnico';
                                if($service->web_ins) $types[] = 'Web/Ins';
                                if($service->print) $types[] = 'Print';
                            @endphp
                            @foreach($types as $type)
                                <span class="modern-type-badge">{{ $type }}</span>
                            @endforeach
                            @if(empty($types))
                                <span class="modern-type-badge">N/A</span>
                            @endif
                        </td>
                        <td>
                            <span class="modern-status {{ $service->status ? 'status-active' : 'status-inactive' }}">
                                {{ $service->status ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                    </tr>
                    @if($service->photos && $service->photos->count() > 0)
                        <tr class="photo-row">
                            <td colspan="6">
                                <div class="service-photos">
                                    <div class="photos-title">📸 Fotos del Servicio:</div>
                                    <div class="photos-grid">
                                        @foreach($service->photos->take(3) as $photo)
                                            <div class="photo-item">
                                                @php
                                                    $imagePath = storage_path('app/public/' . $photo->photo_path);
                                                    if (file_exists($imagePath)) {
                                                        $imageData = base64_encode(file_get_contents($imagePath));
                                                        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                                                        $imageSrc = "data:image/$imageType;base64,$imageData";
                                                    } else {
                                                        $imageSrc = null;
                                                    }
                                                @endphp
                                                @if($imageSrc)
                                                    <img src="{{ $imageSrc }}" alt="Foto del servicio" class="service-photo">
                                                    @if($photo->description)
                                                        <div class="photo-description">{{ $photo->description }}</div>
                                                    @endif
                                                @endif
                                            </div>
                                        @endforeach
                                        @if($service->photos->count() > 3)
                                            <div class="photo-item more-photos">
                                                <div class="more-photos-text">+{{ $service->photos->count() - 3 }} más</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: #6b7280;">
                        <div style="font-size: 18px; margin-bottom: 10px;">📋</div>
                        No se encontraron servicios en el rango de fechas especificado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="modern-footer">
        <p style="margin: 0; font-size: 14px;">📊 Reporte generado automáticamente por el sistema de gestión de servicios</p>
        <p style="margin: 5px 0 0 0; font-size: 12px; opacity: 0.8;">Plantilla Moderna - Versión 2.0</p>
    </div>
</body>
</html> 