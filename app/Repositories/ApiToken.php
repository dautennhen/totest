<?php

namespace App\Repositories;

use Auth;
use Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApiToken {

    public $token;
    private $lifetime = 30;

    public function __construct() {
        $this->token = app('App\Models\Acl\Tokens');
        $this->common = new \App\Common\Common();
    }

    public function getFirst() {
        return $this->token->first();
    }
    
    public function listBuilder() {
        return DB::table('tokens')->select();
    }
    
    public function getList($data=[]) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data, false, ['username', 'revoked']);
    }
    //----------------------------------------------
    public function isValid() {
        $api_token = Request::bearerToken();
        $now = Carbon::now()->toDateTimeString();
        $token = $this->token
                ->where('api_token', $api_token)
                ->where('revoked', 0)
                ->get()->first();
        $token = empty($token->expires_on) ? '' : $token->expires_on;
        return (!empty($token) && ($now<$token) ) ? true : false;
    }

    public function check($data) {
        return Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
    }

    public function getByToken() {
        return $this->token->where('api_token', $api_token)->get();
    }

    public function generateTokenString() {
        return str_random(60);
    }

    public function create($user_id='') {
        /*$data = Request::all();
        if (!$this->check($data))
            return false;*/
        if(empty($user_id))
            $user_id = Auth::user()->id;
        $data = [
            'api_token' => $this->generateTokenString(),
            'user_id' => $user_id,
            'client' => '',//$_SERVER['HTTP_USER_AGENT'],
            'expires_on' => Carbon::now()->addDays($this->lifetime)
        ];
        return $this->token->create($data);
    }

    public function refreshNewToken() {
        $item = $this->getByToken()->first();
        $item->api_token = $this->generateTokenString();
        return $item->save();
    }

    public function delete($id) {
        return $this->token->find($id)->delete();
    }
    
    public function revoke($id, $revoked = 1) {
        $item = $this->token->find($id);
        $item->revoked = $revoked;
        $item->save();
    }

    public function isExpired() {
        $now = Carbon::now()->toDateTimeString();
        $expire_on = $this->token->expires_on;
        return ($now > $expire_on);
    }
    
    public function getUserByToken() {
        $api_token = Request::bearerToken();
        $result = DB::table('users')->select('users.*')
                ->join('tokens', 'tokens.user_id','=','users.id')
                ->where(['tokens.api_token' => $api_token])
                ->first();
        return $result;
    }
    
    public function deleteByUserid($user_id) {
        return $this->token->where('user_id',$user_id)->delete();
    }
    
    public function selectByUserid($user_id) {
        return $this->token->where('user_id',$user_id)->first();
    }

}
