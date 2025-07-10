<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class);
    }

    public function assignTask()
    {
        return $this->hasMany(AssignTask::class, 'task_id');
    }
}
