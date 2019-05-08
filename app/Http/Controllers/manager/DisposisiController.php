<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisposisiController extends Controller
{
     public function index()
    {
        return view('manager.disposisi.index');
    }

    public function proses()
    {
        return view('manager.disposisi.proses');
    }
}
