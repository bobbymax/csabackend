<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function approvals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Approval::class);
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DepartmentType::class, 'department_type_id');
    }

    public function staff(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function floors(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Floor::class, 'floorable');
    }

    public function tickets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function incidentCategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(IncidentCategory::class);
    }

    public function inventoryCategories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(InventoryCategory::class, 'department_inventory_category');
    }

    public function documents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function drafts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Draft::class);
    }
}
