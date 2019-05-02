<?php

namespace App\Http\Controllers;
use App\Roles;
use app\Pegawai;
use app\KodeBagian;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //----------------------------------------------------ADMIN---------------------------------------------

    public function getProd05()
    {
        return view('pegawai.prod05.index');
    }

    

    public function pecatManager(){
            return view('manager.pecat.index');
    }

    

    public function resignManager(){
            return view('manager.resign.index');
    }

    //----------------------------USER----------------------------------
    
}
