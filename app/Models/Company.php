<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
    public function user()
    {
        return $this->hasMany(User::class, 'company_id'); // returns a collection
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function investigation()
    {
        return $this->hasMany(Investigation::class);
    }
    public function case()
    {
        return $this->hasMany(CaseManagement::class);
    }
    public function department()
    {
        return $this->hasMany(Department::class);
    }
    public function group()
    {
        return $this->hasMany(Group::class);
    }
    public function raidPlaining()
    {
        return $this->hasMany(RaidPlaining::class);
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
        return $this->hasMany(Expenses::class);
    }
}
