<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Individual de Inventario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin-top: 20px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content th, .content td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .content th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Artículo de Inventario</h1>
    </div>

    <div class="container">
        <div class="content">
            <table>
                <tr>
                    <th style="width: 30%;">Artículo</th>
                    <td>{{ $inventory->articulo ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Número de Inventario (NI)</th>
                    <td>{{ $inventory->ni ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Número de Serie (NS)</th>
                    <td>{{ $inventory->ns ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Marca</th>
                    <td>{{ $inventory->marca ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Modelo</th>
                    <td>{{ $inventory->modelo ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Usuario Asignado</th>
                    <td>{{ $inventory->assignedUser->name ?? 'No asignado' }}</td>
                </tr>
                <tr>
                    <th>Resguardante</th>
                    <td>{{ $inventory->responsible->name ?? ($inventory->resguardante ?? 'N/A') }}</td>
                </tr>
                <tr>
                    <th>Ubicación (Dirección)</th>
                    <td>{{ $inventory->dir ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $inventory->status ? 'Activo' : 'Inactivo' }}</td>
                </tr>
                <tr>
                    <th>Información Adicional</th>
                    <td>{{ $inventory->info ?? 'N/A' }}</td>
                </tr>
                 <tr>
                    <th>Especificaciones</th>
                    <td>{{ $inventory->esp ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        Generado el {{ $generatedAt ?? now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html> 