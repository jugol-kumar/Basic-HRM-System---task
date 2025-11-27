<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Dashboard Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Departments --}}
                <div class="bg-white shadow rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
                    <div class="p-3 bg-blue-500 rounded-full text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 7v4a1 1 0 001 1h16a1 1 0 001-1V7M3 11h18M3 7h18M3 7V4a1 1 0 011-1h16a1 1 0 011 1v3"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Departments</p>
                        <p class="text-2xl font-bold">{{ $departments }}</p>
                    </div>
                </div>

                {{-- Employees --}}
                <div class="bg-white shadow rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
                    <div class="p-3 bg-green-500 rounded-full text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Employees</p>
                        <p class="text-2xl font-bold">{{ $employees }}</p>
                    </div>
                </div>

                {{-- Skills --}}
                <div class="bg-white shadow rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
                    <div class="p-3 bg-yellow-500 rounded-full text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6l4 2M12 6l-4 2m8 4h.01M12 14h.01M8 18h.01M16 18h.01"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Skills</p>
                        <p class="text-2xl font-bold">{{ $skills }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
