<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Departments
            </h2>

            <a href="{{ route('departments.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                + Add Department
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

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Department Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Employees</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($departments as $department)
                            <tr>
                                <td class="px-6 py-4">{{ $departments->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4 font-medium">{{ $department->name }}</td>
                                <td class="px-6 py-4">{{ $department->employees_count ?? $department->employees()->count() }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('departments.edit', $department) }}"
                                       class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        Edit
                                    </a>

                                    <form action="{{ route('departments.destroy', $department) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Delete this department?')">
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
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No departments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $departments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
