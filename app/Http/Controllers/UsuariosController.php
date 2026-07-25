<?php

namespace App\Http\Controllers;

use App\Traits\DeviceDetectionTrait;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    use DeviceDetectionTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->tipo == 1){
            $deviceInfo = $this->getDeviceInfo();
            return view('usuarios.index', $deviceInfo);
        }else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('usuarios.create', $deviceInfo);
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
        $deviceInfo = $this->getDeviceInfo();
        return view('usuarios.show', array_merge(['id' => $id], $deviceInfo));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('usuarios.edit', array_merge(['id' => $id], $deviceInfo));
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
}
