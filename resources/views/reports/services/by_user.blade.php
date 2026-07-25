<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #2c3e50;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #7f8c8d;
        }
        .stats {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        .stat-item {
            text-align: center;
            margin: 0 20px;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .stat-label {
            color: #7f8c8d;
            font-size: 14px;
        }
        .user-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .user-header {
            background-color: #2c3e50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .user-header h3 {
            margin: 0;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .status-active {
            color: #27ae60;
            font-weight: bold;
        }
        .status-inactive {
            color: #e74c3c;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #7f8c8d;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Rango de fechas: {{ $dateRange }}</p>
        <p>Generado el: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-number">{{ $totalServices }}</div>
            <div class="stat-label">Total de Servicios</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ count($userServices) }}</div>
            <div class="stat-label">Usuarios con Servicios</div>
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

            <table>
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
                            <td>{{ $service->id_s ?? 'N/A' }}</td>
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
                                {{ implode(', ', $types) ?: 'N/A' }}
                            </td>
                            <td class="{{ $service->estatus_servicio ? 'status-active' : 'status-inactive' }}">
                                {{ $service->estatus_servicio ? 'Activo' : 'Inactivo' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <div style="text-align: center; padding: 40px; background-color: #f8f9fa; border-radius: 8px;">
            <h3>No se encontraron servicios por usuario en el rango de fechas especificado.</h3>
        </div>
    @endforelse

    <div class="footer">
        <p>Reporte generado automáticamente por el sistema de gestión de servicios</p>
    </div>
</body>
</html> 