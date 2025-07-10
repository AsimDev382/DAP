<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'auto_id',
        'client_id',
        'case_id',
        'case_type',
        'target_category',
        'case_priority',
        'advance_fee',
        'case_expense',
        'total_amount',
        'case_location',
        'start_date',
        'end_date',
        'status',
        'desbursement',
        'company_id',
        'brand_id',
        'product_id',
        'currency_id',
        'user_id',
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
    public function cases()
    {
        return $this->belongsTo(CaseManagement::class, 'case_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'company_id', 'company_id');
    }

}
