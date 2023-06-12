<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function hall(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HallCategory::class, 'hall_category_id');
    }

    public function wing(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Wing::class, 'wing_id');
    }

    public function floor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Floor::class, 'floor_id')->where('floor_id', '>', 0);
    }

    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function uploads(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
}
