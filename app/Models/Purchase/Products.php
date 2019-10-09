<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

    protected $table = 'products';
    protected $fillable = ['cate_id', 'name', 'price', 'image', 'video', 'description', 'property'];
    /*protected $casts = [
        'image' => 'array'
    ];*/
}
