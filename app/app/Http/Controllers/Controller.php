<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function __construct()
    {

    }

    /**
    * return a success response json
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function sendResponse(string $message = 'Ok', ?array $response_data = null, array $additional_values = [], $http_code = 200): JsonResponse
    {
        $response = [
            'success'     => true,
            'status_text' => 'success',
            'message'     => $message
        ];

        if (!is_null($response_data)) {
            $response['data'] = $response_data;
        }

        if (sizeof($additional_values)) {
            foreach ($additional_values as $key => $value) {
                $response[$key] = $value;
            }
        }

        return Response::json($response, $http_code);
    }

    /**
    * return error response.
    *
    * @return \Illuminate\Http\Response
    */
    public function sendError(string $error, ?array $data = null, int $code = 500): JsonResponse
    {
        $response = [
            'success'      => false,
            'status_text'  => 'error',
            'message'      => $error,
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, $code);
    }
}
