<?php
namespace App\Contract;

class ApiResponse
{
    public static function success($data = [], $message = null, $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json($data);
    }

    public static function error($message, $status = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json($message, $status);
    }

    public static function response($status,$code,$message,$data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function notFound(string $message = 'Not Found'): \Illuminate\Http\JsonResponse
    
    {
        return response()->json([
            'message' => $message,
         ], 404);
    }

    public static function unauthorized(string $message = 'Unauthorized'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], 403);
    }
}
