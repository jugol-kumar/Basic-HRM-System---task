<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function updateOrCreate($data = [],  $employee = null){
        if(empty($employee)){
            $employee = new Employee();
        }
        $employee->fill($data);
        $employee->save();
        return $employee->fresh();
    }
}
