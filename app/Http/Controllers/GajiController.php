<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        return view('gaji.index');
    }

    public function getCreate()
    {
        return view('gaji.create');
    }

    public function getListTransfer()
    {
        return view('gaji.list_transfer');
    }

    //---------------------------------------------------USER--------------------

    public function indexUser()
    {
        return view('gaji.user.index');
    }

    public function slipGaji()
    {
        return view('gaji.user.index-slip');
    }

    public function slipGajiCreate()
    {
        return view('gaji.user.create');
    }
}
