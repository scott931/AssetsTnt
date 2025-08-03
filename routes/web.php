<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\LandRegisterController;
use App\Http\Controllers\BuildingRegisterController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Assets
    Route::resource('assets', AssetController::class);
    Route::get('/assets/{asset}/qr-code', [AssetController::class, 'qrCode'])->name('assets.qr-code');
    Route::get('/assets/export', [AssetController::class, 'export'])->name('assets.export');

    // Categories
    Route::resource('categories', CategoryController::class);
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Departments
    Route::resource('departments', DepartmentController::class);

    // Locations
    Route::resource('locations', LocationController::class);

    // Suppliers
    Route::resource('suppliers', SupplierController::class);

    // Users
    Route::resource('users', UserController::class);

    // Maintenance (placeholder routes)
    Route::get('/maintenance', function () {
        return view('maintenance.index');
    })->name('maintenance.index');

    // Transfers (placeholder routes)
    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');
    Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');
    Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
    Route::get('/transfers/{transfer}', [TransferController::class, 'show'])->name('transfers.show');
    Route::post('/transfers/{transfer}/approve', [TransferController::class, 'approve'])->name('transfers.approve');
    Route::post('/transfers/{transfer}/reject', [TransferController::class, 'reject'])->name('transfers.reject');

    // Reports
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/reports/asset-register', [ReportsController::class, 'assetRegister'])->name('reports.asset-register');
    Route::get('/reports/asset-register/export', [ReportsController::class, 'exportAssetRegister'])->name('reports.asset-register.export');

    // Audit Logs (placeholder routes)
    Route::get('/audit-logs', function () {
        return view('audit-logs.index');
    })->name('audit-logs.index');

                // Regions
            Route::resource('regions', RegionController::class);
            Route::get('regions/{region}/report', [RegionController::class, 'report'])->name('regions.report');

            // Land Register
            Route::resource('land-register', LandRegisterController::class);

            // Building Register
            Route::resource('building-register', BuildingRegisterController::class);

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/user/{user}/role', [SettingsController::class, 'updateRole'])->name('settings.user.role');
    Route::post('/settings/user/{user}/password', [SettingsController::class, 'updatePassword'])->name('settings.user.password');
    Route::post('/settings/user/{user}/status', [SettingsController::class, 'updateStatus'])->name('settings.user.status');
    Route::post('/settings/user/{user}/update', [SettingsController::class, 'updateUser'])->name('settings.user.update');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
