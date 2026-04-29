<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payroll History
            </h2>

            <a href="{{ route('payroll.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Run Payroll
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-4 shadow-sm sm:rounded-lg mb-4">
                <form method="GET" action="{{ route('payroll.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <select name="month" class="rounded-md border-gray-300">
                        <option value="">All Months</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" @selected(request('month') == $month)>
                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                            </option>
                        @endforeach
                    </select>

                    <input type="number"
                           name="year"
                           value="{{ request('year') }}"
                           placeholder="Year"
                           class="rounded-md border-gray-300">

                    <select name="department_id" class="rounded-md border-gray-300">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @selected(request('department_id') == $department->id)>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-gray-800 text-white rounded-md">
                            Filter
                        </button>

                        <a href="{{ route('payroll.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Employee</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Department</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Period</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold">Gross Pay</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold">Net Pay</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($payrollRecords as $record)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium">{{ $record->employee->name }}</td>
                                <td class="px-6 py-4">{{ $record->employee->department->name }}</td>
                                <td class="px-6 py-4">
                                    {{ DateTime::createFromFormat('!m', $record->month)->format('F') }}
                                    {{ $record->year }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    RM {{ number_format($record->gross_pay, 2) }}
                                </td>
                                <td class="px-6 py-4 text-right font-semibold">
                                    RM {{ number_format($record->net_pay, 2) }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('payslip.show', $record) }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        View Payslip
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No payroll records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $payrollRecords->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
