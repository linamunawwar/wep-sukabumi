<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Izin;

class IzinController extends Controller
{
    public function index()
    {
    	
     if(\Auth::user()->pegawai->kode_bagian == 'QHSE'){
          $izins_qc = Izin::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', 'QC');
          })->get();

          $izins = [];
          
          foreach ($izins_qc as $key => $value) {
            $izins[] = $value;
          }

          $izins_hs = Izin::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', 'HS');
          })->get();

          foreach ($izins_hs as $key => $value) {
            $izins[] = $value;
          }

        }else{
          $izins = Izin::whereHas('pegawai',function ($q){
              $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
          })->get();

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

    public function getPengajuanIzin()
    {
      //list cuti dari user yg login
      $izins = Izin::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

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
      $izin->is_verif_mngr = 0;
      $izin->verif_mngr_by = 0;
      $izin->verify_mngr_time = 0;
      $izin->user_id = \Auth::user()->id;
      $izin->role_id = \Auth::user()->role_id;

      $izin->save();

      return redirect('/manager/pengajuan_izin');
      
    }
}
