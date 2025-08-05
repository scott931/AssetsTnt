<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Department;
use App\Models\Location;
use App\Models\LandRegister;
use App\Models\BuildingRegister;
use App\Models\User;
use App\Exports\AssetsExport;
use App\Exports\LandRegisterExport;
use App\Exports\BuildingRegisterExport;
use App\Exports\DepartmentsExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $filters = $request->only([
            'search', 'category_id', 'department_id', 'location_id', 'status',
            'condition', 'supplier_id', 'assigned_to', 'warranty_expiry_from',
            'warranty_expiry_to', 'purchase_date_from', 'purchase_date_to'
        ]);
        $filename = 'assets_register_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new AssetsExport($filters), $filename);
    }

    public function landRegister(Request $request)
    {
        $query = LandRegister::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description_of_land', 'like', "%{$search}%")
                  ->orWhere('county', 'like', "%{$search}%")
                  ->orWhere('nearest_town_location', 'like', "%{$search}%");
            });
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('mode_of_acquisition')) {
            $query->where('mode_of_acquisition', $request->mode_of_acquisition);
        }

        $landRegisters = $query->latest()->paginate(20)->appends($request->query());

        return view('reports.land-register', compact('landRegisters'));
    }

    public function exportLandRegister(Request $request)
    {
        $filters = $request->only(['search', 'category', 'mode_of_acquisition']);
        $filename = 'land_register_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new LandRegisterExport($filters), $filename);
    }

    public function buildingRegister(Request $request)
    {
        $query = BuildingRegister::with('region');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description_name_of_building', 'like', "%{$search}%")
                  ->orWhere('county', 'like', "%{$search}%")
                  ->orWhere('nearest_town_shopping_centre', 'like', "%{$search}%");
            });
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('type_of_building')) {
            $query->where('type_of_building', $request->type_of_building);
        }
        if ($request->filled('designated_use')) {
            $query->where('designated_use', $request->designated_use);
        }
        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        $buildingRegisters = $query->latest()->paginate(20)->appends($request->query());
        $regions = \App\Models\Region::all();

        return view('reports.building-register', compact('buildingRegisters', 'regions'));
    }

    public function exportBuildingRegister(Request $request)
    {
        $filters = $request->only(['search', 'category', 'type_of_building', 'designated_use', 'region_id']);
        $filename = 'building_register_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new BuildingRegisterExport($filters), $filename);
    }

    public function departments(Request $request)
    {
        $query = Department::with('location');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        $departments = $query->latest()->paginate(20)->appends($request->query());
        $locations = \App\Models\Location::all();

        return view('reports.departments', compact('departments', 'locations'));
    }

    public function exportDepartments(Request $request)
    {
        $filters = $request->only(['search', 'status', 'location_id']);
        $filename = 'departments_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new DepartmentsExport($filters), $filename);
    }

    public function users(Request $request)
    {
        $query = User::with(['department', 'location', 'roles']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        $users = $query->latest()->paginate(20)->appends($request->query());
        $departments = \App\Models\Department::all();
        $locations = \App\Models\Location::all();

        return view('reports.users', compact('users', 'departments', 'locations'));
    }

    public function exportUsers(Request $request)
    {
        $filters = $request->only(['search', 'status', 'department_id', 'location_id']);
        $filename = 'users_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new UsersExport($filters), $filename);
    }

    // Legacy CSV export method (keeping for backward compatibility)
    public function exportAssetRegisterCsv(Request $request)
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