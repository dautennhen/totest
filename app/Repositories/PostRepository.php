<?php

namespace App\Repositories;

class PostRepository {

    public function __construct() {
        $this->common = new \App\Common\Common();
        $this->item = new \App\Models\News\Posts();
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
        return $this->common->pagingSort($list, $data, false, ['title', 'author']);
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
        $arr['title'] = $data['title'];
        $arr['author'] = $data['author'];
        $arr['publish'] = $data['publish'];
        $arr['content'] = $data['content'];
        try {
            $this->item->insertGetId($arr);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($id, $data) {
        $item = $this->item->find($id);
        $item->cate_id = $data['cate_id'];
        $item->title = $data['title'];
        $item->author = $data['author'];
        $item->publish = $data['publish'];
        $item->content = $data['content'];
        return $item->save();
    }
    
    public function getToken($id) {
        return true;
    }

    // Facebook
}