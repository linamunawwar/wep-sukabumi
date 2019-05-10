<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RkpController extends Controller
{
    public function index()
    {
        return view('manager.rkp.index');
    }
    
    public function getCreate()
    {
        return view('manager.rkp.create');
    }

     
}
