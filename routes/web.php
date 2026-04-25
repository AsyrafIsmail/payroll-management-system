<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayslipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function() {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);

    Route::get('/payroll/run', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll/run', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/payroll/history', [PayrollController::class, 'index'])->name('payroll.index');

    Route::get('/payslip/{payrollRecord}', [PayslipController::class, 'show'])->name('payslip.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
