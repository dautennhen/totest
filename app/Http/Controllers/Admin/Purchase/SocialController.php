<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialController extends Controller {

    private $cates = [
        'facebook' => 'facebook',
        'instagram' => 'instagram',
        'youtube' => 'youtube',
        'twitter' => 'twitter'
    ];
    
    private $status = [
        'inactive' => 'inactive',
        'active' => 'active'
    ];

    public function __construct() {
        $this->repo = new \App\Repositories\SocialRepository();
        $this->repoCate = new \App\Repositories\PurchaseCategoryRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getItems();
        $cates = $this->cates;
        $status = $this->status;
        return view('purchase.social', compact('items', 'cates', 'status'));
    }

    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        $cates = $this->cates;
        $status = $this->status;
        return view('purchase.socials.list', compact('items', 'cates', 'status'));
    }

    public function create() {
        $cates = $this->cates;
        $status = $this->status;
        return view('purchase.socials.new', compact('cates', 'status'));
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
        $cates = $this->cates;
        $status = $this->status;
        return view('purchase.socials.edit', compact('item', 'cates', 'status'));
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
