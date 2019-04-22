<?php

namespace App\Http\Controllers;
use App\Roles;
use app\Pegawai;
use app\KodeBagian;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //----------------------------------------------------ADMIN---------------------------------------------
    


    public function indexManager()
    {
        return view('pegawai.index_manager');
    }

   

    public function getEditCV()
    {
        $roles= Roles::get();
        

        return view('pegawai.cv',['roles'=>$roles]);
    }

    public function getStruktur()
    {
        return view('pegawai.struktur.index');
    }

    public function getProd05()
    {
        return view('pegawai.prod05.index');
    }

    public function getPecat()
    {
        return view('pegawai.pecat.index');
    }

    public function getCreatePecat(){
    		return view('pegawai.pecat.create');
    }

    public function pecatManager(){
            return view('manager.pecat.index');
    }

    public function getResign()
    {
        return view('pegawai.resign.index');
    }

    public function getCreateResign()
    {
        return view('pegawai.resign.create');
    }

    public function resignManager(){
            return view('manager.resign.index');
    }

    //----------------------------USER----------------------------------
    
}
