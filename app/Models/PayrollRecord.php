<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollRecord extends Model
{
    protected $fillable = [
        'employee_id', 'month', 'year', 'gross_pay', 'overtime_pay',
        'tax', 'epf_employee', 'epf_employer', 'net_pay'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
