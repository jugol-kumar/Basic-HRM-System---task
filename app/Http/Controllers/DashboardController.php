<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $departments = Department::count();
        $employees = Employee::count();
        $skills = Skill::count();

        return view('dashboard', compact('departments', 'employees', 'skills'));
    }
}
