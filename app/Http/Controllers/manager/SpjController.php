<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Spj;
use App\Pegawai;

class SpjController extends Controller
{
    public function index()
    {
    	$spjs = Spj::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('manager.spj.index',['spjs'=>$spjs]);
    }
    public function getCreate()
    {
    	$pegawais = Pegawai::where('is_active',1)->get();

        return view('manager.spj.create',['pegawais'=>$pegawais]);
    }

    public function postCreate()
    {
    	$data = \Input::all();

    	$spj = new Spj;
    	$spj->nip = \Auth::user()->pegawai_id;
    	$spj->tanggal_berangkat = konversi_tanggal($data['tanggal_berangkat']);
    	$spj->tanggal_pulang = konversi_tanggal($data['tanggal_pulang']);
    	$spj->angkutan = $data['angkutan'];
    	$spj->nominal = $data['nominal'];
    	$spj->keperluan = $data['keperluan'];
    	$spj->user_id = \Auth::user()->id;
    	$spj->role_id = \Auth::user()->role_id;

    	$spj->save();

        return redirect('manager/spj');
    }
}
