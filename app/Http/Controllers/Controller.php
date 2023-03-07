<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Create a generic json response.
     *
     * @param string $message
     * @param mixed  $data
     * @param int    $status
     *
     * @return JsonResponse
     */
    public function makeJsonResponse(mixed $data, string $message = 'Success', int $status = 200) : JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    /**
     * Return the authenticated employee.
     * @return Employee|Authenticatable
     */
    public function getEmployee() : Employee|Authenticatable
    {
        return auth()->user();
    }
}
