<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function staff(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function process(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Process::class, 'process_id');
    }

    public function drafts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Draft::class);
    }

    public function trackings(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Tracking::class, 'trackable');
    }

    public function uploads(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
}
