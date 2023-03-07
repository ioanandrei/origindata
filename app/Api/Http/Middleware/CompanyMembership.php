<?php

namespace App\Api\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;

class CompanyMembership
{
    public function handle(Request $request, Closure $next)
    {
        $company = Company::query()->findOrFail($request->route('companyId'));

        // check if the employee is in the requested company
        if ( auth()->user()->company_id != $company->id ) {
            return unauthorizedResponse("You don't belong to this company.");
        }

        return $next($request);
    }
}
