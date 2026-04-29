<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Employee
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('employees.update', $employee) }}">
                    @csrf
                    @method('PUT')

                    @include('employees.partials.form', ['employee' => $employee])

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('employees.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
