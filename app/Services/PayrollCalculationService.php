<?php

namespace App\Services;

use App\Models\Employee;

class PayrollCalculationService {

    public function calculate(Employee $employee) {
        $overtimePay = $employee->overtime_hours * $employee->hourly_rate;

        $grossPay = $employee->basic_salary + $employee->allowance + $overtimePay;

        $tax = $grossPay * 0.08;
        $epfEmployee = $grossPay * 0.11;
        $epfEmployer = $grossPay * 0.13;

        $netPay = $grossPay - $tax - $epfEmployee;

        return [
            'overtime_pay' => round($overtimePay, 2),
            'gross_pay' => round($grossPay, 2),
            'tax' =>round($tax, 2),
            'epf_employee' => round($epfEmployee, 2),
            'epf_employer' => round($netPay, 2)
        ];
    }
}
?>
