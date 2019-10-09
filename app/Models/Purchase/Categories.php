<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    protected $table = 'purchase_categories';
    protected $fillable = ['name', 'description'];

}
