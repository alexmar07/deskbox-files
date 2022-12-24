<?php

use Illuminate\Http\JsonResponse;

if ( ! function_exists('responseSuccess') ) {

    function respondSuccess(array $data, int $statusCode = 200) : JsonResponse {
        return response()->json($data, $statusCode);
    }
}

if ( ! function_exists('responseFail') ) {

    function responseFail(string $message, int $statusCode = 400, array $data = []) : JsonResponse {

        $response = [
            'message' => $message,
        ];

        if ( ! empty($data) ) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }
}