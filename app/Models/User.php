<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;
use App\Models\User;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPermissionsGroups(){
        $permissions_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return $permissions_groups;
    }

    public static function getPermissionsByGroupName($group_name){
        $permissions = DB::table('permissions')->select('name', 'id')
                        ->where('group_name', $group_name)
                        ->get();
       
        return $permissions;
    }

    public static  function rolesHasPermissions($roles, $permissions){
        $hasPermissions = true;
        foreach ($permissions  as $permission  ) {
            if(!$roles->hasPermissionTo($permission->name)){
                $hasPermissions = false;
                return $hasPermissions;
            }

      
            return $hasPermissions;
        }

      
    }
}
