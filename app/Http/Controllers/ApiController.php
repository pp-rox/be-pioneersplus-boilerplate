<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{

    public function output($success, $data)
    {

        
        $response_code = 200;
        $response['success'] = $success;

        if ($success) {

            $response['data'] = $data;

        } else {

            $response['data'] = '';
            $response['message'] = $data;
            $response_code = 422;

        }
        
        return response()->json($response, $response_code);
    }

}
