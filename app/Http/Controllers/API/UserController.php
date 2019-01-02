<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\jwt\Parser;
use Spatie\Permission\Models\Role;

class UserController extends ApiController
{
    
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            return $this->response(true, Auth::user());

        } else {
            return $this->response(false, 'Unauthorized');
        }
    }

    public function getToken()
    {
        $user = Auth::user();
        $token = $user->createToken('token')->accessToken;
        return $this->response(true, Auth::user());
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

            $success['token'] = $user->createToken('token')->accessToken;

            return $this->response(true, $success);

        } catch (\Exception $e) {
            return $this->response(false, $e->getMessage());
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

}
