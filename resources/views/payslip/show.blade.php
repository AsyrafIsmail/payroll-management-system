<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payslip
            </h2>

            <a href="{{ route('payroll.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-md">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-8">

                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">
                        Payroll Management System
                    </h1>
                    <p class="text-gray-500">
                        Employee Payslip
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 bg-gray-50 p-4 rounded-lg">
                    <div>
                        <p class="text-sm text-gray-500">Employee</p>
                        <p class="font-semibold">{{ $payrollRecord->employee->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Department</p>
                        <p class="font-semibold">{{ $payrollRecord->employee->department->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Period</p>
                        <p class="font-semibold">
                            {{ DateTime::createFromFormat('!m', $payrollRecord->month)->format('F') }}
                            {{ $payrollRecord->year }}
                        </p>
                    </div>
                </div>

                <div class="border rounded-lg overflow-hidden">
                    <table class="min-w-full">
                        <tbody class="divide-y divide-gray-200">

                            <tr class="bg-gray-100">
                                <td colspan="2" class="px-6 py-3 font-semibold">
                                    Earnings
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3">Basic Salary</td>
                                <td class="px-6 py-3 text-right">
                                    RM {{ number_format($payrollRecord->employee->basic_salary, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3">Allowance</td>
                                <td class="px-6 py-3 text-right">
                                    RM {{ number_format($payrollRecord->employee->allowance, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3">
                                    Overtime Pay
                                    <span class="text-sm text-gray-500">
                                        ({{ $payrollRecord->employee->overtime_hours }} hours × RM {{ number_format($payrollRecord->employee->hourly_rate, 2) }})
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    RM {{ number_format($payrollRecord->overtime_pay, 2) }}
                                </td>
                            </tr>

                            <tr class="bg-gray-50 font-semibold">
                                <td class="px-6 py-3">Gross Pay</td>
                                <td class="px-6 py-3 text-right">
                                    RM {{ number_format($payrollRecord->gross_pay, 2) }}
                                </td>
                            </tr>

                            <tr class="bg-gray-100">
                                <td colspan="2" class="px-6 py-3 font-semibold">
                                    Deductions
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3">Tax 8%</td>
                                <td class="px-6 py-3 text-right">
                                    RM {{ number_format($payrollRecord->tax, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3">EPF Employee 11%</td>
                                <td class="px-6 py-3 text-right">
                                    RM {{ number_format($payrollRecord->epf_employee, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3">
                                    EPF Employer 13%
                                    <span class="text-sm text-gray-500">(Info only)</span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    RM {{ number_format($payrollRecord->epf_employer, 2) }}
                                </td>
                            </tr>

                            <tr class="bg-indigo-600 text-white text-lg font-bold">
                                <td class="px-6 py-4">NET PAY</td>
                                <td class="px-6 py-4 text-right">
                                    RM {{ number_format($payrollRecord->net_pay, 2) }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="mt-6 text-sm text-gray-500">
                    Generated on {{ $payrollRecord->created_at->format('d M Y, h:i A') }}
                </div>

                <div class="mt-6">
                    <a href="{{ route('payslip.pdf', $payrollRecord) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-md">
                        Download PDF
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
