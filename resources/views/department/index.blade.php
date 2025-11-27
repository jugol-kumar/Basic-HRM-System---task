<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-2">
                    <form action="{{ route('department.store') }}" method="post" id="createDepartmentForm" class="flex flex-col sm:flex-row w-full sm:w-1/2 gap-2 items-start sm:items-center">
                        @csrf
                        <div class="flex-1 flex flex-col">
                            <input type="text" name="name" placeholder="Enter Department Name..."
                                   class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                            @error('name')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mt-2 sm:mt-0">
                            + Create
                        </button>
                    </form>
                </div>

                <ul class="space-y-2">
                    @foreach ($departments as $department)
                        <li class="p-3 border rounded flex justify-between items-center employee-item">
                            <span class="employee-name font-medium">
                                {{ $department->name }}
                            </span>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('department.destroy', $department->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
