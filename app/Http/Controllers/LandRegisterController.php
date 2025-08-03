<?php

namespace App\Http\Controllers;

use App\Models\LandRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LandRegisterController extends Controller
{
    public function index()
    {
        $landRegisters = LandRegister::latest()->paginate(10);
        return view('land-register.index', compact('landRegisters'));
    }

    public function create()
    {
        return view('land-register.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description_of_land' => 'required|string|max:1000',
            'mode_of_acquisition' => 'required|in:purchase,transfer,donation,inheritance,gift,other',
            'category' => 'required|in:land,investment_property',
            'county' => 'required|string|max:255',
            'nearest_town_location' => 'required|string|max:255',
            'gps_coordinates' => 'nullable|string|max:255',
            'polygon_a' => 'nullable|string|max:255',
            'polygon_b' => 'nullable|string|max:255',
            'polygon_c' => 'nullable|string|max:255',
            'polygon_d' => 'nullable|string|max:255',
            'lr_certificate_number' => 'nullable|string|max:255',
            'document_of_ownership' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'proprietorship_details' => 'required|string|max:1000',
            'size_hectares' => 'required|numeric|min:0|max:999999.9999',
            'ownership_status' => 'required|in:freehold,leasehold',
            'acquisition_date' => 'required|date',
            'registration_date' => 'nullable|date|after_or_equal:acquisition_date',
            'disputed_status' => 'required|in:disputed,undisputed',
            'encumbrances' => 'nullable|string|max:1000',
            'planning_status' => 'required|in:planned,unplanned',
            'purpose_use_of_land' => 'required|string|max:1000',
            'survey_status' => 'required|in:surveyed,not_surveyed',
            'acquisition_amount' => 'nullable|numeric|min:0|max:999999999.99',
            'fair_value' => 'nullable|numeric|min:0|max:999999999.99',
            'zonal_maps' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'disposal_date' => 'nullable|date|after_or_equal:acquisition_date',
            'disposal_value' => 'nullable|numeric|min:0|max:999999999.99',
            'annual_rental_income' => 'nullable|numeric|min:0|max:999999999.99',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['document_of_ownership', 'zonal_maps']);

        if ($request->hasFile('document_of_ownership')) {
            $documentPath = $request->file('document_of_ownership')->store('land-register/documents', 'public');
            $data['document_of_ownership_path'] = $documentPath;
        }

        if ($request->hasFile('zonal_maps')) {
            $zonalMapsPath = $request->file('zonal_maps')->store('land-register/zonal-maps', 'public');
            $data['zonal_maps_path'] = $zonalMapsPath;
        }

        LandRegister::create($data);

        return redirect()->route('land-register.index')->with('success', 'Land register entry created successfully.');
    }

    public function show(LandRegister $landRegister)
    {
        return view('land-register.show', compact('landRegister'));
    }

    public function edit(LandRegister $landRegister)
    {
        return view('land-register.edit', compact('landRegister'));
    }

    public function update(Request $request, LandRegister $landRegister)
    {
        $validator = Validator::make($request->all(), [
            'description_of_land' => 'required|string|max:1000',
            'mode_of_acquisition' => 'required|in:purchase,transfer,donation,inheritance,gift,other',
            'category' => 'required|in:land,investment_property',
            'county' => 'required|string|max:255',
            'nearest_town_location' => 'required|string|max:255',
            'gps_coordinates' => 'nullable|string|max:255',
            'polygon_a' => 'nullable|string|max:255',
            'polygon_b' => 'nullable|string|max:255',
            'polygon_c' => 'nullable|string|max:255',
            'polygon_d' => 'nullable|string|max:255',
            'lr_certificate_number' => 'nullable|string|max:255',
            'document_of_ownership' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'proprietorship_details' => 'required|string|max:1000',
            'size_hectares' => 'required|numeric|min:0|max:999999.9999',
            'ownership_status' => 'required|in:freehold,leasehold',
            'acquisition_date' => 'required|date',
            'registration_date' => 'nullable|date|after_or_equal:acquisition_date',
            'disputed_status' => 'required|in:disputed,undisputed',
            'encumbrances' => 'nullable|string|max:1000',
            'planning_status' => 'required|in:planned,unplanned',
            'purpose_use_of_land' => 'required|string|max:1000',
            'survey_status' => 'required|in:surveyed,not_surveyed',
            'acquisition_amount' => 'nullable|numeric|min:0|max:999999999.99',
            'fair_value' => 'nullable|numeric|min:0|max:999999999.99',
            'zonal_maps' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'disposal_date' => 'nullable|date|after_or_equal:acquisition_date',
            'disposal_value' => 'nullable|numeric|min:0|max:999999999.99',
            'annual_rental_income' => 'nullable|numeric|min:0|max:999999999.99',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['document_of_ownership', 'zonal_maps']);

        if ($request->hasFile('document_of_ownership')) {
            if ($landRegister->document_of_ownership_path) {
                Storage::disk('public')->delete($landRegister->document_of_ownership_path);
            }
            $documentPath = $request->file('document_of_ownership')->store('land-register/documents', 'public');
            $data['document_of_ownership_path'] = $documentPath;
        }

        if ($request->hasFile('zonal_maps')) {
            if ($landRegister->zonal_maps_path) {
                Storage::disk('public')->delete($landRegister->zonal_maps_path);
            }
            $zonalMapsPath = $request->file('zonal_maps')->store('land-register/zonal-maps', 'public');
            $data['zonal_maps_path'] = $zonalMapsPath;
        }

        $landRegister->update($data);

        return redirect()->route('land-register.index')->with('success', 'Land register entry updated successfully.');
    }

    public function destroy(LandRegister $landRegister)
    {
        if ($landRegister->document_of_ownership_path) {
            Storage::disk('public')->delete($landRegister->document_of_ownership_path);
        }
        if ($landRegister->zonal_maps_path) {
            Storage::disk('public')->delete($landRegister->zonal_maps_path);
        }

        $landRegister->delete();

        return redirect()->route('land-register.index')->with('success', 'Land register entry deleted successfully.');
    }
}