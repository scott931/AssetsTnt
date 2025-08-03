<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'budget',
        'head_user_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'budget' => 'decimal:2',
    ];

    /**
     * Get the head of the department.
     */
    public function headUser()
    {
        return $this->belongsTo(User::class, 'head_user_id');
    }

    /**
     * Get the users in this department.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the assets in this department.
     */
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    /**
     * Get the asset transfers from this department.
     */
    public function transfersFrom()
    {
        return $this->hasMany(AssetTransfer::class, 'from_department_id');
    }

    /**
     * Get the asset transfers to this department.
     */
    public function transfersTo()
    {
        return $this->hasMany(AssetTransfer::class, 'to_department_id');
    }

    /**
     * Scope to get only active departments.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
