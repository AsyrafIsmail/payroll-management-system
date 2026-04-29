<?php

use App\Models\Employee;
use App\Services\PayrollCalculationService;

test('payroll calculation is correct', function () {
    $employee = new Employee([
        'basic_salary' => 4000,
        'allowance' => 600,
        'overtime_hours' => 10,
        'hourly_rate' => 25,
    ]);

    $service = new PayrollCalculationService();

    $result = $service->calculate($employee);

    expect($result['overtime_pay'])->toBe(250.00);
    expect($result['gross_pay'])->toBe(4850.00);
    expect($result['tax'])->toBe(388.00);
    expect($result['epf_employee'])->toBe(533.50);
    expect($result['epf_employer'])->toBe(630.50);
    expect($result['net_pay'])->toBe(3928.50);
});


