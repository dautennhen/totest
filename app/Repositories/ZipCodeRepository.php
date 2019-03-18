<?php

namespace App\Repositories;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Zipcode;
use Faker\Generator as Faker;

class ZipCodeRepository {
    private $common;
    private $zipcode;
    
    public function __construct() {
        $this->common = app('App\Common\Common');
        $this->zipcode = app('App\Models\Zipcode');
    }
    
    public function getFirst(){
        $zipcode = new Zipcode();
        return $zipcode->first();
    }
    
    public function getDetail($id){
        $zipcode = new Zipcode();
        return $zipcode->find($id);
    }
    
    public function listBuilder() {
        return DB::table('zipcodes')
            //->where('zipcode.zipcode', $id)
            ->select('zipcodes.zipcode', 'zipcodes.city');
    }
    
    public function getList($data=[]) {
        $list = $this->listBuilder();
        return $this->common->pagingSort($list, $data, false, ['zipcode']);
    }

    public function getListJson($id, $data) {
        $list = $this->listBuilder($id);
        return $this->common->pagingSort($list, $data)->toJson();
    }
    
    public function getZipcode($id, $data) {
        return $this->listBuilder()->where('zipcode.zipcode', $data['id'])->first();
    }
    
    // Ajax
    public function remove($key) {
        return $this->zipcode->find($key)->delete();
    }
    
    public function save($id, $data) {
        return ($id == 0) ? $this->saveNew($id, $data) : $this->saveEdit($id, $data);
    }
    
    public function saveNew($id, $data) {
        $this->zipcode->zipcode = $data['zipcode'];
        $this->zipcode->city = $data['city'];
        return $this->zipcode->save();
    }
    
    public function saveEdit($id, $data) {
        $zipcode = $this->zipcode->find($id);
        $zipcode->city = $data['city'];
        return $zipcode->save();
    }
    
    //=========================================================
    
    public function AddNewPoolServiceSubscriber(array $array) {
        // create organization object
        $user = new User();
        $user->email = $array['email'];
        $user->name = $array['fullname'];
        $user->password = bcrypt($array['password']);
        $user->confirmation_code = $array['confirmation_code'];
        // create new user object 
        $profile = new Profile();
        $profile->first_name = $array['fullname'];
        $profile->last_name = $array['fullname'];
        $profile->fullname = $array['fullname'];
        $profile->address = $array['street'];
        $profile->city = $array['city'];
        $profile->state = $array['state'];
        $profile->zipcode = $array['zip'];
        $profile->phone = $array['phone'];
        // create profile Object
        $bill = new BillingInfo();
        if ($array['chk_billing_address'] == 'true') {
            $bill->address = $array['street'];
            $bill->city = $array['city'];
            $bill->state = $array['state'];
            $bill->zipcode = intval($array['zip']);
        } else {
            $bill->address = $array['billing_address'];
            $bill->city = $array['billing_city'];
            $bill->state = $array['billing_state'];
            $bill->zipcode = intval($array['zipcode']);
        }

        $bill->name_card = $array['card_name'];
        $bill->expiration_date = $array['expiration_date'];
        $bill->card_last_digits = substr($array['card_number'], -4);
        $bill->token = $array['stripeToken'];

        //create company object
        $company = new Company();
        $company->name = $array['company'];
        $company->services = $array['chk_service_type'];
        $intArray = array_map(
                function($value) {
            return (int) $value;
        }, $array['zipcode']
        );

        $company->zipcodes = $intArray;
        $company->logo = '';
        $company->status = 'pending';
        $company->website = $array['website'];
        $company->wq = '';
        $company->driver_license = '';
        $company->cpa = '';
        // add user to user_group
        $userGroup = new UserGroup();
        $userGroup->group_id = 3;
        try {
            // using transaction to save data to database
            DB::transaction(function() use ($user, $profile, $bill, $company, $userGroup) {
                // save user
                $user->status = 'pending';
                $user_db = $user->save();
                // set user_id for another object
                $profile->user_id = $bill->user_id = $company->user_id = $userGroup->user_id = $user->id;
                // save user profile			
                $profile->save();
                // save billing info
                $bill->save();
                // save company
                $company->save();
                // save user to user group
                $userGroup->save();
            });
        } catch (Exception $e) {
            return Redirect::to('/page-not-found');
        }

        return true;
    }

    public function check_email_exist($email) {
        return User::where('email', '=', $email)->first();
    }

    public function check_zipcode_exist($zipcode) {
        if (empty($zipcode))
            return [];

        $results = DB::select('SELECT c.id FROM `companies` as c 
            WHERE c.status = "active" and JSON_CONTAINS(c.zipcodes, "[' . $zipcode . ']")');

        return $results;
    }

    public function addEmailNotify($email) {
        // create organization object
        $user = new User();
        $confirmation_code = str_random(30);
        $user->email = $email;
        $user->password = bcrypt('rowboat');
        $user->confirmation_code = $confirmation_code;

        return $user->save();
    }

    public function confirmPoolAccount($confirmCode) {
        $user = $this->user->where('confirmation_code', $confirmCode)->first();
        if (is_null($user)) {
            return $user;
        }

        return $user->forceFill([
                    'status' => 'unclaimed',
                ])->save();
    }

    public function checkLogin(array $arr) {
        $user = DB::table('users')->select('user_group.group_id')
                ->join('user_group', 'user_group.user_id', '=', 'users.id')
                ->where(['users.email' => $arr['email']])
                ->whereNotIn('status', ['pending'])
                ->first();
        return $user;
    }

    public function getProfileByUserId($user_id) {
        return $this->profile->find($user_id);
    }

    public function getUserByUserId($user_id) {
        return $this->user->find($user_id);
    }

    public function confirmTechnicianAccount(array $array) {
        $user = $this->user->where([
                    ['confirmation_code', $array['confirmCode']],
                    ['email', $array['email']],
                    ['status', 'pending'],
                ])->first();
        if (isset($user)) {
            $user->password = bcrypt($array['password']);
            $user->status = 'active';
            return $user->save();
        } else {
            return false;
        }
    }

    public function getUserByTocken($confirmCode) {
        return $this->user->where([['confirmation_code', $confirmCode], ['status', 'pending']])->first();
    }

    public function updateCompanyProfile(array $arr, $id) {
        $com = $this->company->where('user_id', $id)->first();
        if (is_null($com)) {
            return $com;
        }

        $com->forceFill([
            'wq' => '/company-image/' . $arr['wq']->getClientOriginalName(),
            'logo' => '/company-image/' . $arr['logo']->getClientOriginalName(),
            'driver_license' => '/company-image/' . $arr['driven_license']->getClientOriginalName(),
            'cpa' => '/company-image/' . $arr['cpa']->getClientOriginalName()])->save();

        $comProfile = self::getCompanyProfile($id);
        return $comProfile;
    }

    public function getCompanyProfile($id) {
        $comProfile = DB::table('companies')
                ->select('companies.name', 'companies.website', 'companies.logo', 'companies.approved', 'profiles.address', 'profiles.fullname', 'profiles.phone', 'companies.wq', 'companies.cpa', 'companies.driver_license')
                ->join('profiles', 'companies.user_id', '=', 'profiles.user_id')
                ->where(['companies.user_id' => $id])
                ->first();

        return $comProfile;
    }

    public function getUserSchedule($id) {
        $dates = Common::getKeyDatesFromRange(new Datetime(), 6);
        foreach ($dates as $key => $value) {
            $dates[$key] = self::getUserScheduleByDate($id, $value);
        }
        return $dates;
    }

    private function getUserScheduleByDate($id, $date) {
        $comProfile = DB::table('schedules')
                ->select('schedules.technican_id as user_id', 'schedules.date', 'profiles.city as city', 'profiles.zipcode as zipcode', 'profiles.address as address')
                ->join('orders', 'schedules.order_id', '=', 'orders.id')
                ->join('profiles', 'orders.poolowner_id', '=', 'profiles.user_id')
                ->where(['schedules.technican_id' => $id])
                ->whereDate('schedules.date', '=', $date)
                ->orderBy('schedules.date')
                ->get();

        return $comProfile;
    }

    public function getUserInfo($id) {
        $comProfile = DB::table('users')
                ->select('users.id', 'users.name', 'profiles.avatar')
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->where(['users.id' => $id])
                ->first();

        return $comProfile;
    }

    public function getListTechnician($id) {
        return DB::table('companies')
                        ->join('technicians', 'technicians.company_id', '=', 'companies.id')
                        ->join('profiles', 'technicians.user_id', '=', 'profiles.user_id')
                        ->where('companies.user_id', $id)
                        ->select('profiles.fullname', 'profiles.user_id')->get();
    }

    public function getListZipcode() {
        return DB::table('zipcodes')
                        ->where('zipcodes.zipcode', '>', 0)
                        ->select('zipcodes.zipcode', 'zipcodes.city')
                        ->orderBy('zipcodes.zipcode')
                        ->get();
    }

}
