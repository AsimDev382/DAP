<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaidPlaining extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function cases()
    {
        return $this->hasOne(CaseManagement::class, 'product_id', 'product_id');
    }
}
