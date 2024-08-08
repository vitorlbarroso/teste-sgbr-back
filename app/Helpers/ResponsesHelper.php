<?php

namespace App\Helpers;

class ResponsesHelper
{
    public static function SUCCESS($message = '', $data = null, $code = 200, $success = true) {
        return response()->json(
            [
                'data' => $data,
                'message' => $message
            ]
            , $code);
    }

    public static function ERROR($message = '', $data = null, $errorCode, $code = 400, $success = false) {
        return response()->json(
            [
                'error' => [
                    'errorCode' => $errorCode,
                    'message' => $message,
                    'data' => $data
                ]
            ]
            , $code);
    }
}
