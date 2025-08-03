<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Department;
use App\Models\Location;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function assetRegister(Request $request)
    {
        $query = Asset::with(['category', 'department', 'location', 'supplier', 'assignedUser']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('asset_tag', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }
        if ($request->filled('warranty_expiry_from')) {
            $query->whereDate('warranty_expiry', '>=', $request->warranty_expiry_from);
        }
        if ($request->filled('warranty_expiry_to')) {
            $query->whereDate('warranty_expiry', '<=', $request->warranty_expiry_to);
        }
        if ($request->filled('purchase_date_from')) {
            $query->whereDate('purchase_date', '>=', $request->purchase_date_from);
        }
        if ($request->filled('purchase_date_to')) {
            $query->whereDate('purchase_date', '<=', $request->purchase_date_to);
        }

        $assets = $query->latest()->paginate(20)->appends($request->query());
        $categories = \App\Models\AssetCategory::all();
        $departments = \App\Models\Department::all();
        $locations = \App\Models\Location::all();
        $suppliers = \App\Models\Supplier::all();
        $users = \App\Models\User::all();

        return view('reports.asset-register', compact('assets', 'categories', 'departments', 'locations', 'suppliers', 'users'));
    }

    public function exportAssetRegister(Request $request)
    {
        $query = Asset::with(['category', 'department', 'location', 'supplier', 'assignedUser']);
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }
        if ($request->filled('warranty_expiry_from')) {
            $query->whereDate('warranty_expiry', '>=', $request->warranty_expiry_from);
        }
        if ($request->filled('warranty_expiry_to')) {
            $query->whereDate('warranty_expiry', '<=', $request->warranty_expiry_to);
        }
        if ($request->filled('purchase_date_from')) {
            $query->whereDate('purchase_date', '>=', $request->purchase_date_from);
        }
        if ($request->filled('purchase_date_to')) {
            $query->whereDate('purchase_date', '<=', $request->purchase_date_to);
        }
        $assets = $query->get();
        $filename = 'asset_register_' . date('Y-m-d_H-i-s') . '.csv';
        return response()->streamDownload(function () use ($assets) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Asset Tag', 'Name', 'Category', 'Department', 'Location', 'Status', 'Current Value',
                'Purchase Date', 'Purchase Cost', 'Warranty Expiry', 'Model', 'Serial Number', 'Manufacturer',
                'Condition', 'Supplier', 'Assigned User', 'Description'
            ]);
            foreach ($assets as $asset) {
                fputcsv($file, [
                    $asset->asset_tag,
                    $asset->name,
                    $asset->category->name ?? '',
                    $asset->department->name ?? '',
                    $asset->location->name ?? '',
                    $asset->status,
                    $asset->current_value,
                    $asset->purchase_date,
                    $asset->purchase_cost,
                    $asset->warranty_expiry,
                    $asset->model,
                    $asset->serial_number,
                    $asset->manufacturer,
                    $asset->condition,
                    $asset->supplier->name ?? '',
                    $asset->assignedUser->name ?? '',
                    $asset->description,
                ]);
            }
            fclose($file);
        }, $filename);
    }
}