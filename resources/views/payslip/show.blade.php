<h2>Payslip</h2>

<p>Employee: {{ $payrollRecord->employee->name }}</p>
<p>Department: {{ $payrollRecord->employee->department->name }}</p>
<p>Period: {{ DateTime::createFromFormat('!m', $payrollRecord->month)->format('F') }} {{ $payrollRecord->year }}</p>

<br>

<p>Basic Salary: RM {{ number_format($payrollRecord->employee->basic_salary, 2) }}</p>
<p>Allowance: RM {{ number_format($payrollRecord->employee->allowance, 2) }}</p>
<p>Overtime Pay: RM {{ number_format($payrollRecord->overtime_pay, 2) }}</p>

<br>

<p>Gross Pay: RM {{ number_format($payrollRecord->gross_pay, 2) }}</p>
<p>Tax 8%: RM {{ number_format($payrollRecord->tax, 2) }}</p>
<p>EPF Employee 11%: RM {{ number_format($payrollRecord->epf_employee, 2) }}</p>
<p>EPF Employer 13%: RM {{ number_format($payrollRecord->epf_employer, 2) }}</p>

<br>

<h3>NET PAY: RM {{ number_format($payrollRecord->net_pay, 2) }}</h3>
