<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Region extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'code',
        'description',
        'headquarters',
        'contact_person',
        'contact_email',
        'contact_phone',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relationships
    public function landRegisters()
    {
        return $this->hasMany(LandRegister::class);
    }

    public function buildingRegisters()
    {
        return $this->hasMany(BuildingRegister::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    // Accessors
    public function getTotalLandAssetsAttribute()
    {
        return $this->landRegisters()->count();
    }

    public function getTotalBuildingAssetsAttribute()
    {
        return $this->buildingRegisters()->count();
    }

    public function getTotalAssetsAttribute()
    {
        return $this->total_land_assets + $this->total_building_assets;
    }

    public function getTotalLandValueAttribute()
    {
        return $this->landRegisters()->sum('fair_value');
    }

    public function getTotalBuildingValueAttribute()
    {
        return $this->buildingRegisters()->sum('net_book_value');
    }

    public function getTotalAssetValueAttribute()
    {
        return $this->total_land_value + $this->total_building_value;
    }

    public function getTotalLocationsAttribute()
    {
        return $this->locations()->count();
    }

    public function getActiveLocationsAttribute()
    {
        return $this->locations()->where('is_active', true)->count();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name', 'code', 'description', 'headquarters',
                'contact_person', 'contact_email', 'contact_phone', 'status'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
