<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
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
    public function case()
    {
        return $this->belongsTo(CaseManagement::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
