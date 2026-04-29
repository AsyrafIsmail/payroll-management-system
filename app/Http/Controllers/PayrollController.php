<?php

namespace App\Http\Controllers;

use App\Services\PayrollCalculationService;
use App\Models\Employee;
use App\Models\PayrollRecord;
use App\Models\Department;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function create() {
        return view('payroll.create');
    }

    public function store(Request $request, PayrollCalculationService $payrollService) {
        $validated = $request->validate([
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer']
        ]);

        $employees = Employee::all();

        $created = 0;
        $skipped = 0;

        foreach ($employees as $employee) {
            $exists = PayrollRecord::where('employee_id', $employee->id)->where('month', $validated['month'])->where('year', $validated['year'])->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            $calculation = $payrollService->calculate($employee);

            PayrollRecord::create([
                'employee_id' => $employee->id,
                'month' => $validated['month'],
                'year' => $validated['year'],
                ...$calculation,
            ]);

            $created++;
        }

        return redirect()->route('payroll.index')->with('success', "Payroll completed. Created: {$created}, Skipped duplicates: {$skipped}");
    }

    public function index(Request $request) {
        $departments = Department::orderBy('name')->get();

        $payrollRecords = PayRollRecord::with(['employee.department'])
        ->when($request->month, function ($query) use ($request) {
            $query->where('month', $request->month);
        })
        ->when($request->year, function($query) use($request) {
            $query->where('year', $request->year);
        })
        ->when($request->department_id, function($query) use($request) {
            $query->whereHas('employee', function($employeeQuery) use($request) {
                $employeeQuery->where('department_id', $request->department_id);
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('payroll.index', compact('payrollRecords', 'departments'));
    }
}
