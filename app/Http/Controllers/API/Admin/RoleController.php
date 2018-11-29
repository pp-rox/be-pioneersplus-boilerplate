<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;

//Importing spatie laravel role model
use Spatie\Permission\Models\Role;



class RoleController extends ApiController
{
    /**
     *  @SWG\Get(
     *     path="/api/roles",
     *     tags={"roles"},
     *     summary="Get all roles",
     *     produces={"application/json"},
     *     @SWG\Response(
     *          response=200,
     *          description="data",
     *          @SWG\Schema(ref="#/definitions/Role Response")
     *          
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="error details",
     *
     *     ),
     *     security={{"Bearer":{}}}
     * )
     *
     */
    public function index()
    {
        return $this->output(true, Role::all());
    }

    /**
     *  @SWG\Post(
     *     path="/roles/{id}",
     *     tags={"roles"},
     *     summary="Create new role",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Role")
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="data",
     *          @SWG\Schema(ref="#/definitions/Role Response")

     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="error details",
     *
     *     ),
     *     security={{"Bearer":{}}},
     * )
     *
     */
    public function store(RoleRequest $request)
    {
        $request->validated();

        try {
            $input = $request->only(['name']);
            $role = Role::create($input);

            return $this->output(true, $role);

        } catch (\Exception $e) {
            return $this->output(false, $e->getMessage());
        }
    }

    /**
     *  @SWG\PUT(
     *     path="/roles/{id}",
     *     tags={"roles"},
     *     summary="Update a role",
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Role")
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="data",
     *          @SWG\Schema(ref="#/definitions/Role Response")
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="error details",
     *
     *     ),
     *     security={{"Bearer":{}}}
     * )
     *
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validated();

        try {

            $input = $request->only(['name']);

            $role->fill($input)->save();

            return $this->output(true, $role);

        } catch (\Exception $e) {
            return $this->output(false, $e->getMessage());
        }

    }

    /**
     *  @SWG\DELETE(
     *     path="/roles/{id}",
     *     tags={"roles"},
     *     summary="Delete a role",
     *     @SWG\Response(
     *          response=200,
     *          description="data",
     *          @SWG\Schema(ref="#/definitions/Role Response")
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="error details",
     *
     *     ),
     *     security={{"Bearer":{}}}
     * )
     *
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        try {
            $role->delete();
            return $this->output(true, Role::all());
        } catch (\Exception $e) {
            return $this->output(false, $e->getMessage());
        }
    }
}
