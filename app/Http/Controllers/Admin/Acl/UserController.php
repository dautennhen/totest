<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\UserRepository();
        $this->repoGroup = new \App\Repositories\GroupRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getItems();
        return view('acl.user', compact('items'));
    }

    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        return view('acl.users.list', compact('items'));
    }

    public function create() {
        $groups = $this->repoGroup->listBuilder()->get();
        return view('acl.users.new', compact('groups'));
    }

    public function store(Request $request) {
        return $this->common->responseJson($this->repo->store($request->all()));
    }

    public function show($id) {
        $item = $this->repo->getDetail($id);
        return view('acl.roles.detail', compact('item'));
    }

    public function edit($id) {
        $item = $this->repo->getItem($id);
        $groups = $this->repoGroup->listBuilder()->get();
        $arr = $item->groups;
        return view('acl.users.edit', compact('item', 'groups'));
    }

    public function update(Request $request, $id) {
        return $this->common->responseJson($this->repo->update($id, $request->all()));
    }

    public function destroy($id) {
        return $this->common->responseJson($this->repo->destroy($id));
    }
    
    public function destroyItems(Request $request) {
        return $this->common->responseJson($this->repo->destroyItems($request->all()));
    }

}