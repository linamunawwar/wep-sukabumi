<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gaji;
use App\SlipGaji;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::where('nip',\Auth::user()->pegawai_id)->first();

        return view('user.gaji.index',['gaji'=>$gaji]);
    }

    public function slipGaji()
    {
        $slip_gajis = SlipGaji::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('user.gaji.index_slip',['slip_gajis'=>$slip_gajis]);
    }

    public function getSlipGajiCreate()
    {
        return view('user.gaji.create');
    }

    public function postSlipGajiCreate(){
        $data = \Input::all();
        
        $slip_gaji = new SlipGaji;
        $slip_gaji->nip = \Auth::user()->pegawai_id;
        $slip_gaji->bulan = $data['bulan'];
        $slip_gaji->tahun = $data['tahun'];
        $slip_gaji->keperluan = $data['keperluan'];
        $slip_gaji->user_id = \Auth::user()->id;
        $slip_gaji->role_id = \Auth::user()->role_id;
        
        $slip_gaji->save();

        return redirect('/user/gaji/slip_gaji');
    }
}
