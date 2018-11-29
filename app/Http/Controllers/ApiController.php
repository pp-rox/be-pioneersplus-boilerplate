<?php

namespace App\Http\Controllers;

/**
 *@SWG\Swagger(
 *     schemes={"http"},   
 *     @SWG\Info(
 *         version="1.0",
 *         title="Backend Boilerplate",
 *     ),
 *     @SWG\Definition(
 *          definition="Role Response",
 * 			title="Role",
 * 			@SWG\Property(property="id", type="integer", description="UUID"),
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="guard_name", type="string"),
 *          @SWG\Property(property="created_at", type="string"),
 *          @SWG\Property(property="updated_at", type="string")
 * 		),
 *      @SWG\Definition(
 *          definition="Role",
 * 			title="Role Request",
 *          required={"name", "guard_name"},
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="guard_name", type="string"),
 * 		)
 * )
 */
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
