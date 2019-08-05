<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model {

    protected $table = 'permissions';
    protected $primaryKey = 'alias';
    protected $fillable = [
        'alias', 'name', 'description'
    ];

}
