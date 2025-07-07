<?php

namespace App\Http\Controllers;

use App\Models\Responsiva;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class CartasResponsivaController extends Controller
{
    /**
     * Mostrar la página de carta responsiva
     */
    public function show($id)
    {
        $responsiva = Responsiva::with([
            'user',
            'responsable', 
            'informatica',
            'inventoryResponsivas.inventory'
        ])->findOrFail($id);

        return view('reports.cartasresponsiva', compact('responsiva'));
    }

    /**
     * Mostrar la página de carta responsiva por código
     */
    public function showByCode($codigo)
    {
        $responsiva = Responsiva::with([
            'user',
            'responsable', 
            'informatica',
            'inventoryResponsivas.inventory'
        ])->where('codigo', $codigo)->first();

        if (!$responsiva) {
            abort(404, 'Carta responsiva no encontrada');
        }

        return view('reports.cartasresponsiva', compact('responsiva'));
    }

    /**
     * Generate PDF report for a specific responsiva
     */
    public function generatePdf($id)
    {
        try {
            Log::info('Iniciando generación de PDF para carta responsiva: ' . $id);
            
            // Obtener la responsiva con todas sus relaciones
            $responsiva = Responsiva::with([
                'user',
                'responsable', 
                'informatica',
                'inventoryResponsivas.inventory'
            ])->findOrFail($id);

            // Preparar datos para la vista
            $data = [
                'responsiva' => $responsiva,
                'title' => 'Carta Responsiva - ' . $responsiva->codigo,
                'generatedAt' => now()->format('d/m/Y H:i:s'),
            ];

            // Generar el PDF usando la misma vista que la página web
            $pdf = PDF::loadView('reports.cartasresponsivas.individual', $data)
                      ->setPaper('letter', 'portrait');

            Log::info('PDF generado exitosamente para carta responsiva: ' . $responsiva->codigo);
            
            // Hacer stream del PDF directamente al navegador
            return $pdf->stream('carta_responsiva_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $responsiva->codigo) . '.pdf');

        } catch (\Exception $e) {
            Log::error('Error generando PDF para carta responsiva ' . $id . ': ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            abort(500, 'Error al generar el PDF: ' . $e->getMessage());
        }
    }
} 