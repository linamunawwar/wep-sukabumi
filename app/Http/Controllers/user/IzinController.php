<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Izin;

class IzinController extends Controller
{
    public function index()
    {
    	//list cuti dari user yg login
    	$izins = Izin::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('user.cuti_izin.izin.index',['izins'=>$izins]);
    }

    public function getCreate()
    {
        return view('user.cuti_izin.izin.create');
    }

    public function postCreate(){
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
      $izin->is_verif_sdm = 0;
      $izin->verif_sdm_by = 0;
      $izin->verify_sdm_time = 0;
      $izin->user_id = \Auth::user()->id;
      $izin->role_id = \Auth::user()->role_id;

      $izin->save();

      return redirect('/user/izin');
      
    }
}
