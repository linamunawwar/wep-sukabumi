<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RkpController extends Controller
{
     public function index()
    {
        return view('rkp.index');
    }

    public function getCreate()
    {
        return view('manager.rkp.create');
    }

     public function indexManager()
    {
        return view('manager.rkp.index');
    }

     public function indexPM()
    {
        return view('pm.rkp.index');
    }
}
