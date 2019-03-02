<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection as UserCollection;
use App\Models\User;
use App\Models\Book as Book;

class TestController extends Controller
{
    public function userResource()
    {
        return new UserResource(User::find(1));
    }
    
    public function usersResource()
    {
        return new UserCollection(User::all());
    }
    
    public function elasticSearch()
    {
        $typeExists = Book::typeExists();
        dd($typeExists);
        return $typeExists;
    }
}
