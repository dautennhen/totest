<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\PurchaseCategoryRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getItems();
        return view('purchase.category', compact('items'));
    }

    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        return view('purchase.categories.list', compact('items'));
    }

    public function create() {
        return view('purchase.categories.new');
    }

    public function store(Request $request) {
        return $this->common->responseJson($this->repo->store($request->all()));
    }

    public function show($id) {
        $item = $this->repo->getDetail($id);
        return view('purchase.categories.detail', compact('item'));
    }

    public function edit($id) {
        $item = $this->repo->getItem($id);
        return view('purchase.categories.edit', compact('item'));
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