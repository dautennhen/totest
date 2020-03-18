<?php

namespace App\Repositories;

class NewsCategoryRepository {

    public function __construct() {
        $this->common = new \App\Common\Common();
        $this->category = new \App\Models\News\Categories();
    }

    public function getFirst() {
        return $this->category->first();
    }

    public function getItem($id) {
        return $this->category->find($id);
    }

    public function listBuilder() {
        return $this->category->select();
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
        return $this->category->find($key)->delete();
    }
    
    public function destroyItems($data) {
        return $this->category->whereIn('id', $data['items'])->delete();
    }

    public function store($data) {
        $arr['name'] = $data['name'];
        $arr['description'] = $data['description'];
        try {
            $this->category->insertGetId($arr);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($id, $data) {
        $item = $this->category->find($id);
        $item->name = $data['name'];
        $item->description = $data['description'];
        return $item->save();
    }
    
    public function getToken($id) {
        return true;
    }

}