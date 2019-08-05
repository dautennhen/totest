<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model {

    protected $table = 'roles';
    protected $fillable = ['name', 'description'];

    public function permissions() {
        return $this->belongsToMany('App\Models\Acl\Permissions', 'role_permission', 'role_id', 'permission_id')->withTimestamps();
    }

}
