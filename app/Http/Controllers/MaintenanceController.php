<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Supplier;
use App\Models\AssetMaintenance;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Asset::all();
        $vendors = Supplier::all();
        return view('maintenance.create', compact('assets', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'maintenance_type' => 'required|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'service_date' => 'required|date',
            'next_service_due' => 'nullable|date',
            'cost' => 'nullable|numeric',
            'status' => 'required|string',
            'vendor_id' => 'nullable|exists:suppliers,id',
            'is_recurring' => 'nullable',
            'recurrence_interval' => 'nullable|integer|min:1',
            'recurrence_unit' => 'nullable|string|in:days,weeks,months,years',
        ]);
        $data['is_recurring'] = $request->has('is_recurring');
        if (!$data['is_recurring']) {
            $data['recurrence_interval'] = null;
            $data['recurrence_unit'] = null;
        }
        AssetMaintenance::create($data);
        return redirect()->route('maintenance.index')->with('success', 'Maintenance scheduled successfully.');
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
    public function edit(string $id)
    {
        //
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
