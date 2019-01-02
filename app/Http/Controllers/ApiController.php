<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{

    public function response($success = false, $data = null, $message = null)
    {

        $response_code = 422;
        $response['success'] = $success;
        $response['data'] = $data;
        $response['message'] = $message;

        if ($success) {
            $response_code = 200;
        }

        return response()->json($response, $response_code);
    }

}
