<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta Responsiva - {{ $responsiva->codigo ?? 'N/A' }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 2.5em;
        }
        .header .subtitle {
            color: #666;
            font-size: 1.2em;
            margin-top: 10px;
        }
        .info-section {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .info-section h2 {
            color: #007bff;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.5em;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .info-item {
            background: white;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }
        .info-item strong {
            color: #007bff;
            display: block;
            margin-bottom: 5px;
        }
        .info-item span {
            color: #333;
            font-size: 1.1em;
        }
        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .inventory-table th {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        .inventory-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        .inventory-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .inventory-table tr:hover {
            background: #e3f2fd;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: bold;
        }
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }
        .audit-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
        }
        .audit-true {
            background: #28a745;
            color: white;
        }
        .audit-false {
            background: #6c757d;
            color: white;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            text-align: center;
            color: #666;
        }
        .signature-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #eee;
        }
        .signature-box {
            text-align: center;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        .signature-line {
            width: 80%;
            height: 2px;
            background: #333;
            margin: 20px auto;
        }
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .print-button:hover {
            background: #0056b3;
        }
        @media print {
            .print-button {
                display: none;
            }
            body {
                background: white;
            }
            .container {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">🖨️ Imprimir</button>
    
    <div class="container">
        <div class="header">
            <h1>CARTA RESPONSIVA</h1>
            <div class="subtitle">Código: {{ $responsiva->codigo ?? 'N/A' }}</div>
        </div>

        @if(isset($responsiva))
        <!-- Información General de la Responsiva -->
        <div class="info-section">
            <h2>📋 Información General</h2>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Código de Responsiva:</strong>
                    <span>{{ $responsiva->codigo ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <strong>Fecha:</strong>
                    <span>{{ $responsiva->fecha ? $responsiva->fecha->format('d/m/Y') : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <strong>Estado de Auditoría:</strong>
                    <span class="audit-badge {{ $responsiva->auditoria ? 'audit-true' : 'audit-false' }}">
                        {{ $responsiva->auditoria ? 'AUDITADA' : 'NO AUDITADA' }}
                    </span>
                </div>
                <div class="info-item">
                    <strong>Observaciones:</strong>
                    <span>{{ $responsiva->observacion ?? 'Sin observaciones' }}</span>
                </div>
            </div>
        </div>

        <!-- Información de Usuarios -->
        <div class="info-section">
            <h2>👥 Información de Usuarios</h2>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Usuario Solicitante:</strong>
                    <span>{{ $responsiva->user->name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <strong>Responsable:</strong>
                    <span>{{ $responsiva->responsable->name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <strong>Personal de Informática:</strong>
                    <span>{{ $responsiva->informatica->name ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Inventario Asociado -->
        @if($responsiva->inventoryResponsivas && $responsiva->inventoryResponsivas->count() > 0)
        <div class="info-section">
            <h2>🖥️ Equipos e Inventario Asociado</h2>
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Número de Serie</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($responsiva->inventoryResponsivas as $inventoryResponsiva)
                        @if($inventoryResponsiva->inventory)
                        <tr>
                            <td>{{ $inventoryResponsiva->inventory->articulo ?? 'N/A' }}</td>
                            <td>{{ $inventoryResponsiva->inventory->marca ?? 'N/A' }}</td>
                            <td>{{ $inventoryResponsiva->inventory->modelo ?? 'N/A' }}</td>
                            <td>{{ $inventoryResponsiva->inventory->ns ?? 'N/A' }}</td>
                            <td>
                                <span class="status-badge {{ $inventoryResponsiva->inventory->status ? 'status-active' : 'status-inactive' }}">
                                    {{ $inventoryResponsiva->inventory->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>{{ $inventoryResponsiva->description ?? 'Sin descripción adicional' }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="info-section">
            <h2>🖥️ Equipos e Inventario Asociado</h2>
            <p>No hay equipos asociados a esta responsiva.</p>
        </div>
        @endif

        <!-- Sección de Firmas -->
        <div class="signature-section">
            <div class="signature-box">
                <strong>Firma del Responsable</strong>
                <div class="signature-line"></div>
                <p>{{ $responsiva->responsable->name ?? 'N/A' }}</p>
            </div>
            <div class="signature-box">
                <strong>Firma de Informática</strong>
                <div class="signature-line"></div>
                <p>{{ $responsiva->informatica->name ?? 'N/A' }}</p>
            </div>
            <div class="signature-box">
                <strong>Firma del Solicitante</strong>
                <div class="signature-line"></div>
                <p>{{ $responsiva->user->name ?? 'N/A' }}</p>
            </div>
        </div>

        @else
        <div class="info-section">
            <h2>❌ Error</h2>
            <p>No se encontró la carta responsiva solicitada.</p>
        </div>
        @endif

        <div class="footer">
            <p><strong>Documento generado el:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
            <p>Sistema de Gestión de Inventario - Carta Responsiva</p>
        </div>
    </div>

    <script>
        // Función para imprimir
        function printDocument() {
            window.print();
        }
    </script>
</body>
</html> 