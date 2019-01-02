<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;

//Importing spatie laravel role model
use Spatie\Permission\Models\Role;



class RoleController extends ApiController
{
    public function index()
    {
        return $this->response(true, Role::all());
    }

    public function store(RoleRequest $request)
    {
        $request->validated();

        try {
            $input = $request->only(['name']);
            $role = Role::create($input);

            return $this->response(true, $role);

        } catch (\Exception $e) {
            return $this->response(false, $e->getMessage());
        }
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validated();

        try {

            $input = $request->only(['name']);

            $role->fill($input)->save();

            return $this->response(true, $role);

        } catch (\Exception $e) {
            return $this->response(false, $e->getMessage());
        }

    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        try {
            $role->delete();
            return $this->response(true, Role::all());
        } catch (\Exception $e) {
            return $this->response(false, $e->getMessage());
        }
    }
}
