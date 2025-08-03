<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'location_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the department that the user belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the location that the user belongs to.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the assets assigned to this user.
     */
    public function assignedAssets()
    {
        return $this->hasMany(Asset::class, 'assigned_to');
    }

    /**
     * Get the asset assignments for this user.
     */
    public function assetAssignments()
    {
        return $this->hasMany(AssetAssignment::class, 'assigned_to');
    }

    /**
     * Get the asset transfers requested by this user.
     */
    public function requestedTransfers()
    {
        return $this->hasMany(AssetTransfer::class, 'requested_by');
    }

    /**
     * Get the asset transfers approved by this user.
     */
    public function approvedTransfers()
    {
        return $this->hasMany(AssetTransfer::class, 'approved_by');
    }

    /**
     * Get the maintenance records performed by this user.
     */
    public function maintenanceRecords()
    {
        return $this->hasMany(AssetMaintenance::class, 'performed_by');
    }

    /**
     * Get the status badge class for display.
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-gray-100 text-gray-800',
            'suspended' => 'bg-red-100 text-red-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Check if user is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
}
