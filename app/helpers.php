<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('json_response')) {
    function json_response($status, $message, $data = null): JsonResponse
    {
        return response()->json([
            'meta' => [
                'status' => $status,
                'msg' => $message
            ],
            'data' => $data
        ]);
    }
}
