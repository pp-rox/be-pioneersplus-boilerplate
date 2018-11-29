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
    /**
     * @SWG\SecurityScheme(
     *     securityDefinition="implicit",
     *     token_type="Bearer"
     *     type="oauth2",
     *     flow="implicit",
     *     in="header",
     * )
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            return $this->output(true, Auth::user());

        } else {
            return $this->output(false, 'Unauthorized');
        }
    }

    public function getToken()
    {
        $user = Auth::user();
        $token = $user->createToken('token')->accessToken;
        return $this->output(true, Auth::user());
    }

    /**
     * @SWG\Post(
     *     path="/register",
     *     summary="Register user",
     *     tags={"user"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(
     *              title="User",
     *              type="object",
     *              @SWG\Property(property="first_name", type="string"),
     *              @SWG\Property(property="last_name", type="string"),
     *              @SWG\Property(property="username", type="string"),
     *              @SWG\Property(property="email", type="string"),
     *              @SWG\Property(property="role", type="integer"),
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="success",
     *          @SWG\Schema(ref="#/definitions/User"),
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="error details",
     *     ),
     *     security={{"Bearer":{}}}
     * )
     */
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

            return $this->output(true, $success);

        } catch (\Exception $e) {
            return $this->output(false, $e->getMessage());
        }

    }

    /**
     * @SWG\Get(
     *     path="/profile",
     *     tags={"user"},
     *     summary="User's Profile",
     *     @SWG\Response(
     *          response=200,
     *          description="success",
     *          @SWG\Schema(ref="#/definitions/User"),
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="error details",
     *
     *     ),
     *     security={{"Bearer":{}}}
     * )
     */
    public function profile()
    {

        try {
            $user = Auth::user();
            $user->getRoleNames();

            return $this->output(true, $user);

        } catch (\Exception $e) {
            return $this->output(false, $e->getMessage());
        }
    }

    /**
     * @SWG\Get(
     *     path="/logout",
     *     tags={"user"},
     *     summary="Logout",
     *      @SWG\Response(
     *          response=200,
     *          description="success",
     *
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *
     *     ),
     *     security={{"Bearer":{}}}
     * )
     */
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
