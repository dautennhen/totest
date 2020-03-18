<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {

    protected $table = 'posts';
    protected $fillable = ['cate_id', 'title', 'content', 'author', 'publish'];

}
