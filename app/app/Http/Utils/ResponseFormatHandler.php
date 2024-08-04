<?php

namespace App\Http\Utils;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ResponseFormatHandler
{
    /**
    * return a success response json
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public static function sendResponse($message = 'Ok', $responseData = null, array $additionalValues = [], $httpCode = 200): JsonResponse
    {
        $response = [
            'success'     => true,
            'status_text' => 'success',
            'message'     => $message,
            'data'        => $responseData
        ];

        if (sizeof($additionalValues)) {
            foreach ($additionalValues as $key => $value) {
                $response[$key] = $value;
            }
        }

        return Response::json($response, $httpCode);
    }

    /**
    * return error response.
    *
    * @return \Illuminate\Http\Response
    */
    public static function sendError(string $message, array $responseData = null, int $httpCode = 500): JsonResponse
    {
        return Response::json([
            'success'      => false,
            'status_text'  => 'error',
            'message'      => $message,
            'data'         => $responseData
        ], $httpCode);
    }
}
