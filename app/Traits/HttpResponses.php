<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data, $message = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data, $message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function successWithCookie($data, $cookie, $message=null, $code=200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code)->withCookie($cookie);
    }
}
