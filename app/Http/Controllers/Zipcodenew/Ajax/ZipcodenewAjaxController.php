<?php

namespace App\Http\Controllers\Zipcodenew\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Resources\User as UserResource;
//use App\Http\Resources\UserCollection as UserCollection;
//use App\Models\User;
use App\Models\Zipcode as Zipcode;

use App\Repositories\ZipCodeRepository as ZipCodeRepository;

class ZipcodenewAjaxController extends Controller
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
    
    public function newItem()
    {
        return view('zipcodenew.new');
    }
    
    public function editItem($id)
    {
        $zipcode = new Zipcode();
        $zipcode = $zipcode->find($id);
        return view('zipcodenew.edit', compact('zipcode'));
    }
    
    public function saveNew($id, $data) {
        $this->zipcode->zipcode = $data['zipcode'];
        $this->zipcode->city = $data['city'];
        return $this->zipcode->save();
    }
    
    public function getList(Request $request)
    {
        $zipcodes = $this->zipcodeRepo->getList( $request->all() );
        return view('zipcodenew.list',compact('zipcodes'));
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
