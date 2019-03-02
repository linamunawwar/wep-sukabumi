<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function getCreate()
    {
        return view('pegawai.create');
    }

    public function getStruktur()
    {
        return view('pegawai.struktur.index');
    }

    public function getPecat()
    {
        return view('pegawai.pecat.index');
    }

    public function getCreatePecat(){
    		return view('pegawai.pecat.create');
    }

    public function getResign()
    {
        return view('pegawai.resign.index');
    }

    public function getCreateResign()
    {
        return view('pegawai.resign.create');
    }
}
