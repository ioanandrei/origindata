<?php

namespace App\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyMembership
{
    public function handle(Request $request, Closure $next)
    {
        // check if the employee is in the requested company
        if ( auth()->user()->company_id != $request->route('companyId') ) {
            return unauthorizedResponse();
        }

        return $next($request);
    }
}
