<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\RoleRepository();
        $this->repoPermission = new \App\Repositories\PermissionRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getList();
        return view('acl.role', compact('items'));
    }

    public function items(Request $request) {
        $items = $this->repo->getList($request->all());
        return view('acl.roles.list', compact('items'));
    }

    public function create() {
        $permissions = $this->repoPermission->listBuilder()->get();
        return view('acl.roles.new', compact('permissions'));
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
        $permissions = $this->repoPermission->listBuilder()->get();
        $arr = $item->permissions;
        $itemPermissions = [];
        foreach ($arr as $permission) {
            $itemPermissions[] = $permission->alias;
        }
        return view('acl.roles.edit', compact('item', 'permissions', 'itemPermissions'));
    }

    public function update(Request $request, $alias) {
        return $this->common->responseJson($this->repo->update($alias, $request->all()));
    }

    public function destroy($id) {
        return $this->common->responseJson($this->repo->destroy($id));
    }

}