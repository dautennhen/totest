<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    protected $table = 'news_categories';
    protected $fillable = ['name', 'description'];

}
