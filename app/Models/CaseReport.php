<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseReport extends Model
{
    protected $fillable = [
        'auto_id',
        'raid_type',
        'document',
        'date',
        'status',
        'location',
        'description',
        'company_id',
        'brand_id',
        'product_id',
        'department_id',
        'sub_department_id',
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
        return $this->belongsTo(SubDepartment::class, 'case_id');
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function case()
    {
        return $this->belongsTo(CaseManagement::class);
    }

    public function investigation()
    {
        return $this->hasOne(Investigation::class, 'company_id', 'company_id');
    }
}
