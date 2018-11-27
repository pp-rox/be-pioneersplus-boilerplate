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

            $user = Auth::user();
            $success['token'] = $user->createToken('token')->accessToken;

            return response()->json(['success' => $success], 200);

        } else {
            return $this->output(false, 'Unauthorized');
        }
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

            $success['token'] = $user->createToken('token', $input['scopes'])->accessToken;

            return $this->output(true, $success);

        } catch (\Exception $e) {
            return $this->output(false, $e->getMessage());
        }

    }

    public function profile()
    {

        try {

            $user = Auth::user();
            $success['data'] = $user;

            return $this->output(true, $user);

        } catch (\Exception $e) {
            return $this->output(false, $e->getMessage());
        }

    }

    public function testing()
    {
        return $this->output(false, 'testing');

    }

    public function logout(Request $request)
    {

        try {

            $token = $request->bearerToken();
            $token_id = (new Parser())->parse($token)->getHeader('jti');
            $token = $request->user()->tokens->find($token_id);
            $token->revoke();
            
            return $this->output(true, 'Logged out successfully');

        } catch (\Exception $e) {

            return $this->output(false, $e->getMessage());
        }

    }

}
