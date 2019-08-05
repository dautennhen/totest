<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\SocialRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getItems();
        return view('purchase.social', compact('items'));
    }

    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        return view('purchase.socials.list', compact('items'));
    }

    public function create() {
        return view('purchase.socials.new');
    }

    public function store(Request $request) {
        return $this->common->responseJson($this->repo->store($request->all()));
    }

    public function show($id) {
        $item = $this->repo->getDetail($id);
        return view('purchase.socials.detail', compact('item'));
    }

    public function edit($id) {
        $item = $this->repo->getItem($id);
        return view('purchase.socials.edit', compact('item'));
    }

    public function update(Request $request, $alias) {
        return $this->common->responseJson($this->repo->update($alias, $request->all()));
    }

    public function destroy($id) {
        return $this->common->responseJson($this->repo->destroy($id));
    }

}
