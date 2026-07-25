<?php

namespace App\Http\Controllers;

use App\Traits\DeviceDetectionTrait;
use App\Models\OldInventy;
use Illuminate\Http\Request;

class OldInventyController extends Controller
{
    use DeviceDetectionTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('old-inventy.index', $deviceInfo);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('old-inventy.create', $deviceInfo);
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
    public function show(OldInventy $oldInventy)
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('old-inventy.show', array_merge(['oldInventy' => $oldInventy], $deviceInfo));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OldInventy $oldInventy)
    {
        $deviceInfo = $this->getDeviceInfo();
        return view('old-inventy.edit', array_merge(['oldInventy' => $oldInventy], $deviceInfo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OldInventy $oldInventy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OldInventy $oldInventy)
    {
        //
    }
}
