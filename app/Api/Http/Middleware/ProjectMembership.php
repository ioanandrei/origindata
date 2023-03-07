<?php

namespace App\Api\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class ProjectMembership
{
    public function handle(Request $request, Closure $next)
    {
        $project = Project::query()->findOrFail($request->route('projectId'));

        // check if the requested project belongs to the requested company
        if ( $project->company_id != $request->route('companyId') ) {
            return unauthorizedResponse();
        }

        // check if the user has the requested project
        if ( !auth()->user()->projects->contains($project->id) ) {
            return unauthorizedResponse();
        }

        return $next($request);
    }
}
