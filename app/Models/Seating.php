<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function upload(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }
}
