<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function investigation()
    {
        return $this->hasMany(Investigation::class);
    }

    public function case()
    {
        return $this->hasMany(CaseManagement::class, 'brand_id');
    }
    public function raidPlaining()
    {
        return $this->hasMany(RaidPlaining::class);
    }

    public function pendingDestruct()
    {
        return $this->hasMany(PendingDestruction::class);
    }
    public function completedDestruct()
    {
        return $this->hasMany(CompletedDestruction::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }
}
