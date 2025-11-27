<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public DepartmentService  $departmentService;
    public function __construct()
    {
        $this->departmentService = new DepartmentService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $departments = Department::when($request->search, function ($q, $search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->get();

        if($request->ajax()){
            return response()->json([
                'departments' => $departments
            ]);
        }

        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:departments,name',
        ]);

        $this->departmentService->updateOrCreate($data);
        return back()->with('success', 'Department updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('success', 'Department deleted successfully');
    }
}
