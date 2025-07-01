<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartasCesponsivasController extends Controller
{
    public $activePhotoFormId = null;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return view('cartasresponsivas.edit', compact('id'));
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

    public function save()
    {
        \Log::info('Livewire save ejecutado', [
            'user_id' => $this->user_id,
            'responsable_id' => $this->responsable_id,
            'informatica_id' => $this->informatica_id,
            'fecha' => $this->fecha,
            'codigo' => $this->codigo,
            'auditoria' => $this->auditoria,
            'selected_inventories' => $this->selected_inventories,
        ]);
        // ... resto del método ...
    }

    public function openPhotoModal($inventoryId)
    {
        \Log::info('Abriendo modal de foto para inventario: ' . $inventoryId);
        // ... resto del código ...
    }

    public function closePhotoForm()
    {
        $this->activePhotoFormId = null;
    }
}
