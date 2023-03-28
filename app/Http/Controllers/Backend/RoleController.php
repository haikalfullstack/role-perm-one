<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Permissions
    public function AllPermissions(){
        $permissions = Permission::all();
        return view('backend.pages.permissions.all_permissions', compact('permissions'));
    }

    public function AddPermissions(){
        return view('backend.pages.permissions.add_permissions');
    }

    public function StorePermissions(Request $request){
        $permissions = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        
        $notification = array(
            'message' => 'Permission Inserted Sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permissions')->with($notification);
    }

    public function EditPermissions($id){
        $permissions = Permission::findOrFail($id);
        return view('backend.pages.permissions.edit_permissions', compact('permissions'));
    }

    public function UpdatePermissions(Request $request ){
        $perm_id = $request->id;
        $permissions = Permission::findOrFail($perm_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        
        $notification = array(
            'message' => 'Permission Updated Sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permissions')->with($notification);
    }

    public function DeletePermissions($id){
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted Sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
    } 
    // end permissions


    // Roles
    public function AllRoles(){
        $roles = Role::all();
        return view('backend.pages.permissions.all_roles', compact('roles'));
    }

    public function AddRoles(){
        return view('backend.pages.permissions.add_roles');
    }

    public function StoreRoles(Request $request){
        $roles = Role::create([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Roles Created Sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }

    public function EditRoles($id){
        $roles = Role::findOrFail($id);
        return view('backend.pages.permissions.edit_roles', compact('roles'));
    }

    public function UpdateRoles(Request $request ){
        $role_id = $request->id;
        $roles =  Role::findOrFail($role_id)->update([
            'name' => $request->name,
            
        ]);

        
        $notification = array(
            'message' => 'Roles Updated Sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id){
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Roles Deleted Sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
    } 
    // End Roles


    // Roles in Permissions
    public function AddRolesPermissions(){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.pages.permissions.add_roles_permissions', compact('roles', 'permissions'));
    }
}
