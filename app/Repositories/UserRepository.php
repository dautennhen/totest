<?php

namespace App\Repositories;

//use Illuminate\Database\Eloquent\Model;
//use App\Models\User as User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Storage;
//use DateTime;
//use DateInterval;
//use DatePeriod;

class UserRepository {

    public function __construct() {
        $this->user = new \App\Models\User();
        $this->common = new \App\Common\Common();
        $this->repoAcl = new \App\Repositories\AclRepository();
    }

    public function getFirst() {
        return $this->user->first();
    }

    public function getItem($id) {
        return $this->user->find($id);
    }

    public function listBuilder() {
        return $this->user->select();
    }

    public function getItems($data = []) {
        $list = $this->listBuilder();
     //   $fields = $data['fields'];
     //   dd($fields);
        return $this->common->pagingSort($list, $data, false, ['name', 'username', 'email']);
    }

    public function getListJson($data) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data)->toJson();
    }

    public function destroy($key) {
        return $this->user->find($key)->delete();
    }
    
    public function destroyItems($data) {
        //return $this->user->destroy($data['items']);
        //return $this->user->whereIn('id', $data['items'])->delete();
        return $this->user->whereIn('id', $data['items'])->update([
            'deleted_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    public function store($data) {
        $valid = $this->user->isValid($data);
        if ($valid !== true)
            return $valid;
        $item = $this->user->where('email', '=', $data['email'])->count();
        if($item)
            return false;
        $this->user->name = $data['name'];
        $this->user->username = $data['username'];
        $this->user->email = $data['email'];
        $this->user->group_id = $data['group_id'];
        return $this->user->save();
    }

    public function update($id, $data) {
        if (!$this->user->isValid($data))
            return false;
        $item = $this->user->find($id);
        $item->name = $data['name'];
        $item->username = $data['username'];
        $item->email = $data['email'];
        $item->group_id = $data['group_id'];
        return $item->save();
    }
    
//=======================================================
    public function check_email_exist($email) {
        return User::where('email', '=', $email)->first();
    }

    public function checkLogin(array $arr) {
        $user = DB::table('users')->select('user_group.group_id')
                ->join('user_group', 'user_group.user_id', '=', 'users.id')
                ->where(['users.email' => $arr['email']])
                ->whereNotIn('status', ['pending'])
                ->first();
        return $user;
    }

    public function getUserByUserId($user_id) {
        return $this->user->find($user_id);
    }

    public function getUserByTocken($confirmCode) {
        return $this->user->where([['confirmation_code', $confirmCode], ['status', 'pending']])->first();
    }

}
