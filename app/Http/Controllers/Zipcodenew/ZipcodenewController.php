<?php

namespace App\Http\Controllers\Zipcodenew;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Resources\User as UserResource;
//use App\Http\Resources\UserCollection as UserCollection;
//use App\Models\User;
use App\Models\Zipcode as Zipcode;
use App\Repositories\ZipCodeRepository as ZipCodeRepository;

class ZipcodenewController extends Controller
{
    protected $zipcodeRepo;
    
    public function __construct() {
        
        $this->zipcodeRepo = new ZipCodeRepository;
    }
    
    public function index()
    {
    }
    
    public function getList(Request $request)
    {
        $zipcodes = $this->zipcodeRepo->getList( $request->all() );
        return view('zipcodenew.index',compact('zipcodes'));
    }
    
    public function getItem($id)
    {
        $zipcode = Zipcode::find($id);
        return view('zipcode.detail',compact('zipcode'));
    }
    
    public function newItem()
    {
        return view('zipcodenew.new_');
    }
    
    public function editItem($id)
    {
        $zipcode = Zipcode::find($id);
        return view('zipcode.edit',compact('zipcode'));
    }
}
