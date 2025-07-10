<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
