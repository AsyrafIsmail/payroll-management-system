<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['department_id', 'name', 'position', 'basic_salary', 'allowance', 'overtime_hours', 'hourly_rate'];

    public function departments() {
        return $this->belongsTo(Department::class);
    }

    public function payroll_records() {
        return $this->hasMany(PayrollRecord::class);
    }
}
