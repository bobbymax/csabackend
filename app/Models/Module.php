<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function application(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function approvals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Approval::class);
    }

    public function groups(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Group::class, 'groupable');
    }

    public function departments(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Department::class, 'departmentable');
    }

    public function canBeAccessedBy(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccessControl::class);
    }
}
