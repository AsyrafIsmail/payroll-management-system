<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <label class="block text-sm font-medium text-gray-700">Department</label>
        <select name="department_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            <option value="">-- Select Department --</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}"
                    @selected(old('department_id', $employee?->department_id) == $department->id)>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
        @error('department_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Employee Name</label>
        <input type="text" name="name"
               value="{{ old('name', $employee?->name) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Position</label>
        <input type="text" name="position"
               value="{{ old('position', $employee?->position) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('position')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Basic Salary</label>
        <input type="number" step="0.01" name="basic_salary"
               value="{{ old('basic_salary', $employee?->basic_salary) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('basic_salary')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Allowance</label>
        <input type="number" step="0.01" name="allowance"
               value="{{ old('allowance', $employee?->allowance ?? 0) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('allowance')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Overtime Hours</label>
        <input type="number" name="overtime_hours"
               value="{{ old('overtime_hours', $employee?->overtime_hours ?? 0) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('overtime_hours')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Hourly Rate</label>
        <input type="number" step="0.01" name="hourly_rate"
               value="{{ old('hourly_rate', $employee?->hourly_rate ?? 0) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('hourly_rate')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

</div>
