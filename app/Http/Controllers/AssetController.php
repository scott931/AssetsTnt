<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Department;
use App\Models\Location;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asset::with(['category', 'department', 'location', 'supplier', 'assignedUser']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('asset_tag', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by department
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        // Filter by location
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by assigned user
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $assets = $query->latest()->paginate(15);
        $categories = AssetCategory::all();
        $departments = Department::all();
        $locations = Location::all();
        $users = User::all();

        return view('assets.index', compact('assets', 'categories', 'departments', 'locations', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = AssetCategory::all();
        $departments = Department::all();
        $locations = Location::all();
        $suppliers = Supplier::all();
        $users = User::all();

        return view('assets.create', compact('categories', 'departments', 'locations', 'suppliers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_tag' => 'required|unique:assets,asset_tag',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:asset_categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'department_id' => 'nullable|exists:departments,id',
            'location_id' => 'nullable|exists:locations,id',
            'assigned_to' => 'nullable|exists:users,id',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric|min:0',
            'purchase_order_number' => 'nullable|string|max:255',
            'warranty_expiry' => 'nullable|date',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'condition' => 'required|in:excellent,good,fair,poor,damaged',
            'depreciation_rate' => 'nullable|numeric|min:0|max:100',
            'depreciation_method' => 'required|in:straight_line,declining_balance',
            'depreciation_start_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'manual' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->all();

        // Guarantee depreciation_rate is always set
        if (!isset($data['depreciation_rate']) || $data['depreciation_rate'] === null) {
            $data['depreciation_rate'] = 0;
        }

        // Handle file uploads
        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('assets/photos', 'public');
        }

        if ($request->hasFile('manual')) {
            $data['manual_path'] = $request->file('manual')->store('assets/manuals', 'public');
        }

        if ($request->hasFile('receipt')) {
            $data['receipt_path'] = $request->file('receipt')->store('assets/receipts', 'public');
        }

        // Set default values
        $data['status'] = 'active';
        $data['current_value'] = $data['purchase_cost'] ?? 0;

        Asset::create($data);

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        $asset->load(['category', 'department', 'location', 'supplier', 'assignedUser', 'assignments', 'maintenanceRecords', 'transfers']);

        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $categories = AssetCategory::all();
        $departments = Department::all();
        $locations = Location::all();
        $suppliers = Supplier::all();
        $users = User::all();

        return view('assets.edit', compact('asset', 'categories', 'departments', 'locations', 'suppliers', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_tag' => 'required|unique:assets,asset_tag,' . $asset->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:asset_categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'department_id' => 'nullable|exists:departments,id',
            'location_id' => 'nullable|exists:locations,id',
            'assigned_to' => 'nullable|exists:users,id',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric|min:0',
            'purchase_order_number' => 'nullable|string|max:255',
            'warranty_expiry' => 'nullable|date',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'condition' => 'required|in:excellent,good,fair,poor,damaged',
            'status' => 'required|in:active,inactive,maintenance,retired,lost,damaged',
            'depreciation_rate' => 'nullable|numeric|min:0|max:100',
            'depreciation_method' => 'required|in:straight_line,declining_balance',
            'depreciation_start_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'manual' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($asset->photo_path) {
                Storage::disk('public')->delete($asset->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('assets/photos', 'public');
        }

        if ($request->hasFile('manual')) {
            if ($asset->manual_path) {
                Storage::disk('public')->delete($asset->manual_path);
            }
            $data['manual_path'] = $request->file('manual')->store('assets/manuals', 'public');
        }

        if ($request->hasFile('receipt')) {
            if ($asset->receipt_path) {
                Storage::disk('public')->delete($asset->receipt_path);
            }
            $data['receipt_path'] = $request->file('receipt')->store('assets/receipts', 'public');
        }

        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        // Delete associated files
        if ($asset->photo_path) {
            Storage::disk('public')->delete($asset->photo_path);
        }
        if ($asset->manual_path) {
            Storage::disk('public')->delete($asset->manual_path);
        }
        if ($asset->receipt_path) {
            Storage::disk('public')->delete($asset->receipt_path);
        }

        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }

    /**
     * Generate QR code for asset
     */
    public function qrCode(Asset $asset)
    {
        $qrCode = \QrCode::size(300)->generate($asset->asset_tag);

        return response($qrCode)
            ->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Export assets to CSV
     */
    public function export(Request $request)
    {
        $query = Asset::with(['category', 'department', 'supplier', 'assignedUser']);

        // Apply filters
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $assets = $query->get();

        $filename = 'assets_' . date('Y-m-d_H-i-s') . '.csv';

        return response()->streamDownload(function () use ($assets) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, [
                'Asset Tag', 'Name', 'Category', 'Department', 'Assigned To',
                'Status', 'Purchase Date', 'Purchase Cost', 'Current Value',
                'Location', 'Condition', 'Serial Number', 'Manufacturer'
            ]);

            // CSV data
            foreach ($assets as $asset) {
                fputcsv($file, [
                    $asset->asset_tag,
                    $asset->name,
                    $asset->category->name ?? '',
                    $asset->department->name ?? '',
                    $asset->assignedUser->name ?? '',
                    $asset->status,
                    $asset->purchase_date,
                    $asset->purchase_cost,
                    $asset->current_value,
                    $asset->location,
                    $asset->condition,
                    $asset->serial_number,
                    $asset->manufacturer
                ]);
            }

            fclose($file);
        }, $filename);
    }
}
