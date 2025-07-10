<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignTask extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function case()
    {
        return $this->belongsTo(CaseManagement::class, 'case_management_id');
    }
}
