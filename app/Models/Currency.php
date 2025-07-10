<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'currency_name',
        'symbol',
        'country_name',
        'country_code',
    ];
    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }
}
