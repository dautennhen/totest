<?php

namespace App\Models;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class User extends Model {

    use SoftDeletes;
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    public $rules = [
        'email' => 'required|email',
        'name' => 'required',
        'group_id' => 'required',
        'username' => 'required'
    ];
    public $messages;
    public $attributes;

    public function __construct($data = []) {
        $this->attributes = $data;
        $this->messages = [
            'email.required' => __('message.email.required'),
            'name.required' => __('message.field.required'),
            'group_id.required' => __('message.group.required'),
            'username.required' => __('message.username.required')
        ];
    }

    public function isValid($data = []) {
        return Validator::make($data, $this->rules, $this->messages)->passes();
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Acl\Groups', 'group_role', 'group_id', 'role_id')->withTimestamps();
    }

}
