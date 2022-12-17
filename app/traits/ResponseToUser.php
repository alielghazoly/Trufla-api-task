<?php

namespace App\Traits;


trait ResponseToUser
{

    public function coreResponse($message, $data = null, $statusCode)
    {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
                'results' => $data
            ], $statusCode);

        
    }
}