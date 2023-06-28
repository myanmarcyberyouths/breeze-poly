<?php

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

if (!function_exists('json_response')) {
    function json_response($status, $message, $data = null): JsonResponse
    {
        try{
            return response()->json([
                'meta' => [
                    'status' => $status,
                    'msg' => $message
                ],
                'data' => $data
            ]);
        } catch (ValidationException $e) {

            $errors = $e->validator->getMessageBag()->toArray();
            return response()->json(['errors' => $errors], $e->status);

        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
