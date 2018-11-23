<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\jwt\Parser;

class UserController extends ApiController
{

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();
            $success['token'] = $user->createToken('token')->accessToken;

            return response()->json(['success' => $success], 200);

        } else {

            return response()->json(['error' => 'Unauthorised'], 401);

        }
    }

    public function register(UserRequest $request)
    {
        $request->validated();

        $input = $request->all();

        try {
            $user = User::create($input);
            $success['token'] = $user->createToken('token')->accessToken;
            $success['name'] = $user->name;

            return response()->json(['success' => $success], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

    }


    public function profile()
    {

        try {

            $user = Auth::user();
            return response()->json(['success' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 422);

        }

    }

    public function testing()
    {
        return response()->json(['success' => 'testing'], 200);

    }

    public function logout(Request $request)
    {

        try {

            $token = $request->bearerToken();
            $token_id = (new Parser())->parse($token)->getHeader('jti');
            $token = $request->user()->tokens->find($token_id);
            $token->revoke();

            return response()->json(['success' => 'Logged out successfully'], 200);

        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to logout'], 422);
        }

    }

}
