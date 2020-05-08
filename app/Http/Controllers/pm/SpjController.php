<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Spj;
use App\Pegawai;

class SpjController extends Controller
{
    public function index()
    {
    	$spjs = Spj::where('user_id',\Auth::user()->id)->where('soft_delete',0)->get();

        return view('pm.spj.index',['spjs'=>$spjs]);
    }
    
    public function getCreate()
    {
    	$pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();
      $pm = Pegawai::where('posisi_id',1)->first();

        return view('pm.spj.create',['pegawais'=>$pegawais,'pm'=>$pm]);
    }

    public function postCreate()
    {
    	$data = \Input::all();

        if(\Input::hasfile('lampiran')){
          $ori_file  = \Request::file('lampiran');
         $tujuan = "upload/spj";
         $ekstension = $ori_file->getClientOriginalExtension();
         $sppd = str_replace('/', '_', $data['no_sppd']);
          $nama_file = 'lampiran_'.$sppd.'.'.$ekstension;

        $ori_file->move($tujuan,$nama_file);
       }else{
            $nama_file='';
       }

        $spj = new Spj;
        $spj->nip = \Auth::user()->pegawai_id;
      $spj->no_sppd = $data['no_sppd'];
        $spj->pemberi_tugas = $data['pemberi_tugas'];
        $spj->tanggal_berangkat = konversi_tanggal($data['tanggal_berangkat']);
        $spj->tanggal_pulang = konversi_tanggal($data['tanggal_pulang']);
        $spj->angkutan = $data['angkutan'];
        $spj->tujuan = $data['tujuan'];
        $spj->keperluan = $data['keperluan'];
        $spj->lampiran = $nama_file;
      $spj->is_verif_admin = '0';
      $spj->is_verif_sdm = '0';
        $spj->user_id = \Auth::user()->id;
        $spj->role_id = \Auth::user()->role_id;

        $spj->save();

        return redirect('pm/spj');
    }
}
