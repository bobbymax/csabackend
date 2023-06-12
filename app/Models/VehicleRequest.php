<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRequest extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function itineraries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Itinerary::class);
    }

    public function itinerary(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Itinerary::class)->where('chosen', true);
    }

    public function staff(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stockType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StockType::class, 'stock_type_id');
    }

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function task(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Task::class, 'taskable');
    }
}
