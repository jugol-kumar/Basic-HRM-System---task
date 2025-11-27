
@foreach ($employees as $emp)
    <tr>
        <td class="p-2 border">{{ $emp->id }}</td>
        <td class="p-2 border">{{ $emp->department->name }}</td>
        <td class="p-2 border">{{ $emp->skills_count }}</td>
        <td class="p-2 border">{{ $emp->first_name }}</td>
        <td class="p-2 border">{{ $emp->last_name }}</td>
        <td class="p-2 border">{{ $emp->email }}</td>
        <td class="p-2 border">{{ $emp->created_at->format('Y-m-d') }}</td>
        <td class="content-center">
            <div class="flex items-center gap-2">
                <a class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700" href="{{ route('employees.edit', $emp->id) }}">Edit</a>
                <button data-id="{{ $emp->id }}" class="deleteEmployee bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                    Delete
                </button>
            </div>
        </td>
    </tr>
@endforeach
