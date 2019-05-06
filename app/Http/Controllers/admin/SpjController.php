<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Spj;
use App\Pegawai;

class SpjController extends Controller
{
    public function index()
    {
    	$spjs = Spj::where('soft_delete',0)->get();

        return view('admin.spj.index',['spjs'=>$spjs]);
    }

    public function getCreate()
    {
    	$pegawais = Pegawai::where('is_active',1)->get();

        return view('admin.spj.create',['pegawais'=>$pegawais]);
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

        return redirect('admin/spj');
    }

    public function getApprove($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

    	$data['is_verif_sdm'] = '1';
    	$data['verif_sdm_by'] = \Auth::user()->id;
    	$data['verify_sdm_time'] = date('Y-m-d H:i:s');

    	$spj = Spj::where('id',$id)->update($data);

        return redirect('admin/spj');
    }
}
