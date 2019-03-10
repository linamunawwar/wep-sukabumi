<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpjController extends Controller
{
    public function index()
    {
        return view('spj.index');
    }

    public function getCreate()
    {
        return view('spj.create');
    }

    //--------------------------------------USER-------------------------
    public function indexUser()
    {
    	//list cuti dari user yg login
        return view('spj.user.index');
    }

    public function getCreateUser()
    {
        return view('spj.user.create');
    }
}
