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

test('payroll calculation works when overtime is zero', function () {
    $employee = new Employee([
        'basic_salary' => 3000.00,
        'allowance' => 500.00,
        'overtime_hours' => 0,
        'hourly_rate' => 30.00,
    ]);

    $service = new PayrollCalculationService();

    $result = $service->calculate($employee);

    expect($result['overtime_pay'])->toBe(0.00);
    expect($result['gross_pay'])->toBe(3500.00);
    expect($result['tax'])->toBe(280.00);
    expect($result['epf_employee'])->toBe(385.00);
    expect($result['epf_employer'])->toBe(455.00);
    expect($result['net_pay'])->toBe(2835.00);
});
