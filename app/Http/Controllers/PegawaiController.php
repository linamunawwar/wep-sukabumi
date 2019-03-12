<?php

namespace App\Http\Controllers;
use App\Roles;
use app\Pegawai;
use app\KodeBagian;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function indexManager()
    {
        return view('pegawai.index_manager');
    }

    public function getCreate()
    {
        $roles= Roles::get();
        

        return view('pegawai.create',['roles'=>$roles]);
    }

    public function getApproveAdmin()
    {
        return view('pegawai.approve_admin');
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

    public function getResign()
    {
        return view('pegawai.resign.index');
    }

    public function getCreateResign()
    {
        return view('pegawai.resign.create');
    }

    //----------------------------USER----------------------------------
    public function indexUser()
    {
        return view('pegawai.user.index');
    }

    public function getStrukturUser()
    {
        return view('pegawai.struktur.index');
    }

    public function getResignUser()
    {
        return view('pegawai.user.resign');
    }
}
