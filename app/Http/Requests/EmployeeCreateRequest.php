<?php

namespace App\Http\Requests;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employeeId = $this->route('employee')?->id;
        return [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'department_id' => ['required'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Employee::class)->ignore($employeeId)
            ],
            'skills' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'department_id.required' => 'Department is required.',
            'department_id.string' => 'Department must be a string.',
            'department_id.max' => 'Department must be 255 characters.',
        ];
    }
}
