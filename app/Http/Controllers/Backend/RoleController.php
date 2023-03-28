<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    
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
}
