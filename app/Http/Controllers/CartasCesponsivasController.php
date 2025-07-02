<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsiva;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class CartasCesponsivasController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cartasresponsivas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cartasresponsivas.create');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $responsiva = Responsiva::with([
                'user',
                'responsable', 
                'informatica',
                'inventoryResponsivas.inventory'
            ])->findOrFail($id);

            return view('cartasresponsivas.show', compact('responsiva'));
        } catch (\Exception $e) {
            Log::error('Error mostrando carta responsiva: ' . $e->getMessage());
            abort(404, 'Carta responsiva no encontrada');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return view('cartasresponsivas.edit', compact('id'));
    }



    /**
     * Generate PDF report for a specific responsiva
     */
    public function generatePdf($id)
    {
        try {
            Log::info('Iniciando generación de PDF para carta responsiva: ' . $id);
            
            // Primero probar con un PDF simple
            $html = '<h1>Prueba PDF</h1><p>Carta Responsiva ID: ' . $id . '</p>';
            
            $pdf = PDF::loadHTML($html);
            
            Log::info('PDF de prueba generado exitosamente');
            
            return $pdf->stream('test.pdf');

        } catch (\Exception $e) {
            Log::error('Error generando PDF para carta responsiva ' . $id . ': ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            abort(500, 'Error al generar el PDF: ' . $e->getMessage());
        }
    }


}
