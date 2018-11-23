<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;

//Importing spatie laravel role model
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $request->validated();

        try{
            $input = $request->only(['name']);
            $role = Role::create($input);
            
            return response()->json(['success' => $role], 200);

        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 422);

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

        try{
            
            $input = $request->only(['name']);

            $role->fill($input)->save();

            return response()->json(['success' => $role], 200);

        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 422);

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
        
        try{
            
            return response()->json(['success' => 'deleted'], 200);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 422); 
        }
    }
}
