<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @param string $message
 *
 * @return JsonResponse
 */
function unauthorizedResponse(string $message = 'Unauthorized') : JsonResponse
{
    return response()->json(['message' => $message], Response::HTTP_FORBIDDEN);
}
