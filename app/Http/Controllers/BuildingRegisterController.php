<?php

namespace App\Http\Controllers;

use App\Models\BuildingRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BuildingRegisterController extends Controller
{
    public function index()
    {
        $buildingRegisters = BuildingRegister::latest()->paginate(10);
        return view('building-register.index', compact('buildingRegisters'));
    }

    public function create()
    {
        return view('building-register.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description_name_of_building' => 'required|string|max:1000',
            'building_ownership' => 'required|string|max:1000',
            'category' => 'required|in:building,investment_property',
            'building_number' => 'nullable|string|max:255',
            'institution_number' => 'nullable|string|max:255',
            'nearest_town_shopping_centre' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'lr_number' => 'nullable|string|max:255',
            'size_of_land_hectares' => 'required|numeric|min:0|max:999999.9999',
            'ownership_status' => 'required|in:freehold,leasehold',
            'source_of_funds' => 'required|string|max:255',
            'mode_of_acquisition' => 'required|in:purchase,construction,donation,inheritance,gift,other',
            'date_of_purchase_commissioning' => 'required|date',
            'type_of_building' => 'required|in:permanent,temporary',
            'designated_use' => 'required|string|max:1000',
            'estimated_useful_life_years' => 'required|integer|min:1|max:200',
            'number_of_floors' => 'required|integer|min:1|max:200',
            'plinth_area_sqm' => 'required|numeric|min:0|max:999999.99',
            'cost_of_construction_valuation' => 'required|numeric|min:0|max:999999999.99',
            'annual_depreciation' => 'required|numeric|min:0|max:999999999.99',
            'accumulated_depreciation_to_date' => 'required|numeric|min:0|max:999999999.99',
            'net_book_value' => 'required|numeric|min:0|max:999999999.99',
            'annual_rental_income' => 'nullable|numeric|min:0|max:999999999.99',
            'remarks' => 'nullable|string|max:1000',
            'building_plans' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'certificate_of_occupancy' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'valuation_report' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['building_plans', 'certificate_of_occupancy', 'valuation_report']);

        // Handle file uploads
        if ($request->hasFile('building_plans')) {
            $buildingPlansPath = $request->file('building_plans')->store('building-register/plans', 'public');
            $data['building_plans_path'] = $buildingPlansPath;
        }

        if ($request->hasFile('certificate_of_occupancy')) {
            $certificatePath = $request->file('certificate_of_occupancy')->store('building-register/certificates', 'public');
            $data['certificate_of_occupancy_path'] = $certificatePath;
        }

        if ($request->hasFile('valuation_report')) {
            $valuationPath = $request->file('valuation_report')->store('building-register/valuations', 'public');
            $data['valuation_report_path'] = $valuationPath;
        }

        BuildingRegister::create($data);

        return redirect()->route('building-register.index')->with('success', 'Building register entry created successfully.');
    }

    public function show(BuildingRegister $buildingRegister)
    {
        return view('building-register.show', compact('buildingRegister'));
    }

    public function edit(BuildingRegister $buildingRegister)
    {
        return view('building-register.edit', compact('buildingRegister'));
    }

    public function update(Request $request, BuildingRegister $buildingRegister)
    {
        $validator = Validator::make($request->all(), [
            'description_name_of_building' => 'required|string|max:1000',
            'building_ownership' => 'required|string|max:1000',
            'category' => 'required|in:building,investment_property',
            'building_number' => 'nullable|string|max:255',
            'institution_number' => 'nullable|string|max:255',
            'nearest_town_shopping_centre' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'lr_number' => 'nullable|string|max:255',
            'size_of_land_hectares' => 'required|numeric|min:0|max:999999.9999',
            'ownership_status' => 'required|in:freehold,leasehold',
            'source_of_funds' => 'required|string|max:255',
            'mode_of_acquisition' => 'required|in:purchase,construction,donation,inheritance,gift,other',
            'date_of_purchase_commissioning' => 'required|date',
            'type_of_building' => 'required|in:permanent,temporary',
            'designated_use' => 'required|string|max:1000',
            'estimated_useful_life_years' => 'required|integer|min:1|max:200',
            'number_of_floors' => 'required|integer|min:1|max:200',
            'plinth_area_sqm' => 'required|numeric|min:0|max:999999.99',
            'cost_of_construction_valuation' => 'required|numeric|min:0|max:999999999.99',
            'annual_depreciation' => 'required|numeric|min:0|max:999999999.99',
            'accumulated_depreciation_to_date' => 'required|numeric|min:0|max:999999999.99',
            'net_book_value' => 'required|numeric|min:0|max:999999999.99',
            'annual_rental_income' => 'nullable|numeric|min:0|max:999999999.99',
            'remarks' => 'nullable|string|max:1000',
            'building_plans' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'certificate_of_occupancy' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'valuation_report' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['building_plans', 'certificate_of_occupancy', 'valuation_report']);

        // Handle file uploads
        if ($request->hasFile('building_plans')) {
            // Delete old file if exists
            if ($buildingRegister->building_plans_path) {
                Storage::disk('public')->delete($buildingRegister->building_plans_path);
            }
            $buildingPlansPath = $request->file('building_plans')->store('building-register/plans', 'public');
            $data['building_plans_path'] = $buildingPlansPath;
        }

        if ($request->hasFile('certificate_of_occupancy')) {
            // Delete old file if exists
            if ($buildingRegister->certificate_of_occupancy_path) {
                Storage::disk('public')->delete($buildingRegister->certificate_of_occupancy_path);
            }
            $certificatePath = $request->file('certificate_of_occupancy')->store('building-register/certificates', 'public');
            $data['certificate_of_occupancy_path'] = $certificatePath;
        }

        if ($request->hasFile('valuation_report')) {
            // Delete old file if exists
            if ($buildingRegister->valuation_report_path) {
                Storage::disk('public')->delete($buildingRegister->valuation_report_path);
            }
            $valuationPath = $request->file('valuation_report')->store('building-register/valuations', 'public');
            $data['valuation_report_path'] = $valuationPath;
        }

        $buildingRegister->update($data);

        return redirect()->route('building-register.index')->with('success', 'Building register entry updated successfully.');
    }

    public function destroy(BuildingRegister $buildingRegister)
    {
        // Delete associated files
        if ($buildingRegister->building_plans_path) {
            Storage::disk('public')->delete($buildingRegister->building_plans_path);
        }
        if ($buildingRegister->certificate_of_occupancy_path) {
            Storage::disk('public')->delete($buildingRegister->certificate_of_occupancy_path);
        }
        if ($buildingRegister->valuation_report_path) {
            Storage::disk('public')->delete($buildingRegister->valuation_report_path);
        }

        $buildingRegister->delete();

        return redirect()->route('building-register.index')->with('success', 'Building register entry deleted successfully.');
    }
}
