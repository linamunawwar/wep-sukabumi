<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cuti;
use App\Pegawai;

class CutiController extends Controller
{
    public function index()
    {
    	$cutis = Cuti::get();

        return view('pm.cuti_izin.cuti.index',['cutis'=>$cutis]);
    }

    public function approve($id)
    {
    	$cuti = Cuti::find($id);

        return view('pm.cuti_izin.cuti.approve',['cuti'=>$cuti]);
    }

    public function postApprove($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
      
       $cuti['is_accept_pm'] = \Input::get('accept');
       $cuti['is_verif_pm'] = 1;
       $cuti['verif_pm_by'] = \Auth::user()->id;
       $cuti['verify_pm_time'] = date('Y-m-d H:i:s');

       $update = Cuti::where('id',$id)->update($cuti);
      
       return redirect('/pm/cuti');
    }

    public function getPengajuanCuti()
    {
      //list cuti dari user yg login
      $cutis = Cuti::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('pm.cuti_izin.cuti.user.index',['cutis'=>$cutis]);
    }

    public function getPengajuanCutiCreate()
    {
      $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('pm.cuti_izin.cuti.user.create',['pegawais'=>$pegawais]);
    }

    public function postPengajuanCutiCreate(){
      $data = \Input::all();
      
      $pecat = new Cuti;
      $pecat->nip = $data['nip'];
      $pecat->alasan = $data['alasan'];
      $pecat->alamat_cuti = $data['alamat_cuti'];
      $pecat->angkutan = $data['angkutan'];
      $tanggal_mulai = explode('-',$data['tanggal_mulai']);
      $data['tanggal_mulai'] = $tanggal_mulai[2].'-'.$tanggal_mulai[1].'-'.$tanggal_mulai[0];
      $pecat->tanggal_mulai =$data['tanggal_mulai'];

      $tanggal_selesai = explode('-',$data['tanggal_selesai']);
      $data['tanggal_selesai'] = $tanggal_selesai[2].'-'.$tanggal_selesai[1].'-'.$tanggal_selesai[0];
      $pecat->tanggal_selesai =$data['tanggal_selesai'];
      $pecat->pengganti =$data['pengganti'];
      $pecat->is_verif_pengganti = 0;
      $pecat->verif_pengganti_by = 0;
      $pecat->verify_pengganti_time = 0;
      $pecat->is_verif_mngr = 0;
      $pecat->verif_mngr_by = 0;
      $pecat->verify_mngr_time = 0;
      $pecat->is_verif_sdm = 0;
      $pecat->verif_sdm_by = 0;
      $pecat->verify_sdm_time = 0;
      $pecat->is_verif_pm = 0;
      $pecat->verif_pm_by = 0;
      $pecat->verify_pm_time = 0;
      $pecat->user_id = \Auth::user()->id;
      $pecat->role_id = \Auth::user()->role_id;

      $pecat->save();

      return redirect('/pm/pengajuan_cuti');
      
    }

    public function deletePengajuan(){
      $data = \Input::all();
      $del = Cuti::where('id',$data['id_cuti'])->delete();

      if($del){
        return redirect('pm/pengajuan_cuti');
      }

    }
}
