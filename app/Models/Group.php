<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function approvals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Approval::class);
    }

    public function staff(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(User::class, 'groupable');
    }

    public function applications(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Application::class, 'groupable');
    }

    public function modules(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Module::class, 'groupable');
    }

    public function canAccess(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccessControl::class);
    }

    public function settings(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Setting::class, 'groupable');
    }
}
