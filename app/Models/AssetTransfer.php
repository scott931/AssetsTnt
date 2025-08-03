<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AssetTransfer extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'asset_id',
        'requested_by',
        'approved_by',
        'from_department_id',
        'to_department_id',
        'from_user_id',
        'to_user_id',
        'from_location',
        'to_location',
        'status',
        'requested_at',
        'approved_at',
        'completed_at',
        'request_reason',
        'approval_notes',
        'rejection_reason',
        'transfer_date',
        'transfer_notes',
        'transfer_method',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
        'transfer_date' => 'date',
    ];

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['asset_id', 'status', 'requested_at', 'approved_at', 'completed_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the asset being transferred.
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the user who requested the transfer.
     */
    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * Get the user who approved the transfer.
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the source department.
     */
    public function fromDepartment()
    {
        return $this->belongsTo(Department::class, 'from_department_id');
    }

    /**
     * Get the destination department.
     */
    public function toDepartment()
    {
        return $this->belongsTo(Department::class, 'to_department_id');
    }

    /**
     * Get the source user.
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Get the destination user.
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * Scope to get only pending transfers.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get only approved transfers.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get only completed transfers.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope to get only rejected transfers.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if the transfer is pending.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the transfer is approved.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the transfer is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Check if the transfer is rejected.
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Get the status options.
     */
    public static function getStatusOptions()
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];
    }

    /**
     * Get the transfer method options.
     */
    public static function getTransferMethodOptions()
    {
        return [
            'physical' => 'Physical Transfer',
            'digital' => 'Digital Transfer',
            'shipping' => 'Shipping',
            'pickup' => 'Pickup',
        ];
    }

    /**
     * Get the transfer duration in days.
     */
    public function getTransferDurationAttribute()
    {
        if ($this->completed_at && $this->requested_at) {
            return $this->requested_at->diffInDays($this->completed_at);
        }

        return null;
    }

    /**
     * Get the approval duration in hours.
     */
    public function getApprovalDurationAttribute()
    {
        if ($this->approved_at && $this->requested_at) {
            return $this->requested_at->diffInHours($this->approved_at);
        }

        return null;
    }

    /**
     * The assets involved in this transfer (many-to-many).
     */
    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'asset_transfer_asset');
    }

    /**
     * The approvals for this transfer.
     */
    public function approvals()
    {
        return $this->hasMany(TransferApproval::class);
    }

    /**
     * The audit trail for this transfer.
     */
    public function audits()
    {
        return $this->hasMany(TransferAudit::class);
    }

    /**
     * The user who initiated the transfer.
     */
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    /**
     * The source location.
     */
    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    /**
     * The destination location.
     */
    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }
}
