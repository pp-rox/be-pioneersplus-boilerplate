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
        return $this->output(true, Role::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
