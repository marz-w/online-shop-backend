<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function createRole(Request $request){

    $request->validate([
        'name'=> 'required|string|unique:roles,name',
        'description'=> 'string|max:1000'
    ]);

    $role = new Role();
    $role->name = $request->name;
    $role->description = $request->description;

    try{
        $role->save();
        return response()->json([
            'message'=>'Role saved successfully',
            'role'=>$role
        ],200);

    }catch(\Exception $e){
        $role->save();
        return response()->json([
            'message'=>'Failed to save',
            'error'=>$e->getMessage()
        ],500);

    }

    }

    public function readAll(){
        try{
            $roles = Role::all();
            return response()->json([
                'roles'=>$roles
            ],200);
        } catch(\Exception $e){
        return response()->json([
            'message'=>'Failed to fetch',
            'error'=>$e->getMessage()
        ],500);
    }
    }

    public function read($id){
        try{
            $role = Role::where('id', $id) ->first();
            return response()->json([
                'role'=>$role
            ],200);
        } catch(\Exception $e){
        return response()->json([
            'message'=>'Failed to fetch',
            'error'=>$e->getMessage()
        ],500);
    }
    }

    public function updateRole($id, Request $request){

    $request->validate([
        'name'=> 'required|string',
        'description'=> 'string|max:1000'
    ]);

    $role = role::where('id', $id)->first();
    $role->name = $request->name;
    $role->description = $request->description;

    try{
        $role->save();
        return response()->json([
            'message'=>'Role updated successfully',
            'role'=>$role
        ],200);

    }catch(\Exception $e){
        $role->save();
        return response()->json([
            'message'=>'Failed to update',
            'error'=>$e->getMessage()
        ],500);

    }

    }
    public function deleteRole($id){
        try{
            $role = Role::where('id', $id)->first();
            if($role){
                $role->delete();
            return response()->json('Role deleted successfully');
            } else {
                return response()->json('Role not found');
            }
        } catch(\Exception $e){
        return response()->json([
            'message'=>'Failed to delete',
            'error'=>$e->getMessage()
        ],500);
    }
    }
}
