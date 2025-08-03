<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'parent_id',
        'expected_lifespan_years',
        'depreciation_rate',
        'is_active',
    ];

    protected $casts = [
        'depreciation_rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo(AssetCategory::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children()
    {
        return $this->hasMany(AssetCategory::class, 'parent_id');
    }

    /**
     * Get all descendants (children, grandchildren, etc.).
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * Get all ancestors (parent, grandparent, etc.).
     */
    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    /**
     * Get the assets in this category.
     */
    public function assets()
    {
        return $this->hasMany(Asset::class, 'category_id');
    }

    /**
     * Scope to get only active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only root categories (no parent).
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Get the full category path as a string.
     */
    public function getFullPathAttribute()
    {
        $path = [$this->name];
        $parent = $this->parent;

        while ($parent) {
            array_unshift($path, $parent->name);
            $parent = $parent->parent;
        }

        return implode(' > ', $path);
    }
}
