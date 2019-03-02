<?php

namespace App\Http\Controllers\Zipcode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Resources\User as UserResource;
//use App\Http\Resources\UserCollection as UserCollection;
//use App\Models\User;
use App\Models\Zipcode as Zipcode;
use App\Repositories\ZipCodeRepository as ZipCodeRepository;

class ZipcodeController extends Controller
{
    protected $zipcodeRepo;
    
    public function __construct() {
        
        $this->zipcodeRepo = new ZipCodeRepository;
    }
    
    public function index()
    {
    }
    
    public function getList()
    {
        $zipcodes = $this->zipcodeRepo->getList(null);
        return view('zipcode.list',compact('zipcodes'));
    }
    
    public function getItem($id)
    {
        $zipcode = Zipcode::find($id);
        return view('zipcode.detail',compact('zipcode'));
    }
    
    public function newItem()
    {
        return view('zipcode.new');
    }
    
    public function editItem($id)
    {
        $zipcode = Zipcode::find($id);
        return view('zipcode.edit',compact('zipcode'));
    }
}
