<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Izin;

class IzinController extends Controller
{
    public function index()
    {
      if(\Auth::user()->pegawai->kode_bagian == 'SA'){
          $izins = Izin::where('soft_delete',0)->get();
      }elseif(\Auth::user()->pegawai->kode_bagian == 'QHSE'){
          $izins_qc = Izin::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', 'QC');
          })->where('soft_delete',0)->get();

          $izins = [];
          
          foreach ($izins_qc as $key => $value) {
            $izins[] = $value;
          }

          $izins_hs = Izin::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', 'HS');
          })->where('soft_delete',0)->get();

          foreach ($izins_hs as $key => $value) {
            $izins[] = $value;
          }

        }else{
          $izins = Izin::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
          })->where('soft_delete',0)->get();

        }
        return view('manager.cuti_izin.izin.index',['izins'=>$izins]);
    }

    public function approve($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

       $izin['is_verif_mngr'] = 1;
       $izin['verif_mngr_by'] = \Auth::user()->id;
       $izin['verify_mngr_time'] = date('Y-m-d H:i:s');

       $update = Izin::where('id',$id)->update($izin);
       
       return redirect('/manager/izin');
    }

    public function approveSDM($id)
    {
      date_default_timezone_set("Asia/Jakarta");
        $find = Izin::where('id',$id)->first();
       $izin['is_verif_sdm'] = 1;
       $izin['verif_sdm_by'] = \Auth::user()->id;
       $izin['verify_sdm_time'] = date('Y-m-d H:i:s');

       

       if($find->pegawai->kode_bagian == 'SA'){
        $izin['is_verif_mngr'] = 1;
        $izin['verif_mngr_by'] = \Auth::user()->id;
        $izin['verify_mngr_time'] = date('Y-m-d H:i:s');

        $izin['is_verif_sdm'] = 1;
        $izin['verif_sdm_by'] = \Auth::user()->id;
        $izin['verify_sdm_time'] = date('Y-m-d H:i:s');

        $update = Izin::where('id',$id)->update($izin);
      }else{
         $izin['is_verif_sdm'] = 1;
         $izin['verif_sdm_by'] = \Auth::user()->id;
         $izin['verify_sdm_time'] = date('Y-m-d H:i:s');

         $update = Izin::where('id',$id)->update($izin);
      }
       
       return redirect('/manager/izin');
    }

    public function getPengajuanIzin()
    {
      //list cuti dari user yg login
      $izins = Izin::where('user_id',\Auth::user()->id)->where('soft_delete',0)->get();

        return view('manager.cuti_izin.izin.user.index',['izins'=>$izins]);
    }

    public function getPengajuanIzinCreate()
    {
        return view('manager.cuti_izin.izin.user.create');
    }

    public function postPengajuanIzinCreate(){
      $data = \Input::all();

      $izin = new Izin;
      $izin->nip = $data['nip'];
      $izin->alasan = $data['alasan'];
      // $izin->surat = $data['surat'];
      $tanggal_mulai = explode('-',$data['tanggal_mulai']);
      $data['tanggal_mulai'] = $tanggal_mulai[2].'-'.$tanggal_mulai[1].'-'.$tanggal_mulai[0];
      $izin->tanggal_mulai =$data['tanggal_mulai'];

      $tanggal_selesai = explode('-',$data['tanggal_selesai']);
      $data['tanggal_selesai'] = $tanggal_selesai[2].'-'.$tanggal_selesai[1].'-'.$tanggal_selesai[0];
      $izin->tanggal_selesai =$data['tanggal_selesai'];
      $izin->is_verif_mngr = 1;
      $izin->verif_mngr_by = \Auth::user()->id;;
      $izin->verify_mngr_time = date('Y-m-d H:i:s');
      $izin->is_verif_sdm = 0;
      $izin->verif_sdm_by = 0;
      $izin->verify_sdm_time = 0;
      $izin->user_id = \Auth::user()->id;
      $izin->role_id = \Auth::user()->role_id;

      $izin->save();

      return redirect('/manager/pengajuan_izin');
      
    }
}
