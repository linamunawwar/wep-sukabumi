<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PDF;
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

        if(\Input::hasfile('lampiran')){
          $ori_file  = \Request::file('lampiran');
         $tujuan = "upload/spj";
         $ekstension = $ori_file->getClientOriginalExtension();

          $nama_file = 'lampiran_'.$data['no_sppd'].'.'.$ekstension;

        $ori_file->move($tujuan,$nama_file);
       }else{
            $nama_file='';
       }

    	$spj = new Spj;
    	$spj->nip = \Auth::user()->pegawai_id;
        $spj->no_sppd = $data['no_sppd'];
        $spj->pemberi_tugas = $data['pemberi_tugas'];
        $spj->tujuan = $data['tujuan'];
    	$spj->tanggal_berangkat = konversi_tanggal($data['tanggal_berangkat']);
    	$spj->tanggal_pulang = konversi_tanggal($data['tanggal_pulang']);
    	$spj->angkutan = $data['angkutan'];
    	$spj->nominal = $data['nominal'];
        $spj->keperluan = $data['keperluan'];
    	$spj->lampiran = $nama_file;
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

    public function getUnduh($id)
    {
      $spj = Spj::find($id);
      $pdf = PDF::loadView('admin.spj.unduh',['spj' => $spj]);
      $pdf->setPaper('A4');
      return $pdf->download('SPJ_'.$spj->no_sppd.'.pdf');
    }
}
