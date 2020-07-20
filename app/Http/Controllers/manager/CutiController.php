<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cuti;
use App\Pegawai;

class CutiController extends Controller
{
    public function index()
    {
    	if(\Auth::user()->pegawai->kode_bagian == 'SA'){
	        $cutis = Cuti::where('soft_delete',0)->get();
	      }elseif(\Auth::user()->pegawai->kode_bagian == 'QHSE'){
          $cutis_qhse = Cuti::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', 'QC');
          })->where('soft_delete',0)->get();

          $cutis = [];

          foreach ($cutis_qhse as $key => $value) {
            $cutis[] = $value;
          }

          $cutis_qc = Cuti::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', 'QC');
          })->where('soft_delete',0)->get();

          foreach ($cutis_qc as $key => $value) {
            $cutis[] = $value;
          }

          $cutis_hs = Cuti::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', 'HS');
          })->where('soft_delete',0)->get();

          foreach ($cutis_hs as $key => $value) {
            $cutis[] = $value;
          }

        }else{
	        $cutis = Cuti::whereHas('pegawai',function ($q){
	            $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
	        })->where('soft_delete',0)->get();

	      }
        return view('manager.cuti_izin.cuti.index',['cutis'=>$cutis]);
    }

    public function approve($id)
    {
    	$cuti = Cuti::find($id);

        return view('manager.cuti_izin.cuti.approve',['cuti'=>$cuti]);
    }

    public function postApprove($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

     	 $cuti['ket_manager'] = \Input::get('ket_manager');
       $cuti['is_verif_mngr'] = 1;
       $cuti['verif_mngr_by'] = \Auth::user()->id;
       $cuti['verify_mngr_time'] = date('Y-m-d H:i:s');

       $update = Cuti::where('id',$id)->update($cuti);
       
       return redirect('/manager/cuti');
    }

    public function approveSDM($id)
    {
    	$cuti = Cuti::find($id);

        return view('manager.cuti_izin.cuti.approve_sdm',['cuti'=>$cuti]);
    }

    public function postApproveSDM($id)
    {
      $find = Cuti::where('id',$id)->first();
      date_default_timezone_set("Asia/Jakarta");

      if($find->pegawai->kode_bagian == 'SA'){
        $cuti['ket_manager'] = \Input::get('ket_manager');
        $cuti['is_verif_mngr'] = 1;
        $cuti['verif_mngr_by'] = \Auth::user()->id;
        $cuti['verify_mngr_time'] = date('Y-m-d H:i:s');

        $cuti['ket_sdm'] = \Input::get('ket_sdm');
        $cuti['is_verif_sdm'] = 1;
        $cuti['verif_sdm_by'] = \Auth::user()->id;
        $cuti['verify_sdm_time'] = date('Y-m-d H:i:s');

        $update = Cuti::where('id',$id)->update($cuti);
      }else{
         $cuti['ket_sdm'] = \Input::get('ket_sdm');
         $cuti['is_verif_sdm'] = 1;
         $cuti['verif_sdm_by'] = \Auth::user()->id;
         $cuti['verify_sdm_time'] = date('Y-m-d H:i:s');

         $update = Cuti::where('id',$id)->update($cuti);
      }
       return redirect('/manager/cuti');
    }

    public function getPengajuanCuti()
    {
      //list cuti dari user yg login
      $cutis = Cuti::where('user_id',\Auth::user()->id)->where('soft_delete',0)->get();

        return view('manager.cuti_izin.cuti.user.index',['cutis'=>$cutis]);
    }

    public function getPengajuanCutiCreate()
    {
      $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('manager.cuti_izin.cuti.user.create',['pegawais'=>$pegawais]);
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
      $tanggal_mulai_terakhir = explode('-',$data['tanggal_mulai_terakhir']);
      $data['tanggal_mulai_terakhir'] = $tanggal_mulai_terakhir[2].'-'.$tanggal_mulai_terakhir[1].'-'.$tanggal_mulai_terakhir[0];
      $pecat->tanggal_mulai_terakhir =$data['tanggal_mulai_terakhir'];
      $pecat->pengganti =$data['pengganti'];
      $pecat->is_verif_pengganti = 0;
      $pecat->verif_pengganti_by = 0;
      $pecat->verify_pengganti_time = 0;
      $pecat->is_verif_admin = 0;
      $pecat->verif_admin_by = 0;
      $pecat->verify_admin_time = 0;
      $pecat->is_verif_mngr = 1;
      $pecat->verif_mngr_by = \Auth::user()->pegawai_id;
      $pecat->verify_mngr_time = date('Y-m-d H:i:s');
      $pecat->is_verif_sdm = 0;
      $pecat->verif_sdm_by = 0;
      $pecat->verify_sdm_time = 0;
      $pecat->is_verif_pm = 0;
      $pecat->verif_pm_by = 0;
      $pecat->verify_pm_time = 0;
      $pecat->user_id = \Auth::user()->id;
      $pecat->role_id = \Auth::user()->role_id;

      $pecat->save();

      return redirect('/manager/pengajuan_cuti');
      
    }

    public function deletePengajuan(){
      $data = \Input::all();
      $del = Cuti::where('id',$data['id_cuti'])->delete();

      if($del){
        return redirect('manager/pengajuan_cuti');
      }

    }
}
