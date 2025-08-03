<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'contact_person',
        'email',
        'phone',
        'address',
        'website',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the assets purchased from this supplier.
     */
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    /**
     * Get the maintenance records where this supplier was the vendor.
     */
    public function maintenanceRecords()
    {
        return $this->hasMany(AssetMaintenance::class, 'vendor_id');
    }

    /**
     * Scope to get only active suppliers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the total value of assets purchased from this supplier.
     */
    public function getTotalAssetValueAttribute()
    {
        return $this->assets()->sum('purchase_cost');
    }

    /**
     * Get the total maintenance cost from this supplier.
     */
    public function getTotalMaintenanceCostAttribute()
    {
        return $this->maintenanceRecords()->sum('cost');
    }
}
