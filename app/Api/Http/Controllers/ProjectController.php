<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Requests\Project\StoreRequest;
use App\Api\Http\Resources\ProjectResource;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ProjectController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $projects = $this->getEmployee()->projects;

        return $this->makeJsonResponse(ProjectResource::collection($projects));
    }

    /**
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request) : JsonResponse
    {
        $project = Project::query()->create([
            'name'       => $request->input('name'),
            'company_id' => $request->route('companyId'),
        ]);

        return $this->makeJsonResponse(new ProjectResource($project));
    }

    /**
     * @param StoreRequest $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(StoreRequest $request) : JsonResponse
    {
        $project = Project::query()->find($request->route('projectId'));

        $project->updateOrFail([
            'name' => $request->input('name'),
        ]);

        return $this->makeJsonResponse(ProjectResource::make($project));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function delete(Request $request) : JsonResponse
    {
        $project = Project::query()->find($request->route('projectId'));
        $project->deleteOrFail();

        return $this->makeJsonResponse();
    }
}
