<?php

namespace App\Http\Controllers\Zipcode\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Resources\User as UserResource;
//use App\Http\Resources\UserCollection as UserCollection;
//use App\Models\User;
//use App\Models\Book as Book;
use App\Repositories\ZipCodeRepository as ZipCodeRepository;

class ZipcodeAjaxController extends Controller
{
    //private $common;
    protected $zipcodeRepo;
    
    public function __construct() {
        parent::__construct();
        $this->zipcodeRepo = new ZipCodeRepository;
    }
    
    public function index()
    {
        
    }
    
    public function remove($id) {
        return $this->common->responseJson($this->zipcodeRepo->remove($id));
    }
    
    public function save($id, Request $request) {
        return $this->common->responseJson($this->zipcodeRepo->save($id, $request->all()));
    }
    /*
    public function saveNew($id, Request $request) {
        return $this->common->responseJson($this->zipcodeRepo->save($id, $request->all()));
    }*/
}
