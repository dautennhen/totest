<?php

namespace App\Repositories;

use DB;

class SocialRepository {

    public function __construct() {
        $this->common = new \App\Common\Common();
        $this->social = new \App\Models\Purchase\Socials();
    }

    public function getFirst() {
        return $this->social->first();
    }

    public function getItem($id) {
        return $this->social->find($id);
    }

    public function listBuilder() {
        return $this->social->select();
    }

    public function getItems($data = []) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data, false, ['name', 'description']);
    }

    public function getListJson($data) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data)->toJson();
    }

    // Ajax
    public function destroy($key) {
        return $this->social->find($key)->delete();
    }
    
    public function destroyItems($data) {
        //return $this->social->destroy($data['items']);
        return $this->social->whereIn('id', $data['items'])->delete();
        //return $this->user->whereIn('id', $data['items'])->update([
        //    'deleted_at' => Carbon::now()->format('Y-m-d H:i:s')
        //]);
    }

    public function store($data) {
        $arr['status'] = $data['status'];
        $arr['username'] = $data['username'];
        $arr['password'] = $data['password'];
        $arr['cate_id'] = $data['cate_id'];
        DB::beginTransaction();
        try {
            $this->social->insertGetId($arr);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function update($id, $data) {
        $item = $this->social->find($id);
        $item->status = $data['status'];
        $item->username = $data['username'];
        $item->password = $data['password'];
        $item->cate_id = $data['cate_id'];
        return $item->save();
    }
    
    public function getToken($id) {
        return true;
    }

}