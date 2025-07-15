<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
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
        return view('inventory.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('inventory.edit', ['id' => $id]);
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
    
    public function userinv() {
        return view('inventory.user-inv');
    }

    public function responsables() {
        return view('inventory.responsables');
    }

    /**
     * Generate PDF for individual inventory
     */
    public function generatePdf($id)
    {
        try {
            $inventory = Inventory::with(['assignedUser', 'responsible'])->findOrFail($id);
            
            $data = [
                'inventory' => $inventory,
                'title' => 'Reporte Individual de Inventario',
                'generatedAt' => now()->format('d/m/Y H:i:s'),
            ];
            
            $pdf = PDF::loadView('reports.inventory.individual', $data)
                      ->setPaper('letter', 'portrait');
            
            return $pdf->stream('reporte_inventario_' . $inventory->id . '.pdf');
            
        } catch (\Exception $e) {
            Log::error('Error generando PDF para inventario ' . $id . ': ' . $e->getMessage());
            abort(500, 'Error al generar el PDF. Por favor, revise los logs.');
        }
    }
}
