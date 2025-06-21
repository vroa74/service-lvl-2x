<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Orden de Servicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .field {
            margin-bottom: 10px;
        }
        .field-label {
            font-weight: bold;
        }
        .field-value {
            margin-left: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">ORDEN DE SERVICIO</div>
        <div>DIRECCION DE INFORMATICA</div>
    </div>

    <div class="section">
        <div class="field">
            <span class="field-label">No. de Orden:</span>
            <span class="field-value">{{ $service->id ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Fecha:</span>
            <span class="field-value">{{ $service->created_at ? $service->created_at->format('d/m/Y') : 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">DATOS DEL SOLICITANTE</div>
        <div class="field">
            <span class="field-label">Nombre:</span>
            <span class="field-value">{{ $service->solicitante->name ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Direccion:</span>
            <span class="field-value">{{ $service->solicitante->direction ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Puesto:</span>
            <span class="field-value">{{ $service->solicitante->position ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">OBJETO DE LA SOLICITUD</div>
        <div class="field">
            <span class="field-value">{{ $service->obj_sol ?? 'Sin especificar' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">ACTIVIDADES REALIZADAS</div>
        <div class="field">
            <span class="field-value">{{ $service->actividades ?? 'Sin especificar' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">OBSERVACIONES</div>
        <div class="field">
            <span class="field-value">{{ $service->observaciones ?? 'Sin observaciones' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">RESPONSABLES</div>
        <table>
            <tr>
                <th>Función</th>
                <th>Nombre</th>
            </tr>
            <tr>
                <td>Efectuó</td>
                <td>{{ $service->efectuo->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Vo.Bo.</td>
                <td>{{ $service->vobo->name ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
</body>
</html> 