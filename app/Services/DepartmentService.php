<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\ServiceProvider;

class DepartmentService
{
    public function updateOrCreate($data = [],  $department = null){
        if(empty($department)){
            $department = new Department();
        }
        $department->fill($data);
        $department->save();
        return $department->fresh();
    }
}
