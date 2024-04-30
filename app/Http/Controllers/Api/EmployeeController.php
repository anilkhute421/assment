<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\EmployeeViewRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\EmployeeListResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeUpdateResource;
use App\Http\Resources\EmployeeViewResource;
use App\Models\User;
use App\Repositries\EmployeeRepository;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected $employeeRepository;

     /**
     * Create a new EmployeeController instance.
     *
     * @param  \App\Repositories\EmployeeRepository  $employeeRepository
     * @return void
     */

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        // Apply 'auth' middleware to all controller methods
        $this->middleware('auth');
    }

    /**
     * Create a new employee.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @return \App\Http\Resources\EmployeeResource
     */

    public function create(EmployeeRequest $request)
    {
        // Call employee_create method from repository to create employee
        $user = $this->employeeRepository->employee_create($request->all());

        // Return resource if employee creation is successful
        if($user){
            return new EmployeeResource($user);
        }
    }

    /**
     * Get a list of employees.
     *
     * @return \App\Http\Resources\EmployeeListResource
     */

    public function list()
    {
        // Call employee_list method from repository to get list of employees
        $user = $this->employeeRepository->employee_list();

        // Return resource if list retrieval is successful
        if($user){
            return new EmployeeListResource($user);
        }
    }

    /**
     * View details of a specific employee.
     *
     * @param  \App\Http\Requests\EmployeeViewRequest  $request
     * @return \App\Http\Resources\EmployeeViewResource
     */

    public function view(EmployeeViewRequest $request)
    {
        // Call employee_view method from repository to view employee details
        $user = $this->employeeRepository->employee_view($request->all());

        // Return resource if viewing employee details is successful
        if($user){
            return new EmployeeViewResource($user);
        }

    }

    /**
     * Update details of a specific employee.
     *
     * @param  \App\Http\Requests\EmployeeUpdateRequest  $request
     * @return \App\Http\Resources\EmployeeUpdateResource
     */
    public function update(EmployeeUpdateRequest $request)
    {
        // Call employee_update method from repository to update employee details
        $user = $this->employeeRepository->employee_update($request->all());
        
        // Return resource if updating employee details is successful
        if($user){
            return new EmployeeUpdateResource($user);
        }

    }

}
