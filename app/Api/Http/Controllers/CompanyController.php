<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Requests\Company\UpdateRequest;
use App\Api\Http\Resources\CompanyResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CompanyController extends Controller
{
    /**
     * This can be modified in a resource collection(a list) if the user will be able to be in multiple companies.
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return $this->makeJsonResponse(CompanyResource::make($this->getEmployee()->company));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show(Request $request) : JsonResponse
    {
        return $this->makeJsonResponse(CompanyResource::make($this->getEmployee()->company));
    }

    /**
     * @param UpdateRequest $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdateRequest $request) : JsonResponse
    {
        $company = $this->getEmployee()->company;
        $company->updateOrFail([
            'name'             => $request->input('name'),
            'legal_identifier' => $request->input('legal_identifier', $company->legal_identifier),
        ]);

        return $this->makeJsonResponse(CompanyResource::make($company));
    }

    /**
     * @return JsonResponse
     */
    public function delete() : JsonResponse
    {
        $company = $this->getEmployee()->company;
        $company->employees()->delete();
        $company->projects()->delete();
        $company->delete();

        return $this->makeJsonResponse();
    }
}
