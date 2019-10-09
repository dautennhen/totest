<?php

namespace App\Repositories;

use DB;

class ProductRepository {

    public function __construct() {
        $this->common = new \App\Common\Common();
        $this->item = new \App\Models\Purchase\Products();
    }

    public function getFirst() {
        return $this->item->first();
    }

    public function getItem($id) {
        return $this->item->find($id);
    }

    public function listBuilder() {
        return $this->item->select();
    }

    public function getItems($data = []) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data, false, ['name', 'price', 'description']);
    }

    public function getListJson($data) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data)->toJson();
    }

    // Ajax
    public function destroy($key) {
        return $this->item->find($key)->delete();
    }
    
    public function destroyItems($data) {
        return $this->item->whereIn('id', $data['items'])->delete();
    }

    public function store($data) {
        $arr['cate_id'] = $data['cate_id'];
        $arr['name'] = $data['name'];
        $arr['price'] = $data['price'];
        $arr['video'] = $data['video'];
        $arr['description'] = $data['description'];
        $arr['property'] = empty($data['property']) ? '{}' : $data['property'];
        $arr["image"] = $data["image"]; 
        try {
            $this->item->insertGetId($arr);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($id, $data) {
        $item = $this->item->find($id);
        $item->name = $data['name'];
        $item->price = $data['price'];
        $item->video = $data['video'];
        $item->image = $data['image'];
        $item->cate_id = $data['cate_id'];
        $item->description = $data['description'];
        $arr['property'] = empty($data['property']) ? '{}' : $data['property'];
        return $item->save();
    }
    
    public function getToken($id) {
        return true;
    }

    // Facebook
}