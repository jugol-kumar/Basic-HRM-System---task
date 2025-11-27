<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Skill;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;
    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::with('department')
        ->withCount('skills')
        ->when($request->search, function ($q, $search) {
            $q->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })->when($request->department_id, function ($q, $department_id) {
            $q->where('department_id', $department_id);
        })->get();

        $departments = Department::all();
        if($request->ajax()){
            return response()->json(view('employee.components.table', compact('employees'))->render());
        }

        return view('employee.index', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::all();
        $departments = Department::all();

        return view('employee.form', compact('skills', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeCreateRequest $request)
    {
        $data = $request->validated();
        $employee = $this->employeeService->updateOrCreate($data);

        if(!empty($employee) && !empty($data['skills'])){
            $skillIds = array_map(function ($item) {
                return is_numeric($item) ? (int)$item : Skill::firstOrCreate(['name' => $item])->id;
            }, $data['skills']);

            $employee->skills()->sync($skillIds);
        }

        return back()->with('success', 'Employee has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = $employee->load('skills');
        $departments = Department::all();
        $skills = Skill::all();
        return view('employee.form', compact('employee', 'skills', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeCreateRequest $request, Employee $employee)
    {
        $data = $request->validated();
        if(!empty($employee) && !empty($data['skills'])){
            $skillIds = array_map(function ($item) {
                return is_numeric($item) ? (int)$item : Skill::firstOrCreate(['name' => $item])->id;
            }, $data['skills']);
            $employee->skills()->sync($skillIds);
        }
        return back()->with('success', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json('Employee has been deleted');
    }
}
