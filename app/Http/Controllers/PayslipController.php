<?php

namespace App\Http\Controllers;

use App\Models\PayrollRecord;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PayslipController extends Controller
{
    public function show(PayrollRecord $payrollRecord) {
        $payrollRecord->load('employee.department');

        return view('payslip.show', compact('payrollRecord'));
    }

    public function pdf(PayrollRecord $payrollRecord) {
        $payrollRecord->load('employee.department');

        $pdf = Pdf::loadView('payslip.pdf', compact('payrollRecord'))->setPaper('A4');

        $fileName = 'payslip-' . $payrollRecord->employee->name . '-' . $payrollRecord->month . '-' . $payrollRecord->year .'.pdf';

        return $pdf->download($fileName);
    }

}
