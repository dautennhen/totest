<?php

namespace App\Repositories;
use DB;

class PermissionRepository {
    private $common;
    private $permission;
    
    public function __construct() {
        $this->common = app('App\Common\Common');
        $this->permission = app('App\Models\Acl\Permissions');
    }
    
    public function getFirst() {
        return $this->permission->first();
    }
    
    public function getDetail($id) {
        return $this->permission->find($id);
    }
    
    public function listBuilder() {
        return DB::table('permissions')->select();
    }
    
    public function getList($data=[]) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data, false, ['alias', 'name', 'description']);
    }

    public function getListJson($data) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data)->toJson();
    }
    
    // Ajax
    public function destroy($key) {
        return $this->permission->find($key)->delete();
    }
    
    public function store($data) {
        $this->permission->alias = $data['alias'];
        $this->permission->name = $data['name'];
        $this->permission->description = $data['description'];
        return $this->permission->save();
    }
    
    public function update($id, $data) {
        $permission = $this->permission->find($id);
        $permission->alias = $data['alias'];
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        return $permission->save();
    }
}
