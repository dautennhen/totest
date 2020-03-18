<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\PostRepository();
        $this->repoCate = new \App\Repositories\NewsCategoryRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getItems();
        $cates = $this->repoCate->listBuilder()->get();
        return view('news.post', compact('items', 'cates'));
    }

    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        $cates = $this->repoCate->listBuilder()->get();
        return view('news.posts.list', compact('items', 'cates'));
    }

    public function create() {
        $cates = $this->repoCate->listBuilder()->get();
        return view('news.posts.new', compact('cates'));
    }

    public function store(Request $request) {
        return $this->common->responseJson($this->repo->store($request->all()));
    }

    public function show($id) {
        $item = $this->repo->getDetail($id);
        return view('news.posts.detail', compact('item'));
    }

    public function edit($id) {
        $item = $this->repo->getItem($id);
        $cates = $this->repoCate->listBuilder()->get();
        return view('news.posts.edit', compact('item', 'cates'));
    }

    public function update(Request $request, $alias) {
        return $this->common->responseJson($this->repo->update($alias, $request->all()));
    }

    public function destroy($id) {
        return $this->common->responseJson($this->repo->destroy($id));
    }

    public function destroyItems(Request $request) {
        return $this->common->responseJson($this->repo->destroyItems($request->all()));
    }

}
