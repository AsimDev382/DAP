<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class);
    }
    public function company()
    {
        return $this->belongsTo(company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function assignTask()
    {
        return $this->hasMany(AssignTask::class);
    }
    public function raidPlaining()
    {
        return $this->hasMany(RaidPlaining::class);
    }
    public function raidDoc()
    {
        return $this->hasMany(RaidDocumentation::class);
    }
    public function pendingDestruct()
    {
        return $this->hasMany(PendingDestruction::class);
    }
    public function completedDestruct()
    {
        return $this->hasMany(CompletedDestruction::class);
    }
}
