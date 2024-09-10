<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Factories;
use GuzzleHttp\Psr7\Request;

class EmployeeService
{
    public function getEmployee($perPage = 10)
    {
        return Employee::with('factory')
            ->withoutTrashed()
            ->latest()
            ->paginate($perPage);
    }

    public function createEmployee($data)
    {
        return Employee::create($data);
    }

    public function updateEmployee($employee, $data)
    {
        return $employee->update($data);
    }

    public function deleteEmployee(Employee $employee)
    {
        try {
            $employee->delete();
            return response()->json(['message' => 'Employee deleted successfully'], 200);
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return response()->json(['message' => 'Failed to delete employee'], 500);
        }
    }
}
