<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Department;
use App\Models\User;
use App\Models\AssetMaintenance;
use App\Models\AssetAssignment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $totalAssets = Asset::count();
        $activeAssets = Asset::where('status', 'active')->count();
        $totalCategories = AssetCategory::count();
        $totalDepartments = Department::count();
        $totalUsers = User::count();

        // Get assets by category
        $assetsByCategory = AssetCategory::withCount('assets')->get();

        // Get recent assets
        $recentAssets = Asset::with(['category', 'department', 'assignedUser'])
            ->latest()
            ->take(5)
            ->get();

        // Get upcoming maintenance
        $upcomingMaintenance = AssetMaintenance::with('asset')
            ->where('next_service_due', '>=', now())
            ->where('next_service_due', '<=', now()->addDays(30))
            ->where('status', '!=', 'cancelled')
            ->orderBy('next_service_due')
            ->take(5)
            ->get();

        // Get overdue assignments
        $overdueAssignments = AssetAssignment::with(['asset', 'assignedUser'])
            ->where('status', 'active')
            ->where('expected_return_at', '<', now())
            ->take(5)
            ->get();

        // Get top depreciating assets
        $topDepreciatingAssets = Asset::where('purchase_cost', '>', 0)
            ->orderBy('depreciation_rate', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalAssets',
            'activeAssets',
            'totalCategories',
            'totalDepartments',
            'totalUsers',
            'assetsByCategory',
            'recentAssets',
            'upcomingMaintenance',
            'overdueAssignments',
            'topDepreciatingAssets'
        ));
    }
}
