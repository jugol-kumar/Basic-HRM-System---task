<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($employee) ? 'Edit Employee' : 'Create Employee' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($employee))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="font-semibold">First Name</label>
                        <input type="text" name="first_name"
                               class="w-full border rounded p-2"
                               value="{{ old('first_name', $employee->first_name ?? '') }}">
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold">Last Name</label>
                        <input type="text" name="last_name"
                               class="w-full border rounded p-2"
                               value="{{ old('last_name', $employee->last_name ?? '') }}">
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold">Email</label>
                        <input type="email" name="email"
                               class="w-full border rounded p-2"
                               value="{{ old('email', $employee->email ?? '') }}">
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold">Department</label>
                        <select name="department_id"
                                class="w-full border rounded p-2"
                                required>
                            <option value="">Select Department</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ (old('department_id', $employee->department_id ?? '') == $dept->id) ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold">Skills</label>
                        <select class="js-example-basic-single w-full" name="skills[]" multiple>
                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}"
                                    {{ (in_array($skill->id, old('skills', isset($employee) ? $employee->skills->pluck('id')->toArray() ?? [] : []))) ? 'selected' : '' }}>
                                    {{ $skill->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded">
                        {{ isset($employee) ? 'Update Employee' : 'Save Employee' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                tags: true,
                placeholder: 'Enter your skills'
            });
        });
    </script>
</x-app-layout>
