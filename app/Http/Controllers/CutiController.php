<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        return view('cuti_izin.cuti.index');
    }

    public function getCreate()
    {
        return view('cuti_izin.cuti.create');
    }

    //--------------------------------------USER-------------------------
    public function indexUser()
    {
    	//list cuti dari user yg login
        return view('cuti_izin.cuti.user.index');
    }

    public function getCreateUser()
    {
        return view('cuti_izin.cuti.user.create');
    }

     public function getSerahTugas()
    {
        return view('cuti_izin.cuti.user.serah_tugas');
    }
}
