<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Resources\CompanyResource;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * This can be modified in a resource collection(a list) if the user will be able to be in multiple companies.
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        /** @var Employee $employee */
        $employee = auth()->user();

        return $this->makeJsonResponse(new CompanyResource($employee->company));
    }
}
