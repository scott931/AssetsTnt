<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BuildingRegister extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'region_id',
        'description_name_of_building',
        'building_ownership',
        'category',
        'building_number',
        'institution_number',
        'nearest_town_shopping_centre',
        'street',
        'county',
        'lr_number',
        'size_of_land_hectares',
        'ownership_status',
        'source_of_funds',
        'mode_of_acquisition',
        'date_of_purchase_commissioning',
        'type_of_building',
        'designated_use',
        'estimated_useful_life_years',
        'number_of_floors',
        'plinth_area_sqm',
        'cost_of_construction_valuation',
        'annual_depreciation',
        'accumulated_depreciation_to_date',
        'net_book_value',
        'annual_rental_income',
        'remarks',
        'building_plans_path',
        'certificate_of_occupancy_path',
        'valuation_report_path',
    ];

    protected $casts = [
        'region_id' => 'integer',
        'date_of_purchase_commissioning' => 'date',
        'size_of_land_hectares' => 'decimal:4',
        'plinth_area_sqm' => 'decimal:2',
        'cost_of_construction_valuation' => 'decimal:2',
        'annual_depreciation' => 'decimal:2',
        'accumulated_depreciation_to_date' => 'decimal:2',
        'net_book_value' => 'decimal:2',
        'annual_rental_income' => 'decimal:2',
        'estimated_useful_life_years' => 'integer',
        'number_of_floors' => 'integer',
    ];

    // Relationships
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'region_id', 'description_name_of_building',
                'building_ownership',
                'category',
                'building_number',
                'institution_number',
                'nearest_town_shopping_centre',
                'street',
                'county',
                'lr_number',
                'size_of_land_hectares',
                'ownership_status',
                'source_of_funds',
                'mode_of_acquisition',
                'date_of_purchase_commissioning',
                'type_of_building',
                'designated_use',
                'estimated_useful_life_years',
                'number_of_floors',
                'plinth_area_sqm',
                'cost_of_construction_valuation',
                'annual_depreciation',
                'accumulated_depreciation_to_date',
                'net_book_value',
                'annual_rental_income',
                'remarks',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the building plans file URL.
     */
    public function getBuildingPlansUrlAttribute()
    {
        return $this->building_plans_path ? asset('storage/' . $this->building_plans_path) : null;
    }

    /**
     * Get the certificate of occupancy file URL.
     */
    public function getCertificateOfOccupancyUrlAttribute()
    {
        return $this->certificate_of_occupancy_path ? asset('storage/' . $this->certificate_of_occupancy_path) : null;
    }

    /**
     * Get the valuation report file URL.
     */
    public function getValuationReportUrlAttribute()
    {
        return $this->valuation_report_path ? asset('storage/' . $this->valuation_report_path) : null;
    }

    /**
     * Scope to get only active building records.
     */
    public function scopeActive($query)
    {
        return $query->where('net_book_value', '>', 0);
    }

    /**
     * Scope to get building records by county.
     */
    public function scopeByCounty($query, $county)
    {
        return $query->where('county', $county);
    }

    /**
     * Scope to get building records by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get permanent buildings.
     */
    public function scopePermanent($query)
    {
        return $query->where('type_of_building', 'permanent');
    }

    /**
     * Scope to get temporary buildings.
     */
    public function scopeTemporary($query)
    {
        return $query->where('type_of_building', 'temporary');
    }

    /**
     * Get the total building area in square meters.
     */
    public function getTotalAreaAttribute()
    {
        return $this->plinth_area_sqm;
    }

    /**
     * Get the total value of all building records.
     */
    public static function getTotalValue()
    {
        return static::active()->sum('net_book_value');
    }

    /**
     * Get the total construction cost.
     */
    public static function getTotalConstructionCost()
    {
        return static::sum('cost_of_construction_valuation');
    }

    /**
     * Get the total annual rental income.
     */
    public static function getTotalAnnualRentalIncome()
    {
        return static::active()->sum('annual_rental_income');
    }

    /**
     * Check if the building record has documents uploaded.
     */
    public function hasDocuments()
    {
        return !empty($this->building_plans_path) ||
               !empty($this->certificate_of_occupancy_path) ||
               !empty($this->valuation_report_path);
    }

    /**
     * Get the category display name.
     */
    public function getCategoryDisplayAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->category));
    }

    /**
     * Get the ownership status display name.
     */
    public function getOwnershipStatusDisplayAttribute()
    {
        return ucwords($this->ownership_status);
    }

    /**
     * Get the mode of acquisition display name.
     */
    public function getModeOfAcquisitionDisplayAttribute()
    {
        return ucwords($this->mode_of_acquisition);
    }

    /**
     * Get the type of building display name.
     */
    public function getTypeOfBuildingDisplayAttribute()
    {
        return ucwords($this->type_of_building);
    }

    /**
     * Calculate the current age of the building.
     */
    public function getBuildingAgeAttribute()
    {
        return $this->date_of_purchase_commissioning ?
               $this->date_of_purchase_commissioning->diffInYears(now()) : 0;
    }

    /**
     * Calculate the remaining useful life.
     */
    public function getRemainingUsefulLifeAttribute()
    {
        return max(0, $this->estimated_useful_life_years - $this->building_age);
    }

    /**
     * Calculate the depreciation rate.
     */
    public function getDepreciationRateAttribute()
    {
        return $this->estimated_useful_life_years > 0 ?
               (100 / $this->estimated_useful_life_years) : 0;
    }
}
