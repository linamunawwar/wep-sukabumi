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
    	$pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('manager.spj.create',['pegawais'=>$pegawais]);
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

        return redirect('manager/spj');
    }

    public function getListPengajuan(){
        $spjs = Spj::where('soft_delete',0)->get();

        return view('manager.spj.list',['spjs'=>$spjs]);
    }

    public function getApprove($id)
    {

        $spj = Spj::find($id);
        $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('manager.spj.approve',['spj'=>$spj,'pegawais'=>$pegawais]);
    }

    public function postApprove($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $data = \Input::all();
        $data['is_verif_sdm'] = '1';
        $data['verif_sdm_by'] = \Auth::user()->id;
        $data['verify_sdm_time'] = date('Y-m-d H:i:s');
        $data['tanggal_berangkat']=konversi_tanggal($data['tanggal_berangkat']);
        $data['tanggal_pulang'] =konversi_tanggal($data['tanggal_pulang']);
        unset($data['_token']);
        $spj = Spj::where('id',$id)->update($data);

        return redirect('manager/spj/pengajuan');
    }
}
