<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Socials extends Model {

    protected $table = 'socials';
    protected $fillable = ['name', 'username', 'password'];

}
