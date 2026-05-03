<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employees
            </h2>

            <a href="{{ route('employees.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                + Add Employee
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

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-4 shadow-sm sm:rounded-lg mb-4">
                <form method="GET" action="{{ route('employees.index') }}" class="flex gap-3">
                    <select name="department_id" class="rounded-md border-gray-300">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}"
                                @selected(request('department_id') == $department->id)>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>

                    <button class="px-4 py-2 bg-gray-800 text-white rounded-md">
                        Filter
                    </button>

                    <a href="{{ route('employees.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded-md">
                        Reset
                    </a>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Department</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Position</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold">Basic Salary</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($employees as $employee)
                            <tr>
                                <td class="px-6 py-4">{{ $employees->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4 font-medium">{{ $employee->name }}</td>
                                <td class="px-6 py-4">{{ $employee->department->name }}</td>
                                <td class="px-6 py-4">{{ $employee->position }}</td>
                                <td class="px-6 py-4 text-right">
                                    RM {{ number_format($employee->basic_salary, 2) }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('employees.edit', $employee) }}"
                                       class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        Edit
                                    </a>

                                    <form action="{{ route('employees.destroy', $employee) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Delete this employee?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No employees found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
