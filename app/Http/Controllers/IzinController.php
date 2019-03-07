<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index()
    {
        return view('cuti_izin.izin.index');
    }

    public function getCreate()
    {
        return view('cuti_izin.izin.create');
    }

    //--------------------------------------USER-------------------------
    public function indexUser()
    {
    	//list cuti dari user yg login
        return view('cuti_izin.izin.user.index');
    }

    public function getCreateUser()
    {
        return view('cuti_izin.izin.user.create');
    }
}
