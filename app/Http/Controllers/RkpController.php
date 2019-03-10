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
        return view('rkp.create');
    }
}
