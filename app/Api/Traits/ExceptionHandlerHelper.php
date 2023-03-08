<?php

namespace App\Api\Traits;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

trait ExceptionHandlerHelper
{
    /**
     * @param Throwable $exception
     *
     * @return JsonResponse
     */
    public function handleJsonResponse(Throwable $exception) : JsonResponse
    {
        // Here you can define rules based on the exception type.
        return match (get_class($exception)) {
            NotFoundHttpException::class => $this->handleNotFoundException($exception),
            ValidationException::class => $this->handleValidationException($exception),
            AuthenticationException::class => $this->handleAuthenticationException($exception),
            default => $this->handleGeneralException($exception)
        };
    }

    /**
     * @param Throwable $exception
     *
     * @return JsonResponse
     */
    private function handleAuthenticationException(Throwable $exception) : JsonResponse
    {
        return unauthorizedResponse($exception->getMessage());
    }

    /**
     * @param Throwable $exception
     *
     * @return JsonResponse
     */
    private function handleValidationException(Throwable $exception) : JsonResponse
    {
        /** @var Validator $validator */
        $validator = $exception->validator;

        return \response()->json([
            'validation_errors' => $validator->getMessageBag(),
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param Throwable $exception
     *
     * @return JsonResponse
     */
    private function handleNotFoundException(Throwable $exception) : JsonResponse
    {
        return response()->json([
            'message' => "This entity or route doesn't exist.",
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Throwable $exception
     *
     * @return JsonResponse
     */
    private function handleGeneralException(Throwable $exception) : JsonResponse
    {
        return \response()->json([
            'message' => 'Something went wrong.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
