<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Employee;
use App\Models\Factories;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use App\Http\Resources\FactoryResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $employeeService)
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $perPage = $request->input('per_page', 10);

        return Inertia::render('Employee/IndexEmployee', [
            'employees' => $this->employeeService->getEmployee($perPage)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Employee/CreateEmployee', [
            'factories' => FactoryResource::collection(Factories::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $this->employeeService->createEmployee($request->validated());

        return to_route('employee.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return Inertia::render('Employee/ShowEmployee', [
            'employee' => new EmployeeResource($employee)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return Inertia::render('Employee/EditEmployee', [
            'employees' => new EmployeeResource($employee),
            'factories' => FactoryResource::collection(Factories::all())
        ]);

        dd(FactoryResource::collection(Factories::all())->toArray(request()));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->employeeService->updateEmployee($employee, $request->validated());

        return to_route('employee.index')->with('success', 'Factory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this->employeeService->deleteEmployee($employee);
    }
}
