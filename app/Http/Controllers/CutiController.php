<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutiController extends Controller
{


    //--------------------------MANAGER---------------------
    public function indexPM()
    {
        return view('pm.cuti.index');
    }

    public function approvePM()
    {
        return view('pm.cuti.approve');
    }
}
