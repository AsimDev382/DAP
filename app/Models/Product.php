<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function investigation()
    {
        return $this->hasMany(Investigation::class);
    }
    public function case()
    {
        return $this->hasMany(CaseManagement::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
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

}
