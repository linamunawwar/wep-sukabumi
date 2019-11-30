<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cuti;
use App\Pegawai;

class CutiController extends Controller
{
    public function index()
    {
    	//list cuti dari user yg login
    	$cutis = Cuti::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('user.cuti_izin.cuti.index',['cutis'=>$cutis]);
    }

    public function getCreate()
    {
    	$pegawais = Pegawai::where('is_active',1)->get();
      if((\Auth::user()->role_id == 2) || (\Auth::user()->role_id == 3) || (\Auth::user()->role_id == 4)){
        $penggantis = Pegawai::where('is_active',1)
                      ->where('soft_delete',0)
                      ->where('nip','!=',\Auth::user()->pegawai_id)
                      ->whereHas('user',function ($q){
                          $q->where('role_id',2);
                      })
                      ->where('kode_bagian',\Auth::user()->pegawai->kode_bagian)->get();
                      
      }
      if(\Auth::user()->role_id == 5){
        $penggantis = Pegawai::where('nip','!=',\Auth::user()->pegawai_id)
                      ->where('soft_delete',0)
                      ->where('kode_bagian',\Auth::user()->pegawai->kode_bagian)->get();
      }

        return view('user.cuti_izin.cuti.create',['pegawais'=>$pegawais,'penggantis'=>$penggantis]);
    }

    public function postCreate(){
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

      return redirect('/user/cuti');
      
    }

    public function deletePengajuan(){
      $data = \Input::all();
      $del = Cuti::where('id',$data['id_cuti'])->delete();

      if($del){
        return redirect('user/cuti');
      }

    }

    public function getSerahTugas()
    {
    	$tugass = Cuti::where('pengganti',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('user.cuti_izin.cuti.serah_tugas',['tugass'=>$tugass]);
    }

    public function approveSerahTugas($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

    	$cuti['is_verif_pengganti'] = 1;
       	$cuti['verif_pengganti_by'] = \Auth::user()->pegawai_id;
       	$cuti['verify_pengganti_time'] = date('Y-m-d H:i:s');

       	$update = Cuti::where('id',$id)->update($cuti);

        return redirect('/user/cuti/serah_tugas');
    }


}
