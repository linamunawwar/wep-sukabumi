<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RkpController extends Controller
{
     public function index()
    {
        return view('pm.rkp.index');
    }
}
