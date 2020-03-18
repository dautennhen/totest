<?php

namespace App\Http\Controllers\Admin\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacebookController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\FacebookRepository();
    }

    public function index() {
        //$items = $this->repo->getItems();
        //return view('acl.group', compact('items'));
        //return 'called facebook controller';
    }
    
    public function login() {
        return $this->repo->login();
    }

    public function callback() {
        //return $this->repo->callback();
        return 'called facebook controller callback';
    }
    
    public function redirect() {
        //return $this->repo->callback();
        return 'called facebook controller redirect';
    }
    
    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        return view('acl.groups.list', compact('items'));
    }

    public function create() {
        $roles = $this->repoRole->listBuilder()->get();
        return view('acl.groups.new', compact('roles'));
    }

    public function store(Request $request) {
        return $this->common->responseJson($this->repo->store($request->all()));
    }

    public function show($id) {
        $item = $this->repo->getDetail($id);
        return view('acl.groups.detail', compact('item'));
    }

    public function edit($id) {
        $item = $this->repo->getItem($id);
        $roles = $this->repoRole->listBuilder()->get();
        $arr = $item->roles;
        $itemRoles = [];
        foreach ($arr as $role) {
            $itemRoles[] = $role->id;
        }
        return view('acl.groups.edit', compact('item', 'roles', 'itemRoles'));
    }

    public function update(Request $request, $alias) {
        return $this->common->responseJson($this->repo->update($alias, $request->all()));
    }

    public function destroy($id) {
        return $this->common->responseJson($this->repo->destroy($id));
    }

}
