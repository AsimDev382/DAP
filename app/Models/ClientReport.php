<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientReport extends Model
{
    protected $fillable = [
        'auto_id',
        'client_id',
        'client_name',
        'raid_type',
        'document',
        'total_amount',
        'payed_amount',
        'balance',
        'date',
        'status',
        'location',
        'description',
        'user_id',
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
