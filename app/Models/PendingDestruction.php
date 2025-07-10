<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingDestruction extends Model
{
    protected $fillable = [
        'auto_id',
        'raid_type',
        'date',
        'status',
        'location',
        'description',
        'department_id',
        'sub_department_id',
        'company_id',
        'brand_id',
        'product_id',
        'group_id',
        'case_id',
    ];

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
        return $this->belongsTo(CaseManagement::class, 'case_id');
    }
}
