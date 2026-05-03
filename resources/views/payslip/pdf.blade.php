<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .container { padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .box { border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 6px; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        .total { background: #eee; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Payroll Management System</h2>
        <p>Employee Payslip</p>
    </div>

    <div class="box">
        <table>
            <tr>
                <td>Employee</td>
                <td class="bold">{{ $payrollRecord->employee->name }}</td>
            </tr>
            <tr>
                <td>Department</td>
                <td>{{ $payrollRecord->employee->department->name }}</td>
            </tr>
            <tr>
                <td>Period</td>
                <td>
                    {{ DateTime::createFromFormat('!m', $payrollRecord->month)->format('F') }}
                    {{ $payrollRecord->year }}
                </td>
            </tr>
        </table>
    </div>

    <table border="1">
        <tr>
            <td colspan="2" class="bold">Earnings</td>
        </tr>
        <tr>
            <td>Basic Salary</td>
            <td class="right">RM {{ number_format($payrollRecord->basic_salary, 2) }}</td>
        </tr>
        <tr>
            <td>Allowance</td>
            <td class="right">RM {{ number_format($payrollRecord->allowance, 2) }}</td>
        </tr>
        <tr>
            <td>Overtime Pay</td>
            <td class="right">RM {{ number_format($payrollRecord->overtime_pay, 2) }}</td>
        </tr>
        <tr class="total">
            <td>Gross Pay</td>
            <td class="right">RM {{ number_format($payrollRecord->gross_pay, 2) }}</td>
        </tr>

        <tr>
            <td colspan="2" class="bold">Deductions</td>
        </tr>
        <tr>
            <td>Tax</td>
            <td class="right">RM {{ number_format($payrollRecord->tax, 2) }}</td>
        </tr>
        <tr>
            <td>EPF Employee</td>
            <td class="right">RM {{ number_format($payrollRecord->epf_employee, 2) }}</td>
        </tr>
        <tr>
            <td>EPF Employer</td>
            <td class="right">RM {{ number_format($payrollRecord->epf_employer, 2) }}</td>
        </tr>

        <tr class="total">
            <td>NET PAY</td>
            <td class="right">RM {{ number_format($payrollRecord->net_pay, 2) }}</td>
        </tr>
    </table>

</div>

</body>
</html>
