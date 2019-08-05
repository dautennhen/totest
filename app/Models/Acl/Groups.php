<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model {

    protected $table = 'groups';
    protected $fillable = ['name', 'description'];

    public function roles() {
        return $this->belongsToMany('App\Models\Acl\Roles', 'group_role', 'group_id', 'role_id')->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany('App\Models\User', 'group_users', 'group_id', 'user_id')->withTimestamps();
    }

}
