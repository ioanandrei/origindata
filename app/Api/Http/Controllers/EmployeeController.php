<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Requests\Employee\StoreRequest;
use App\Api\Http\Resources\EmployeeResource;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;

class EmployeeController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        $company = Company::query()->find($request->route('companyId'));

        return $this->makeJsonResponse(EmployeeResource::collection($company->employees));
    }

    /**
     * @return JsonResponse
     */
    public function show() : JsonResponse
    {
        return $this->makeJsonResponse(EmployeeResource::make($this->getEmployee()));
    }

    /**
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request) : JsonResponse
    {
        $employee = Employee::query()->create([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'email'      => $request->input('email'),
            'phone'      => $request->input('phone'),
            'company_id' => $request->route('companyId'),
            'password'   => Hash::make(Str::random()),
        ]);

        return $this->makeJsonResponse(EmployeeResource::make($employee));
    }

    /**
     * @param StoreRequest $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(StoreRequest $request) : JsonResponse
    {
        $employee = Employee::query()->find($request->route('employeeId'));

        $employee->updateOrFail([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'phone'      => $request->input('phone'),
            'email'      => $request->input('email'),
        ]);

        return $this->makeJsonResponse(EmployeeResource::make($employee));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function delete(Request $request) : JsonResponse
    {
        $employee = Employee::query()->find($request->route('employeeId'));
        $employee->deleteOrFail();

        return $this->makeJsonResponse();
    }
}
