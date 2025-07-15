<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('service.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Generate PDF for individual service
     */
    public function generatePdf($id)
    {
        try {
            $service = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo'])->findOrFail($id);
            
            $data = [
                'service' => $service,
                'title' => 'Reporte Individual de Servicio',
                'generatedAt' => now()->format('d/m/Y H:i:s'),
            ];
            
            $pdf = PDF::loadView('reports.services.individual', $data)
                      ->setPaper('letter', 'portrait');
            
            return $pdf->stream('reporte_servicio_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $service->id_s) . '.pdf');
            
        } catch (\Exception $e) {
            Log::error('Error generando PDF para servicio ' . $id . ': ' . $e->getMessage());
            abort(500, 'Error al generar el PDF. Por favor, revise los logs.');
        }
    }

    /**
     * Generate detailed PDF for individual service
     */
    public function generateDetailsPdf($id)
    {
        try {
            $service = Service::with(['solicitante', 'efectuo', 'vobo', 'capturo', 'photos'])->findOrFail($id);
            
            $data = [
                'service' => $service,
                'title' => 'Reporte Detallado de Servicio',
                'generatedAt' => now()->format('d/m/Y H:i:s'),
            ];
            
            $pdf = PDF::loadView('reports.services.detalles', $data)
                      ->setPaper('letter', 'portrait');
            
            return $pdf->stream('detalles_servicio_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $service->id_s) . '.pdf');
            
        } catch (\Exception $e) {
            Log::error('Error generando PDF de detalles para servicio ' . $id . ': ' . $e->getMessage());
            abort(500, 'Error al generar el PDF de detalles. Por favor, revise los logs.');
        }
    }
}
