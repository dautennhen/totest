<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;

class UploadController extends Controller {

    public function __construct() {
        $this->common = new \App\Common\Common();
    }

    public function index() {
    }

    public function destroy($folder, $inputname) {
        return view('backup');
    }
    
    public function storeMulti($folder, $inputname) {
        $rename = date('YmdHis');
        $result = $this->common->uploadMulti($folder, $inputname, $rename);
        if ($result)
            return $this->common->responseJson(true, 200, '', ['path' => $result]);
        return $this->common->responseJson(false);
    }

}
