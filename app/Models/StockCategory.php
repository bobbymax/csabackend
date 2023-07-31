<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function image(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InventoryCategory::class, 'inventory_category_id');
    }

    public function stocks(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Stock::class, StockType::class);
    }

    public function types(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StockType::class);
    }
}
