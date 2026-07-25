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
        .type-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .type-card {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .type-name {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .type-count {
            font-size: 32px;
            font-weight: bold;
            color: #27ae60;
        }
        .type-percentage {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #2c3e50;
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
    </div>

    <div class="type-stats">
        <div class="type-card">
            <div class="type-name">Correctivo</div>
            <div class="type-count">{{ $typeStats['correctivo'] }}</div>
            <div class="type-percentage">
                {{ $totalServices > 0 ? round(($typeStats['correctivo'] / $totalServices) * 100, 1) : 0 }}%
            </div>
        </div>
        <div class="type-card">
            <div class="type-name">Preventivo</div>
            <div class="type-count">{{ $typeStats['preventivo'] }}</div>
            <div class="type-percentage">
                {{ $totalServices > 0 ? round(($typeStats['preventivo'] / $totalServices) * 100, 1) : 0 }}%
            </div>
        </div>
        <div class="type-card">
            <div class="type-name">Transparencia</div>
            <div class="type-count">{{ $typeStats['transparencia'] }}</div>
            <div class="type-percentage">
                {{ $totalServices > 0 ? round(($typeStats['transparencia'] / $totalServices) * 100, 1) : 0 }}%
            </div>
        </div>
        <div class="type-card">
            <div class="type-name">A. Técnico</div>
            <div class="type-count">{{ $typeStats['a_tec'] }}</div>
            <div class="type-percentage">
                {{ $totalServices > 0 ? round(($typeStats['a_tec'] / $totalServices) * 100, 1) : 0 }}%
            </div>
        </div>
        <div class="type-card">
            <div class="type-name">Web/Ins</div>
            <div class="type-count">{{ $typeStats['web_ins'] }}</div>
            <div class="type-percentage">
                {{ $totalServices > 0 ? round(($typeStats['web_ins'] / $totalServices) * 100, 1) : 0 }}%
            </div>
        </div>
        <div class="type-card">
            <div class="type-name">Print</div>
            <div class="type-count">{{ $typeStats['print'] }}</div>
            <div class="type-percentage">
                {{ $totalServices > 0 ? round(($typeStats['print'] / $totalServices) * 100, 1) : 0 }}%
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Reporte generado automáticamente por el sistema de gestión de servicios</p>
        <p>Nota: Un servicio puede tener múltiples tipos, por lo que la suma de porcentajes puede exceder el 100%</p>
    </div>
</body>
</html> 