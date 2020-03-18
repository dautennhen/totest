<?php

namespace App\Http\Controllers\Admin\Acl;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Repositories\PermissionRepository as PermissionRepository;

class TokenController extends Controller
{
    protected $repo;
    //protected $common;
    
    public function __construct() {
        $this->repo = new \App\Repositories\ApiToken();
        $this->common = new \App\Common\Common();
    }
    
    public function index()
    {
        $items = $this->repo->getList();
        return view('acl.token',compact('items'));
    }
    
    public function items(Request $request)
    {
        $items = $this->repo->getList( $request->all() );
        return view('acl.tokens.list',compact('items'));
    }
    
    public function create()
    {
        return view('acl.tokens.new');
    }
    
    public function store(Request $request)
    {
        return $this->common->responseJson($this->repo->store( $request->all() ));
    }
    
    public function show($id)
    {
        $item = $this->repo->getDetail($id);
        return view('acl.permissions.detail', compact('item') );
    }
    
    public function edit($id)
    {
        $item = $this->repo->getDetail($id);
        return view('acl.permissions.edit', compact('item') );
    }
    
    public function update(Request $request, $alias)
    {
        return $this->common->responseJson($this->repo->update($alias, $request->all()));
    }
    
    public function destroy($id)
    {
        return $this->common->responseJson($this->repo->destroy($id));
    }
    
}