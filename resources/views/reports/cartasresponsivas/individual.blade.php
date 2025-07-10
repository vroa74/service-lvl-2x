<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Individual de Servicio</title>
    <style>
        @page {
            margin: 8cm 2cm 9cm 2cm;  /* arrriba, derecha, abajo, izquierda */
        }
        #header {
            position: fixed;
            top: -7.5cm;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 1000;
            margin: 0;
            padding: 0;
            /* background-color: #c7d1fc !important; */
        }

        body {
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            /* background-color: #fa52d0; */
        }

        #footer {
            position: fixed;
            left: 0;
            bottom: -8.5cm;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #333;
            background: #fff;
            padding: 8px 0;
            z-index: 1000;
            /* background-color: #ee591e !important; */
        }

        .tableclean {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
            border: none;
            text-align: center;
            /* background-color: #07f8a8 !important; */
        }

        .tableclean th,
        .tableclean td {
            border: none;
            text-align: center;
            vertical-align: middle;
            padding: 2px;
        }

        .tablaSection1 {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 0;
            padding: 10px;
            /* background-color: #f306ac !important; */
        }|

        .tablaSection1 td {
            vertical-align: top;
            padding: 0;
            border: none;
        }

        .tablaSection1 td.col1 {
            width: 75%;
            padding: 2px;
        }

        .tablaSection1 td.col2 {
            width: 25%;
            padding: 2px;
        }

        .tablaSection1 .box {
            border: 2px solid black;
            border-radius: 20px;
            padding: 3px;
            margin: 0;
        }

        .tablaSection2 {
            width: 99%;
            border-collapse: collapse;
            margin-top: -10px;
            padding: 0;
            /* background-color: #e5ff52 !important; */
        }

        .tablaSection2 td {
            padding: 0;
            border: none;
        }

        .tablaSection2 .box {
            width: 99%;
            height: 7rem;
            border: 2px solid black;
            border-radius: 25px;
            box-sizing: border-box;
            margin: 0;
            padding: 5px;
        }

        .checklist {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.2;
        }

        .checklist td {
            width: 50%;
            padding: 0;
            border: none;
            vertical-align: top;
        }

        .checklist .box {
            border: 2px solid black;
            border-radius: 25px;
            padding: 10px;
            margin: 2px;
            display: block;
        }

        .Textareas {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            font-size: 11px;
            line-height: 1.2;
        }

        .Textareas td {
            width: 50%;
            padding: 0;
            border: none;
            vertical-align: top;
        }

        .Textareas .box {
            border: 2px solid black;
            border-radius: 25px;
            height: 20rem;
            padding: 6px;
            margin: 2px;
            box-sizing: border-box;
            display: block;
        }

        .text-5px { font-size: 0.3125rem; }  /* 5px */
        .text-6px { font-size: 0.375rem; }   /* 6px */
        .text-7px { font-size: 0.4375rem; }  /* 7px */
        .text-8px { font-size: 0.5rem; }     /* 8px */
        .text-9px { font-size: 0.5625rem; }  /* 9px */
        .text-10px { font-size: 0.625rem; }  /* 10px */
        .text-11px { font-size: 0.6875rem; } /* 11px */
        .text-xs { font-size: 0.75rem; }     /* 12px */
        .text-sm { font-size: 0.875rem; }    /* 14px */
        .text-base { font-size: 1rem; }      /* 16px */
        .text-lg { font-size: 1.125rem; }    /* 18px */
        .text-xl { font-size: 1.25rem; }     /* 20px */
        /* Tamaños de texto medianos */
        .text-2xl { font-size: 1.5rem; }     /* 24px */
        .text-3xl { font-size: 1.875rem; }   /* 30px */
        .text-4xl { font-size: 2.25rem; }    /* 36px */
        .text-5xl { font-size: 3rem; }       /* 48px */
        .text-6xl { font-size: 3.75rem; }    /* 60px */
        .text-7xl { font-size: 4.5rem; }     /* 72px */
        /* Tamaños de texto grandes */
        .text-8xl { font-size: 6rem; }       /* 96px */
        .text-9xl { font-size: 8rem; }       /* 128px */
        .text-left {             text-align: left;        }
        .text-center {            text-align: center;        }
        .text-right {            text-align: right;        }
        .text-justify {             text-align: justify        }

        /* Estilo para texto en negrita */
        .font-bold {            font-weight: bold;        }
        .text-bold {            font-weight: bold;        }
        /* Estilo para texto en cursiva */
        .italic {            font-style: italic;        }
        /* Estilo para texto subrayado */
        .font-underline {            text-decoration: underline;        }
        /* Estilo para texto tachado */
        .line-through {            text-decoration: line-through;        }



        .text-center {
            text-align: center;
        }

        .m-1 {
            margin: 0.25rem;
        }

        .mb--10 {
            margin-bottom: -2.5rem;
        }
        .mt-0 {    margin-top: 0;  }
        .mt-1 {    margin-top: 0.25rem;  }
        .mt-2 {    margin-top: 0.5rem;  }
        .mt-3 {    margin-top: 0.75rem;  }
        .mt-4 {    margin-top: 1rem;  }
        .mt-5 {    margin-top: 1.25rem;  }
        .mt-6 {    margin-top: 1.5rem;  }
        .mt-7 {    margin-top: 1.75rem;  }





        
     /*    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        } */
        
      /*   body {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background-color: #fff;
        } */
        
        /* .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
        } */
        
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }
        
        .header .subtitle {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }
        
        .service-info {
            margin-bottom: 25px;
        }
        
        .info-section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            background-color: #f1f5f9;
            padding: 8px 12px;
            border-left: 4px solid #2563eb;
            margin-bottom: 12px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        
        .info-value {
            font-size: 12px;
            color: #1e293b;
            font-weight: 500;
            padding: 6px 8px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            min-height: 20px;
        }
        
        .info-value.empty {
            color: #94a3b8;
            font-style: italic;
        }
        
        .full-width {
            grid-column: 1 / -1;
        }
        
        .users-section {
            margin-bottom: 20px;
        }
        
        .user-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
        }
        
        .user-role {
            font-size: 11px;
            font-weight: 600;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        
        .user-name {
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
        }
        
        .user-details {
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
        }
        
        .user-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 4px;
            font-size: 11px;
            line-height: 1.3;
        }
        
        .detail-label {
            font-weight: 600;
            color: #64748b;
            min-width: 60px;
            margin-right: 8px;
        }
        
        .detail-value {
            color: #1e293b;
            flex: 1;
            word-wrap: break-word;
        }
        
        .service-types {
            margin-bottom: 20px;
        }
        
        .type-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        
        .type-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 8px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }
        
        .type-checkbox {
            width: 12px;
            height: 12px;
            border: 2px solid #2563eb;
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .type-checkbox.checked {
            background-color: #2563eb;
        }
        
        .type-checkbox.checked::after {
            content: '✓';
            color: white;
            font-size: 8px;
            font-weight: bold;
        }
        
        .type-label {
            font-size: 11px;
            font-weight: 500;
            color: #1e293b;
        }
        
        .content-section {
            margin-bottom: 20px;
        }
        
        .content-text {
            font-size: 12px;
            color: #1e293b;
            line-height: 1.5;
            padding: 10px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            min-height: 40px;
        }
        
        /* .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 10px;
            color: #64748b;
        } */
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-active {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-inactive {
            background-color: #fef2f2;
            color: #991b1b;
        }
        
        @media print {
            body {
                font-size: 10px;
            }
            
            .header h1 {
                font-size: 20px;
            }
            
            .section-title {
                font-size: 12px;
            }
            
            .info-value {
                font-size: 10px;
            }
        }
    </style>

</head>
<body>
    <div id="header">
        <table style="width:100%; border-collapse: collapse; margin: 0 auto;">
            <tr>
                <td style="width:20%;"></td>
                <td style="width:60%; text-align: center;"></td>
                <td style="width:20%;"></td>
            </tr>
        </table>
        <div style="width: 96%; display: flex; justify-content: center;">
            <table class="tableclean">
                <tr>
                    <td style="width: 20%; text-align: center; vertical-align: middle;">
                        @php
                        $headImagePath = public_path('ple/head_cri.png');
                        $headImageBase64 = base64_encode(file_get_contents($headImagePath));
                    @endphp
                    <img    src="data:image/png;base64,{{ $headImageBase64 }}" 
                            alt="Logo izquierdo" style="max-width: 60%; height: auto;">

                    </td>
                    <td style="width: 56%; text-align: center; vertical-align: middle; padding: 10px;">
                        <p style="margin: 5px 0; font-size: 12px; font-style: italic; color: #333;">{{ config('app.lema') }}</p>
                        <p style="margin: 5px 0; font-size: 12px; font-style: italic; color: #333;">PODER LEGISLATIVO DEL ESTADO DE CAMPECHE 
                        <p style="margin: 5px 0; font-size: 12px; font-style: italic; color: #333;">  DIRECCIÓN DE INFORMÁTICA                               </p>
                        <p style="margin: 5px 0; font-size: 14px; font-style: italic; color: #333;">  CARTA RESPONSIVA </p>
                        {{-- <h1 style="margin: 5px 0;">ORDEN DE SERVICIO</h1> --}}
                    </td>
                    <td style="width: 20%; text-align: center; vertical-align: middle;">
                        @php
                        $headImagePath = public_path('ple/head_crd.png');
                        $headImageBase64 = base64_encode(file_get_contents($headImagePath));
                    @endphp
                    <img    src="data:image/png;base64,{{ $headImageBase64 }}" 
                            alt="Logo izquierdo" style="max-width: 60%; height: auto;">                            
                    </td>
                </tr>
            </table>
            <p style="text-align: justify;">Por medio del presente hago constar que tengo conocimiento de mis funciones y responsabilidades establecidas en el artículo 7, fracción I y artículo 50 de la Ley General de Responsabilidades Administrativas, así como de lo dispuesto en el artículo 47, fracción VIII de la Ley de los Trabajadores al Servicio del Gobierno del Estado de Campeche.</p>
            <p style="text-align: justify;">Razón por la cual manifiesto que tengo bajo mi responsabilidad, para el cumplimiento de mis funciones, el equipo de cómputo que se menciona a continuación:</p>   

        </div>
    </div>


    <div id="footer">
        <!-- Tabla de auditoría de software practicado -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0; border-radius: 8px; overflow: hidden; border: 2px solid #222; margin-bottom: 1rem;">
            <tr>
                <td rowspan="2" style="width: 70%; text-align: center; font-weight: bold; font-size: 1.1em; border-right: 1px solid #222; border-radius: 8px 0 0 8px;">AUDITORÍA DE SOFTWARE PRACTICADO</td>
                <td style="width: 15%; text-align: center;  font-weight: bold; border-bottom: 1px solid #222; border-right: 1px solid #222;">SI</td>
                <td style="width: 15%; text-align: center;  font-weight: bold; border-bottom: 1px solid #222; border-radius: 0 8px 0 0;">NO</td>
            </tr>
            <tr>
                <td style="height: 2.5em; border-right: 1px solid #222;"></td>
                <td style="text-align: center; font-weight: bold;">x</td>
            </tr>
        </table>

        <p class="text-justify text-black text-bold" >El que me comprometo a cuidar, mantener en buen estado y utilizar única y exclusivamente para asuntos relacionados con mis funciones como servidor público del Congreso del Estado. En caso de su extravío, daño o destrucción por causas imputables al suscrito, me responsabilizo a pagar el costo de reparación o la reposición del equipo. Asumiendo además las responsabilidades que se deriven, en su caso, por el uso inadecuado del mismo. </p>
        <p class="text-left text-bold" >FECHA: </p>
        <p class="text-left text-bold" >NOMBRE DE USUARIO: </p>
        <p class="text-left text-bold" >DIRECCIÓN: </p>

        <table style="width: 100%; border-collapse: separate; border-spacing: 0.5rem;">
            <tr>
                <td style="border: 2px solid #000; border-radius: 25px;  height: 3rem;"> <br> <br>
                </td>
                <td style="border: 2px solid #000; border-radius: 25px;  height: 3rem;"> <br> <br>

                </td>
                <td style="border: 2px solid #000; border-radius: 25px;  height: 3rem;"> <br> <br>

                </td>
            </tr>
        </table>
        <div style="margin-top: 0.5rem; color: #fff; font-weight: bold;">Poder Legislativo del Estado de Campeche - Dirección de Informática</div>
    </div>
    






    <!-- === RESUMEN DE VARIABLES DE LA CARTA RESPONSIVA === -->
    <div class="info-section" style="margin-top: 40px;">
        <h2>Resumen de Datos de la Carta Responsiva</h2>
        <table style="width:100%; border-collapse: collapse;" class="text-7px">
            <tr><td><strong>Código:</strong></td><td>{{ $responsiva->codigo ?? 'N/A' }}</td></tr>
            <tr><td><strong>Fecha:</strong></td><td>{{ $responsiva->fecha ? $responsiva->fecha->format('d/m/Y') : 'N/A' }}</td></tr>
            <tr><td><strong>Auditoría:</strong></td><td>{{ $responsiva->auditoria ? 'Sí' : 'No' }}</td></tr>
            <tr><td><strong>Observación:</strong></td><td>{{ $responsiva->observacion ?? 'N/A' }}</td></tr>
            <tr><td><strong>Usuario:</strong></td><td>{{ $responsiva->user->name ?? 'N/A' }}</td></tr>
            <tr><td><strong>Responsable:</strong></td><td>{{ $responsiva->responsable->name ?? 'N/A' }}</td></tr>
            <tr><td><strong>Informática:</strong></td><td>{{ $responsiva->informatica->name ?? 'N/A' }}</td></tr>
            <tr><td><strong>Total Artículos:</strong></td><td>{{ isset($responsiva->inventoryResponsivas) ? $responsiva->inventoryResponsivas->count() : 0 }}</td></tr>
            <tr><td><strong>Fecha de Creación:</strong></td><td>{{ $responsiva->created_at ? $responsiva->created_at->format('d/m/Y H:i:s') : 'N/A' }}</td></tr>
            <tr><td><strong>Última Actualización:</strong></td><td>{{ $responsiva->updated_at ? $responsiva->updated_at->format('d/m/Y H:i:s') : 'N/A' }}</td></tr>
        </table>
    </div>
    
    <!-- === DATOS DE LA CARTA RESPONSIVA (Formato clásico) === -->
    <div class="info-section" style="margin-top: 40px; display: flex; flex-direction: column; align-items: center;">
        <div style="max-width: 800px; width: 100%;" class="text-7px">
            <h2 style="text-align: center;">Información General</h2>
            <div class="info-grid text-7px">
                <div class="info-item">
                    <span class="info-label text-7px">Código:</span>
                    <span class="info-value text-7px">{{ $responsiva->codigo }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label text-7px">Fecha:</span>
                    <span class="info-value text-7px">{{ $responsiva->fecha ? $responsiva->fecha->format('d/m/Y') : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label text-7px">Auditoría:</span>
                    <span class="info-value text-7px">
                        @if($responsiva->auditoria)
                            <span class="status-badge status-active">Sí</span>
                        @else
                            <span class="status-badge status-inactive">No</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label text-7px">Total Artículos:</span>
                    <span class="info-value text-7px">{{ $responsiva->inventoryResponsivas->count() }}</span>
                </div>
            </div>
            @if($responsiva->observacion)
            <div class="info-item" style="margin-top: 15px;">
                <span class="info-label text-7px">Observaciones:</span>
                <span class="info-value text-7px">{{ $responsiva->observacion }}</span>
            </div>
            @endif
        </div>
    </div>
    <div class="info-section text-7px">
        <h2>Información de Usuarios</h2>
        <div class="info-grid text-7px">
            <div class="info-item">
                <span class="info-label text-7px">Usuario que Genera:</span>
                <span class="info-value text-7px">
                    @if($responsiva->user)
                        {{ $responsiva->user->name }}<br>
                        <small style="color: #6b7280;">{{ $responsiva->user->email }}</small>
                    @else
                        Sin usuario asignado
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label text-7px">Responsable:</span>
                <span class="info-value text-7px">
                    @if($responsiva->responsable)
                        {{ $responsiva->responsable->name }}<br>
                        <small style="color: #6b7280;">{{ $responsiva->responsable->email }}</small>
                    @else
                        Sin responsable asignado
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label text-7px">Informática:</span>
                <span class="info-value text-7px">
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
    @if($responsiva->inventoryResponsivas->count() > 0)
    <div class="info-section text-7px">
        <h2>Artículos Asignados</h2>
        <div class="table-container">
            <table class="table text-7px">
                <thead>
                    <tr>
                        <th class="text-7px">Artículo</th>
                        <th class="text-7px">NI</th>
                        <th class="text-7px">SN</th>
                        <th class="text-7px">Marca/Modelo</th>
                        <th class="text-7px">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($responsiva->inventoryResponsivas as $inventoryResponsiva)
                        @if($inventoryResponsiva->inventory)
                        <tr>
                            <td class="text-7px">{{ $inventoryResponsiva->inventory->articulo ?? 'N/A' }}</td>
                            <td class="text-7px">{{ $inventoryResponsiva->inventory->ni ?? 'N/A' }}</td>
                            <td class="text-7px">{{ $inventoryResponsiva->inventory->ns ?? 'N/A' }}</td>
                            <td class="text-7px">
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
        <h2 class="text-7px">Artículos Asignados</h2>
        <p class="text-7px" style="color: #6b7280; font-style: italic;">No hay artículos asignados a esta carta responsiva.</p>
    </div>
    @endif
    <div class="info-section">
        <h2 class="text-7px">Información Adicional</h2>
        <div class="info-grid text-7px">
            <div class="info-item text-7px">
                <span class="info-label text-7px">Fecha de Creación:</span>
                <span class="info-value text-7px">{{ $responsiva->created_at->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="info-item text-7px">
                <span class="info-label text-7px">Última Actualización:</span>
                <span class="info-value text-7px">{{ $responsiva->updated_at->format('d/m/Y H:i:s') }}</span>
            </div>
        </div>
    </div>
</body>
</html> 