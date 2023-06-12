<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function stockCategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StockCategory::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_inventory_category');
    }
}
