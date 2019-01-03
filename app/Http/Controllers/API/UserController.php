<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\jwt\Parser;
use Spatie\Permission\Models\Role;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class UserController extends ApiController
{

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            Passport::tokensExpireIn(Carbon::now()->addDays(30));
            Passport::refreshTokensExpireIn(Carbon::now()->addDays(60));

            $user = Auth::user();
            $user->token = $user->createToken('token')->accessToken;
            // {
            //     "access_token":"MTQ0NjJkZmQ5OTM2NDE1ZTZjNGZmZjI3",
            //     "token_type":"bearer",
            //     "expires_in":3600,
            //     "refresh_token":"IwOGYzYTlmM2YxOTQ5MGE3YmNmMDFkNTVk",
            //     "scope":"create"
            //   }
            //   $response['access_token'] = "invalid_request";
            //   $response['token_type'] = "invalid_request";
            //   $response['expires_in'] = "invalid_request";
            //   $response['scope'] = "invalid_request";

            return response()->json($user);
        } else {
            $response['error'] = "invalid_request";
            $response['error_description'] = "Unauthorized user";
        }
    }

    public function getToken()
    {
        $user = Auth::user();

        if(!$user){
            $response['error'] = "invalid_request";
            $response['error_description'] = "Unauthorized user";
            return response()->json($user);
        }
        $token = $user->createToken('token')->accessToken;
        // $response['']

        return response()->json($token);

        // return $this->response(true, Auth::user());
    }

    public function register(UserRequest $request)
    {
        $request->validated();

        $input = $request->all();

        try {
            $roles = $request->only(['roles']);

            $user = User::create($input);

            foreach ($roles as $user_role) {

                $role = Role::where('id', '=', $user_role)->firstOrFail();
                $user->assignRole($role);

            }

            $success['boilerplate'] = $user->createToken('boilerplate')->accessToken;

            return $this->response(true, $success, null);

        } catch (\Exception $e) {
            return $this->response(false, null, $e->getMessage());
        }

    }

    public function profile()
    {

        try {
            $user = Auth::user();
            $user->getRoleNames();

            return $this->response(true, $user);

        } catch (\Exception $e) {
            return $this->response(false, $e->getMessage());
        }
    }

    public function logout(Request $request)
    {

        try {

            $token = $request->bearerToken();
            $token_id = (new Parser())->parse($token)->getHeader('jti');
            $token = $request->user()->tokens->find($token_id);
            $token->revoke();

            return $this->response(true, 'Logged out successfully');

        } catch (\Exception $e) {

            return $this->response(false, $e->getMessage());
        }

    }

    public function testing()
    {
        return 'testing';
    }

}
