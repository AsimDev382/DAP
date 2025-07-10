<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseManagement extends Model
{
    protected $table = 'case_managements';

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
    public function investigation()
    {
        return $this->hasMany(Investigation::class);
    }

    public function evidences()
    {
        return $this->hasMany(Evidence::class, 'case_id');
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
    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'case_id');
    }

    public function assignTasks()
    {
        return $this->hasMany(AssignTask::class, 'case_management_id');
    }
}
