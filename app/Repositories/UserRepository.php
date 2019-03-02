<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DateTime;
use DateInterval;
use DatePeriod;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function check_email_exist($email)
    {
        return User::where('email', '=',$email)->first();
    }

    public function checkLogin(array $arr)
    {
        $user = DB::table('users')->select('user_group.group_id')
                ->join('user_group', 'user_group.user_id','=','users.id')
                ->where(['users.email' => $arr['email']])
                ->whereNotIn('status', ['pending'])
                ->first();
        return $user;
    }

    public function getUserByUserId($user_id){
        return $this->user->find($user_id);
    }

    public function getUserByTocken($confirmCode){
        return $this->user->where([['confirmation_code', $confirmCode],['status', 'pending']])->first();
    }

}
