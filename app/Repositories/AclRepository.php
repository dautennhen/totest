<?php

namespace App\Repositories;

/*use App\Models\User;
use App\Models\Group;
use App\Models\Permission;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AclRepository {

    public $user;
    public $role;
    public $group;
    public $permission;

    public function __construct(){ //User $user, Group $group, Permission $permission) {
        $this->user = new \App\Models\User;
        $this->group = new \App\Models\Acl\Groups;
        $this->permission = new \App\Models\Acl\Permissions;
        $this->role = new \App\Models\Acl\Roles;
    }

    public function createGroup($name, $description = '') {
        $find = $this->group->where('name', $name)->first();
        if (!empty($find)) {
            return false;
        } else {
            $this->group->name = $name;
            $this->group->description = $description;
            return $this->group->save();
        }
    }

    /*public function attachUserToGroup($group_id, $user_id) {
        $group = $this->group->find($group_id);
        $user = $this->user->find($user_id);
        if (!empty($group) && !empty($user)) {
            if (!$group->users->contains($user->id))
                return $group->users()->attach($user->id);
            return 1;
        }
        return 0;
    }*/
    
    public function attachRoleToGroup($group_id, $roles) {  
        $group = $this->group->find($group_id);
        return $group->roles()->sync($roles);
    }
    
    public function dettachRoleToGroup($group_id, $role_id) {  
        $group = $this->group->find($group_id);
        return $group->dettach([$role_id]);
    }

    public function dettachUserFromGroup($group_id, $user_id) {
        $group = $this->group->find($group_id);
        if (!empty($group)) {
            if (!$group->users->contains($user_id))
                return 1;
            return $group->users()->detach($user_id);
        }
        return 0;
    }

    static public function userGetPermissions($user_id) {
        // $user = Auth::user();
        if (!empty($user_id)) {
            $results = DB::select('SELECT p.alias FROM permissions p 
                                LEFT JOIN group_permission gp ON p.id=gp.permission_id 
                                LEFT JOIN groups g ON gp.group_id = g.id
                                WHERE g.id  IN (
                                    SELECT ug.group_id FROM users u
                                    LEFT JOIN user_group ug ON u.id = ug.user_id
                                    WHERE u.id = ' . $user_id . '
                                )');
            $alias = [];
            foreach ($results as $permission) {
                $alias[] = $permission->alias;
            }
            return $alias;
        }
        return [];
    }

    static public function userHasPermission($user_id, $permission) {
        $permissions = self::userGetPermissions($user_id);
        return in_array($permission, $permissions);
    }

    public function createPermission($name, $alias, $description = '') {
        $find = $this->permission->where('alias', $alias)->first();
        if (!empty($find)) {
            return 0;
        } else {
            $permission = $this->permission;
            $permission->name = $name;
            $permission->alias = $alias;
            $permission->description = $description;
            return $permission->save();
        }
    }

    public function roleAttachPermissions($role_id, $permissions) {
        $role = $this->role->find($role_id);
        return $role->permissions()->attach($permissions);
    }

    public function roleSyncPermissions($role, $permissions) {
        return $role->permissions()->dettach($permissions);
    }

    public function cachePermission($permissions) {
        Session::put('user_permission', $permissions);
    }

    public function deleteCachePermission() {
        Session::forget('user_permission');
    }
    
    public function getUserGroup($id) {
        $result = DB::table('users')->select('groups.name')
                ->join('user_group', 'user_group.user_id','=','users.id')
                ->join('groups', 'groups.id','=','user_group.group_id')
                ->where(['users.id' => $id])
                ->first();
        //dd($result);
        return empty($result->name) ? '' : $result->name;
    }

}
