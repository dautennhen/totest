<?php

namespace App\Http\Controllers;

class LoadController extends Controller
{
    public function load($route)
    {
        return redirect()->route($route);
    }
}
