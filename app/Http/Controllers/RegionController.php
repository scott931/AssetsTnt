<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::withCount(['landRegisters', 'buildingRegisters'])
            ->orderBy('name')
            ->paginate(10);
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:regions,code',
            'description' => 'nullable|string',
            'headquarters' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Region::create($request->all());
        return redirect()->route('regions.index')->with('success', 'Region created successfully.');
    }

    public function show(Region $region)
    {
        $region->load(['landRegisters', 'buildingRegisters']);
        return view('regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:regions,code,' . $region->id,
            'description' => 'nullable|string',
            'headquarters' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $region->update($request->all());
        return redirect()->route('regions.index')->with('success', 'Region updated successfully.');
    }

    public function destroy(Region $region)
    {
        if ($region->landRegisters()->count() > 0 || $region->buildingRegisters()->count() > 0) {
            return redirect()->route('regions.index')->with('error', 'Cannot delete region with associated records.');
        }

        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Region deleted successfully.');
    }

    public function report(Region $region)
    {
        $landRegisters = $region->landRegisters()->orderBy('county')->get();
        $buildingRegisters = $region->buildingRegisters()->orderBy('county')->get();

        return view('regions.report', compact('region', 'landRegisters', 'buildingRegisters'));
    }
}
