<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IzinController extends Controller
{
     public function index()
    {
    	//list cuti dari user yg login
    	$izins = Izin::where('soft_delete',0)->get();

        return view('pm.cuti_izin.izin.index',['izins'=>$izins]);
    }

    public function getPengajuanIzin()
    {
    	//list cuti dari user yg login
    	$izins = Izin::where('user_id',\Auth::user()->id)->where('soft_delete',0)->get();

        return view('pm.cuti_izin.izin.user.index',['izins'=>$izins]);
    }

    public function getPengajuanIzinCreate()
    {
        return view('pm.cuti_izin.izin.user.create');
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

      return redirect('/pm/pengajuan_izin');
      
    }

}
