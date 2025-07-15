<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1200px;
        }
        
        .modern-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .modern-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        
        .modern-subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .modern-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .modern-stat-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            min-width: 180px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }
        
        .modern-stat-card:hover {
            transform: translateY(-5px);
        }
        
        .modern-stat-number {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .modern-stat-label {
            font-size: 14px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .user-section {
            margin-bottom: 40px;
            page-break-inside: avoid;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .user-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            position: relative;
        }
        
        .user-header::before {
            content: '👤';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
        }
        
        .user-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }
        
        .user-header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        
        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .modern-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
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
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        
        .status-active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .status-inactive {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
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
        
        .modern-footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 15px;
            margin-top: 30px;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 15px;
            margin: 30px 0;
        }
        
        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .empty-state-text {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 10px;
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
    <div class="container">
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
                <div class="modern-stat-number">{{ count($userServices) }}</div>
                <div class="modern-stat-label">Usuarios con Servicios</div>
            </div>
        </div>

        @forelse($userServices as $userId => $services)
            @php
                $user = $services->first()->solicitante;
                $userName = $user ? $user->name : 'Usuario #' . $userId;
            @endphp
            <div class="user-section">
                <div class="user-header">
                    <h3>{{ $userName }}</h3>
                    <p>Total de servicios: {{ $services->count() }}</p>
                </div>

                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>ID Servicio</th>
                            <th>Fecha</th>
                            <th>Objetivo</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td><strong>{{ $service->id_s ?? 'N/A' }}</strong></td>
                                <td>{{ $service->F_serv ? $service->F_serv->format('d/m/Y') : 'N/A' }}</td>
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
                                    <td colspan="5">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                <div class="empty-state-text">No se encontraron servicios por usuario en el rango de fechas especificado.</div>
            </div>
        @endforelse

        <div class="modern-footer">
            <p style="margin: 0; font-size: 14px;">📊 Reporte generado automáticamente por el sistema de gestión de servicios</p>
            <p style="margin: 5px 0 0 0; font-size: 12px; opacity: 0.8;">Plantilla Moderna - Versión 2.0</p>
        </div>
    </div>
</body>
</html> 