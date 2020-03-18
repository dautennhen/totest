<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\NewsCategoryRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getItems();
        return view('news.category', compact('items'));
    }

    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        return view('news.categories.list', compact('items'));
    }

    public function create() {
        return view('news.categories.new');
    }

    public function store(Request $request) {
        return $this->common->responseJson($this->repo->store($request->all()));
    }

    public function show($id) {
        $item = $this->repo->getDetail($id);
        return view('news.categories.detail', compact('item'));
    }

    public function edit($id) {
        $item = $this->repo->getItem($id);
        return view('news.categories.edit', compact('item'));
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
    
    public function getToken($id) {
        return true;
    }

}