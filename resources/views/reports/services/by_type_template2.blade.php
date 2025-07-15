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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .modern-stat-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .modern-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .modern-stat-card:hover::before {
            transform: translateX(100%);
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
        
        .type-section {
            margin-bottom: 40px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .type-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            position: relative;
        }
        
        .type-header::before {
            content: '📊';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
        }
        
        .type-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }
        
        .type-header p {
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
        
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .chart-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .chart-bar {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background: #f8fafc;
            border-radius: 10px;
            padding: 10px;
        }
        
        .chart-label {
            width: 150px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .chart-progress {
            flex: 1;
            height: 20px;
            background: #e2e8f0;
            border-radius: 10px;
            margin: 0 15px;
            overflow: hidden;
            position: relative;
        }
        
        .chart-fill {
            height: 100%;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
        }
        
        .chart-value {
            width: 60px;
            text-align: right;
            font-weight: bold;
            color: #2c3e50;
        }
        
        /* Estilos para las fotos de servicios (para uso futuro) */
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
                <div class="modern-stat-number">{{ count(array_filter($typeStats)) }}</div>
                <div class="modern-stat-label">Tipos de Servicio</div>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-title">Distribución por Tipo de Servicio</div>
            @php
                $maxValue = max($typeStats);
            @endphp
            @foreach($typeStats as $type => $count)
                @if($count > 0)
                    <div class="chart-bar">
                        <div class="chart-label">{{ ucfirst($type) }}</div>
                        <div class="chart-progress">
                            <div class="chart-fill" style="width: {{ ($count / $maxValue) * 100 }}%"></div>
                        </div>
                        <div class="chart-value">{{ $count }}</div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="modern-footer">
            <p style="margin: 0; font-size: 14px;">📊 Reporte generado automáticamente por el sistema de gestión de servicios</p>
            <p style="margin: 5px 0 0 0; font-size: 12px; opacity: 0.8;">Plantilla Moderna - Versión 2.0</p>
        </div>
    </div>
</body>
</html> 