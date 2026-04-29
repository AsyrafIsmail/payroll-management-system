<?php

namespace App\Http\Controllers;

use App\Models\PayrollRecord;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    public function show(PayrollRecord $payrollRecord) {
        $payrollRecord->load('employee.department');

        return view('payslip.show', compact('payrollRecord'));
    }

}
