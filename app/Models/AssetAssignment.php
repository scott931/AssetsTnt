<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AssetAssignment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'asset_id',
        'assigned_to',
        'assigned_by',
        'department_id',
        'assigned_at',
        'expected_return_at',
        'returned_at',
        'returned_to',
        'status',
        'assignment_notes',
        'return_notes',
        'assigned_location',
        'returned_location',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'expected_return_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['asset_id', 'assigned_to', 'status', 'assigned_at', 'returned_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the asset for this assignment.
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the user assigned to the asset.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the user who made the assignment.
     */
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Get the user who received the return.
     */
    public function returnedTo()
    {
        return $this->belongsTo(User::class, 'returned_to');
    }

    /**
     * Get the department for this assignment.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Scope to get only active assignments.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get only returned assignments.
     */
    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

    /**
     * Scope to get overdue assignments.
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'active')
            ->where('expected_return_at', '<', now());
    }

    /**
     * Check if the assignment is overdue.
     */
    public function isOverdue()
    {
        return $this->status === 'active' &&
               $this->expected_return_at &&
               $this->expected_return_at->isPast();
    }

    /**
     * Check if the assignment is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get the duration of the assignment in days.
     */
    public function getDurationInDaysAttribute()
    {
        if ($this->returned_at) {
            return $this->assigned_at->diffInDays($this->returned_at);
        }

        return $this->assigned_at->diffInDays(now());
    }

    /**
     * Get the days until expected return.
     */
    public function getDaysUntilReturnAttribute()
    {
        if (!$this->expected_return_at) {
            return null;
        }

        return now()->diffInDays($this->expected_return_at, false);
    }
}
