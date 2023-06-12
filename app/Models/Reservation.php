<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function logisticsRequest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LogisticsRequest::class, 'logistics_request_id');
    }

    public function staff(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->where('user_id', '>', 0);
    }

    public function task(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Task::class, 'taskable');
    }

    public function consonances(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Consonance::class, 'consonanceable');
    }

    public function upload(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }
}
