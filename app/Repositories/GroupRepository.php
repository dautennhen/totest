<?php

namespace App\Repositories;

use DB;
//use App\Repositories\AclRepository;

class GroupRepository {
    //private $common;
    //private $group;
    
    public function __construct() {
        $this->common = new \App\Common\Common();
        $this->group = new \App\Models\Acl\Groups();
        $this->repoAcl = new \App\Repositories\AclRepository();
    }
    
    public function getFirst() {
        return $this->group->first();
    }
    
    public function getItem($id) {
        return $this->group->find($id);
    }
    
    public function listBuilder() {
        return $this->group->select();
    }
    
    public function getItems($data=[]) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data, false, ['name', 'description']);
    }

    public function getListJson($data) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data)->toJson();
    }
    
    // Ajax
    public function destroy($key) {
        return $this->group->find($key)->delete();
    }
    
    public function store($data) {
        $arr['name'] = $data['name'];
        $arr['description'] = $data['description'];
        DB::beginTransaction();
        try {
            $group_id = $this->group->insertGetId($arr);
            $roles = $data['roles'];
            //dd($group_id);
            if(!empty($roles))
                $this->repoAcl->attachRoleToGroup($group_id, $roles);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
    
    public function update($id, $data) {
        $group = $this->group->find($id);
        $group->name = $data['name'];
        $group->description = $data['description'];
        $roles = $data['roles'];
        $group->save();
        return $group->roles()->sync($roles);
        /*
        DB::beginTransaction();
        try {
            $group_id = $this->group->insertGetId($arr);
            $roles = $data['roles'];
            if(!empty($roles))
                $this->repoAcl->attachRoleToGroup($group_id, $roles);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
         * *
         */
    }
}
