<?php

namespace App\Http\Controllers;
use App\Roles;
use App\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //----------------------------------------------------ADMIN---------------------------------------------

    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    public function postReset()
    {
        $data = \Input::all();
        $pass_baru = \Hash::make($data['pass_baru']);
        $user = User::where('id',\Auth::user()->id)->update(['pass_asli'=>$data['pass_baru'],'password'=>$pass_baru]);

        return view('auth.passwords.reset');
    }

    //----------------------------USER----------------------------------
    
}
