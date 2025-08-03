<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LandRegister extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'region_id',
        'description_of_land',
        'mode_of_acquisition',
        'category',
        'county',
        'nearest_town_location',
        'gps_coordinates',
        'polygon_a',
        'polygon_b',
        'polygon_c',
        'polygon_d',
        'lr_certificate_number',
        'document_of_ownership_path',
        'proprietorship_details',
        'size_hectares',
        'ownership_status',
        'acquisition_date',
        'registration_date',
        'disputed_status',
        'encumbrances',
        'planning_status',
        'purpose_use_of_land',
        'survey_status',
        'acquisition_amount',
        'fair_value',
        'zonal_maps_path',
        'disposal_date',
        'disposal_value',
        'annual_rental_income',
        'remarks',
    ];

    protected $casts = [
        'region_id' => 'integer',
        'acquisition_date' => 'date',
        'registration_date' => 'date',
        'disposal_date' => 'date',
        'size_hectares' => 'decimal:4',
        'acquisition_amount' => 'decimal:2',
        'fair_value' => 'decimal:2',
        'disposal_value' => 'decimal:2',
        'annual_rental_income' => 'decimal:2',
    ];

    // Relationships
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'region_id', 'description_of_land', 'mode_of_acquisition', 'category', 'county',
                'nearest_town_location', 'lr_certificate_number', 'size_hectares',
                'ownership_status', 'acquisition_date', 'disputed_status',
                'acquisition_amount', 'fair_value', 'disposal_value'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the document of ownership file URL.
     */
    public function getDocumentOfOwnershipUrlAttribute()
    {
        return $this->document_of_ownership_path ? asset('storage/' . $this->document_of_ownership_path) : null;
    }

    /**
     * Get the zonal maps file URL.
     */
    public function getZonalMapsUrlAttribute()
    {
        return $this->zonal_maps_path ? asset('storage/' . $this->zonal_maps_path) : null;
    }

    /**
     * Scope to get only active land records (not disposed).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('disposal_date');
    }

    /**
     * Scope to get disposed land records.
     */
    public function scopeDisposed($query)
    {
        return $query->whereNotNull('disposal_date');
    }

    /**
     * Scope to get land records by county.
     */
    public function scopeByCounty($query, $county)
    {
        return $query->where('county', $county);
    }

    /**
     * Scope to get land records by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get disputed land records.
     */
    public function scopeDisputed($query)
    {
        return $query->where('disputed_status', 'disputed');
    }

    /**
     * Scope to get undisputed land records.
     */
    public function scopeUndisputed($query)
    {
        return $query->where('disputed_status', 'undisputed');
    }

    /**
     * Get the total land area in hectares.
     */
    public function getTotalAreaAttribute()
    {
        return $this->size_hectares;
    }

    /**
     * Get the total value of all land records.
     */
    public static function getTotalValue()
    {
        return static::active()->sum('fair_value');
    }

    /**
     * Get the total acquisition cost.
     */
    public static function getTotalAcquisitionCost()
    {
        return static::sum('acquisition_amount');
    }

    /**
     * Get the total annual rental income.
     */
    public static function getTotalAnnualRentalIncome()
    {
        return static::active()->sum('annual_rental_income');
    }

    /**
     * Check if the land record has documents uploaded.
     */
    public function hasDocuments()
    {
        return !empty($this->document_of_ownership_path) || !empty($this->zonal_maps_path);
    }

    /**
     * Get the acquisition mode display name.
     */
    public function getAcquisitionModeDisplayAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->mode_of_acquisition));
    }

    /**
     * Get the category display name.
     */
    public function getCategoryDisplayAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->category));
    }

    /**
     * Get the ownership status display name.
     */
    public function getOwnershipStatusDisplayAttribute()
    {
        return ucfirst($this->ownership_status);
    }

    /**
     * Get the disputed status display name.
     */
    public function getDisputedStatusDisplayAttribute()
    {
        return ucfirst($this->disputed_status);
    }

    /**
     * Get the planning status display name.
     */
    public function getPlanningStatusDisplayAttribute()
    {
        return ucfirst($this->planning_status);
    }

    /**
     * Get the survey status display name.
     */
    public function getSurveyStatusDisplayAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->survey_status));
    }
}