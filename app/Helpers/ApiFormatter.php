<?php

namespace App\Helpers;

class ApiFormatter {
    protected static $response = [
        'Header' => [
            'Response code' => null,
        ],
        'Body' => null,
    ];

    public static function createApi($code = null, $body = null) {
        self::$response['Header']['Response code'] = $code;
        self::$response['Body'] = $body;

        return response()->json(self::$response, self::$response['Header']['Response code'] = $code);
    }
}