<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function senResponse($result, $massage) {
        
        $code = 200;

        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function senError($error, $errorMessages = [], $code = 404) {

        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages))
            $response['data'] = $errorMessages;

        return response()->json($response, $code);
    }
}