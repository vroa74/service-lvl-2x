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
    </style>
</head>
<body>
    <div id="header">
        <div style="width: 96%; display: flex; justify-content: center;">
            <table class="tableclean">
                <tr>
                    <td style="width: 20%; text-align: center; vertical-align: middle;"></td>
                    <td style="width: 56%; text-align: center; vertical-align: middle; padding: 10px;">
                        @php
                            $headImagePath = public_path('ple/head.png');
                            $headImageBase64 = base64_encode(file_get_contents($headImagePath));
                        @endphp
                        <img src="data:image/png;base64,{{ $headImageBase64 }}" alt="Logo izquierdo" style="max-width: 100%; height: auto;">
                        <h1 style="margin: 5px 0;">ORDEN DE SERVICIO</h1>
                    </td>
                    <td style="width: 20%; text-align: center; vertical-align: middle;"></td>
                </tr>
            </table>
        </div>
    </div>
    <table class="tablaSection1">
        <tr>
            <td class="col1">
                <p class="text-lg m-1" style="margin: 2px 0;">FECHA DE SERVICIO:</p>
                <p class="text-lg m-1" style="margin: 2px 0;">NOMBRE DE SOLICITANTE:</p>
                <p class="text-lg m-1" style="margin: 2px 0;">OFICINA O DEPARTAMENTO:</p>
            </td>
            <td class="col2">
                <div class="box text-center">
                    No. Reporte:<br>
                    {{ $service->id_s ?? 'N/A' }}
                </div>
            </td>
        </tr>
    </table>

    <table class="tablaSection2">
        <tr>
            <td>
                <div class="box">
                    <!-- Aquí va tu contenido -->
                </div>
            </td>
        </tr>
    </table>

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
            <div class="stat-number">{{ $activeServices }}</div>
            <div class="stat-label">Servicios Activos</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $inactiveServices }}</div>
            <div class="stat-label">Servicios Inactivos</div>
        </div>
    </div>

    <table>
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
                    <td>{{ $service->id_s ?? 'N/A' }}</td>
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
                        {{ implode(', ', $types) ?: 'N/A' }}
                    </td>
                    <td class="{{ $service->estatus_servicio ? 'status-active' : 'status-inactive' }}">
                        {{ $service->estatus_servicio ? 'Activo' : 'Inactivo' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">
                        No se encontraron servicios en el rango de fechas especificado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Reporte generado automáticamente por el sistema de gestión de servicios</p>
    </div>
</body>
</html> 