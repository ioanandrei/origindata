<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

function unauthorizedResponse() : JsonResponse
{
    return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
}
