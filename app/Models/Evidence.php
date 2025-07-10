<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    public function images()
    {
        return $this->hasMany(EvidenceImage::class);
    }

    public function case()
    {
        return $this->belongsTo(CaseManagement::class, 'case_id');
    }
}
