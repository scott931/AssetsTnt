<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AssetMaintenance extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'asset_maintenance';

    protected $fillable = [
        'asset_id',
        'performed_by',
        'vendor_id',
        'maintenance_type',
        'title',
        'description',
        'service_date',
        'next_service_due',
        'cost',
        'duration_hours',
        'status',
        'findings',
        'actions_taken',
        'recommendations',
        'parts_used',
        'parts_notes',
        'invoice_path',
        'work_order_path',
        'notes',
    ];

    protected $casts = [
        'service_date' => 'date',
        'next_service_due' => 'date',
        'cost' => 'decimal:2',
        'parts_used' => 'array',
    ];

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['asset_id', 'maintenance_type', 'status', 'service_date', 'cost'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the asset for this maintenance record.
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the user who performed the maintenance.
     */
    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    /**
     * Get the vendor who performed the maintenance.
     */
    public function vendor()
    {
        return $this->belongsTo(Supplier::class, 'vendor_id');
    }

    /**
     * Scope to get only completed maintenance records.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope to get only scheduled maintenance records.
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * Scope to get overdue maintenance records.
     */
    public function scopeOverdue($query)
    {
        return $query->where('next_service_due', '<', now())
            ->where('status', '!=', 'cancelled');
    }

    /**
     * Scope to get upcoming maintenance records.
     */
    public function scopeUpcoming($query, $days = 30)
    {
        return $query->where('next_service_due', '>=', now())
            ->where('next_service_due', '<=', now()->addDays($days))
            ->where('status', '!=', 'cancelled');
    }

    /**
     * Check if the maintenance is overdue.
     */
    public function isOverdue()
    {
        return $this->next_service_due &&
               $this->next_service_due->isPast() &&
               $this->status !== 'cancelled';
    }

    /**
     * Check if the maintenance is upcoming.
     */
    public function isUpcoming($days = 30)
    {
        return $this->next_service_due &&
               $this->next_service_due->isFuture() &&
               $this->next_service_due->diffInDays(now()) <= $days &&
               $this->status !== 'cancelled';
    }

    /**
     * Get the maintenance type options.
     */
    public static function getMaintenanceTypes()
    {
        return [
            'preventive' => 'Preventive Maintenance',
            'corrective' => 'Corrective Maintenance',
            'emergency' => 'Emergency Maintenance',
        ];
    }

    /**
     * Get the status options.
     */
    public static function getStatusOptions()
    {
        return [
            'scheduled' => 'Scheduled',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];
    }

    /**
     * Get the total cost of all maintenance for the asset.
     */
    public function getTotalCostAttribute()
    {
        return $this->asset->maintenanceRecords()->sum('cost');
    }
}
