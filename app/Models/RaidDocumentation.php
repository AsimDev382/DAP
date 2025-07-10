<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaidDocumentation extends Model
{
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
    public function case()
    {
        return $this->belongsTo(CaseManagement::class);
    }
}
