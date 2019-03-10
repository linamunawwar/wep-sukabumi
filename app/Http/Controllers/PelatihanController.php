<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelatihanController extends Controller
{
     public function index()
    {
        return view('pelatihan.index');
    }

    public function getCreateGap()
    {
        return view('pelatihan.create_gap');
    }

    public function getCreateUsulan()
    {
        return view('pelatihan.create_usulan');
    }

    public function getEditUsulan()
    {
        return view('pelatihan.edit_usulan');
    }
}
