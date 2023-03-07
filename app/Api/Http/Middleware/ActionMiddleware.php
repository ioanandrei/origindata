<?php

namespace App\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // check if the employee has the necessary permissions on the token
        $action = config('route_actions.'.$request->route()->getName());

        if ( !$action || !auth()->user()->tokenCan($action) ) {
            return unauthorizedResponse();
        }

        return $next($request);
    }
}
