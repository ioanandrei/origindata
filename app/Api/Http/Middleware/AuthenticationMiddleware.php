<?php

namespace App\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ( auth()->user()->id != $request->route('employeeId') ) {
            return unauthorizedResponse("You don't have access to this profile.");
        }

        return $next($request);
    }
}
