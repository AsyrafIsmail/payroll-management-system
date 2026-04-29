<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Run Payroll
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Generate Monthly Payroll
                    </h3>
                    <p class="text-sm text-gray-500">
                        This will calculate payroll for all employees. Existing payroll records for the same month and year will be skipped.
                    </p>
                </div>

                <form method="POST" action="{{ route('payroll.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Month</label>
                            <select name="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}" @selected(old('month', now()->month) == $month)>
                                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('month')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Year</label>
                            <input type="number"
                                   name="year"
                                   value="{{ old('year', now()->year) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                   required>
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('payroll.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Payroll History
                        </a>

                        <button type="submit"
                                onclick="return confirm('Run payroll for selected month and year?')"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Run Payroll
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
