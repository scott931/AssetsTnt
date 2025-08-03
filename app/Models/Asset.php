<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'asset_tag',
        'name',
        'description',
        'category_id',
        'supplier_id',
        'department_id',
        'location_id',
        'assigned_to',
        'purchase_date',
        'purchase_cost',
        'purchase_order_number',
        'warranty_expiry',
        'model',
        'serial_number',
        'manufacturer',
        'location',
        'condition',
        'current_value',
        'depreciation_rate',
        'depreciation_method',
        'depreciation_start_date',
        'status',
        'retirement_date',
        'retirement_reason',
        'photo_path',
        'manual_path',
        'receipt_path',
        'specifications',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
        'depreciation_start_date' => 'date',
        'retirement_date' => 'date',
        'purchase_cost' => 'decimal:2',
        'current_value' => 'decimal:2',
        'depreciation_rate' => 'decimal:2',
        'specifications' => 'array',
    ];

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name', 'description', 'category_id', 'supplier_id', 'department_id',
                'assigned_to', 'location', 'condition', 'status', 'current_value'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the location of the asset.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the category of the asset.
     */
    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'category_id');
    }

    /**
     * Get the supplier of the asset.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the department of the asset.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the user assigned to the asset.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the asset assignments.
     */
    public function assignments()
    {
        return $this->hasMany(AssetAssignment::class);
    }

    /**
     * Get the current active assignment.
     */
    public function currentAssignment()
    {
        return $this->hasOne(AssetAssignment::class)->where('status', 'active');
    }

    /**
     * Get the maintenance records for the asset.
     */
    public function maintenanceRecords()
    {
        return $this->hasMany(AssetMaintenance::class);
    }

    /**
     * Get the upcoming maintenance records.
     */
    public function upcomingMaintenance()
    {
        return $this->hasMany(AssetMaintenance::class)
            ->where('next_service_due', '>=', now())
            ->where('status', '!=', 'cancelled');
    }

    /**
     * Get the asset transfers.
     */
    public function transfers()
    {
        return $this->belongsToMany(AssetTransfer::class, 'asset_transfer_asset');
    }

    /**
     * Get the pending transfers.
     */
    public function pendingTransfers()
    {
        return $this->hasMany(AssetTransfer::class)->where('status', 'pending');
    }

    /**
     * Scope to get only active assets.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get assets by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get assets by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope to get assets by department.
     */
    public function scopeByDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Scope to get assets assigned to a user.
     */
    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    /**
     * Calculate the current depreciated value.
     */
    public function calculateCurrentValue()
    {
        if (!$this->purchase_cost || !$this->depreciation_start_date) {
            return $this->purchase_cost;
        }

        $yearsSincePurchase = now()->diffInYears($this->depreciation_start_date);

        if ($this->depreciation_method === 'straight_line') {
            $annualDepreciation = $this->purchase_cost * ($this->depreciation_rate / 100);
            $totalDepreciation = $annualDepreciation * $yearsSincePurchase;
            return max(0, $this->purchase_cost - $totalDepreciation);
        } else {
            // Declining balance method
            $rate = $this->depreciation_rate / 100;
            return $this->purchase_cost * pow((1 - $rate), $yearsSincePurchase);
        }
    }

    /**
     * Check if the asset is overdue for maintenance.
     */
    public function isOverdueForMaintenance()
    {
        return $this->upcomingMaintenance()
            ->where('next_service_due', '<', now())
            ->exists();
    }

    /**
     * Check if the asset is available for assignment.
     */
    public function isAvailable()
    {
        return $this->status === 'active' && !$this->currentAssignment()->exists();
    }

    /**
     * Get the QR code for the asset.
     */
    public function getQrCodeAttribute()
    {
        return \QrCode::size(200)->generate($this->asset_tag);
    }

    /**
     * Get the asset's age in years.
     */
    public function getAgeAttribute()
    {
        return $this->purchase_date ? now()->diffInYears($this->purchase_date) : 0;
    }

    /**
     * Get the asset's total maintenance cost.
     */
    public function getTotalMaintenanceCostAttribute()
    {
        return $this->maintenanceRecords()->sum('cost');
    }
}
