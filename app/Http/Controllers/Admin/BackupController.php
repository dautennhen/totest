<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BackupController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\BackupRepository();
        $this->common = new \App\Common\Common();
    }
    
    public function index() {
        $items = $this->repo->getItems();
        return view('backup', compact('items'));
    }

    public function destroy($filename) {
        return $this->common->responseJson($this->repo->destroy($filename));
    }

    public function store() {
        return $this->common->responseJson($this->repo->store());
    }
    
    public function edit() {
    }
    
    public function update() {
    }
    
    public function restore() {
        return view('backup');
    }

}
