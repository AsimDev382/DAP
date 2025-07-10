<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->hasMany(User::class   );
    }
    public function group()
    {
        return $this->hasMany(Group::class);
    }

    public function assignTask()
    {
        return $this->hasMany(AssignTask::class, 'task_id');
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
