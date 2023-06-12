<?php 

if (!function_exists('json_response'))
{
    function json_response($status, $message, $data = null)
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