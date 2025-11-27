<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold mb-4"></h3>
                    <a href="{{ route('employees.create') }}"
                       class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-3 py-1 rounded-lg shadow">
                        + Create Employee
                    </a>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Filter by Department:</label>
                    <select id="departmentFilter"
                            class="border rounded p-2">
                        <option value="">All Departments</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>

                    <input type="text" placeholder="Search..." id="search">
                </div>

                <table class="w-full border" id="employeeTable">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Department</th>
                        <th class="p-2 border">Skills Count</th>
                        <th class="p-2 border">First Name</th>
                        <th class="p-2 border">Last Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Created At</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                    </thead>

                    <tbody id="employeeData">
                        @include('employee.components.table')
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(document).ready(function () {
                let filters = {
                    department_id: '',
                    search: ''
                };

                $("#departmentFilter").on("change", function () {
                    filters.department_id = $(this).val();
                    callAjax(filters);
                });

                $("#search").on('input', function (e) {
                    filters.search = e.target.value;
                    callAjax(filters);
                });

                $(".deleteEmployee").on("click", function () {
                    const id = $(this).data('id')

                    if(confirm("Are you sure? want to delete this employee...!")){
                        $.ajax({
                            url: `/employees/${id}`,
                            type: "DELETE",
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                callAjax({})
                            },
                            error: function (xhr) {
                                alert('Something went wrong!');
                            }
                        });
                    }
                })

                const callAjax = (data) => {
                    $.ajax({
                        url: "{{ route('employees.index') }}",
                        type: "GET",
                        data: data,
                        success: function (response) {
                            $("#employeeData").html(response);
                        }
                    });
                }
            });
        })
    </script>

</x-app-layout>
