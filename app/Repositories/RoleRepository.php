<?php

namespace App\Repositories;

use DB;

class RoleRepository {
    private $common;
    private $role;
    
    public function __construct() {
        $this->role = new \App\Models\Acl\Roles();
        $this->common = app('App\Common\Common');
        $this->repoAcl = new \App\Repositories\AclRepository();
    }
    
    public function getFirst() {
        return $this->role->first();
    }
    
    public function getItem($id) {
        return $this->role->find($id);
    }
    
    public function listBuilder() {
        return $this->role->select();
    }
    
    public function getList($data=[]) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data, false, ['name', 'description']);
    }

    public function getListJson($data) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data)->toJson();
    }
    
    public function destroy($key) {
        return $this->role->find($key)->delete();
    }
    
    public function store($data) {
        $arr['name'] = $data['name'];
        $arr['description'] = $data['description'];
        DB::beginTransaction();
        try {
            $role_id = $this->role->insertGetId($arr);
            $permissions = $data['permissions'];
            $role = $this->role->find($role_id);
            if(!empty($permissions))
                $this->repoAcl->roleAttachPermissions($role_id, $permissions);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
    
    public function update($id, $data) {
        $role = $this->role->find($id);
        $role->name = $data['name'];
        $role->description = $data['description'];
        $permissions = $data['permissions'];
        DB::beginTransaction();
        try {
            $role->save();
            if(!empty($permissions))
                $role->permissions()->sync($permissions);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
    
    public function attachPermissions($group_id, $permissions) {
        $this->repoAcl->roleAttachPermissions($group_id, $permission);
    }
}
