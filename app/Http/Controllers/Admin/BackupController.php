<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;

class BackupController extends Controller
{
    public function index()
    {
        if( Artisan::call('backup:run --only-db') )
            return view('backup');
    }
    
    public function destroy()
    {
        return view('backup');
    }
    
    public function restore()
    {
        return view('backup');
    }
}
