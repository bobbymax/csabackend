<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function group(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Group::class, 'group_id');
    }

    public function module(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Module::class, 'module_id');
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'access_control_permission');
    }
}
