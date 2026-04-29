<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = Department::orderBy('name')->get();

        $employees = Employee::with('department')->when($request->department_id, function ($query) use ($request) {
            $query->where('department_id', $request->department_id);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('employees.index', compact('employees', 'departments'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::ordeyBy('name')->get();

        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exist:departments, id'],
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'basic_salary' => ['required', 'numeric', 'min:0'],
            'overtime_hours' => ['required', 'integer', 'min:0'],
            'hourly_rate' => ['required', 'numeric', 'min:0'],
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::ordeyBy('name')->get();

        return view('employees.index', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exist:departments, id'],
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'basic_salary' => ['required', 'numeric', 'min:0'],
            'overtime_hours' => ['required', 'integer', 'min:0'],
            'hourly_rate' => ['required', 'numeric', 'min:0'],
        ]);

        Employee::update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->payroll_records()->exists()) {
            return back()->with('error', 'Employee cannot be deleted because payroll records exist.');
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
