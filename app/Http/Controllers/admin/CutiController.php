<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PDF;
use App\Cuti;
use App\Pegawai;

class CutiController extends Controller
{
    public function index()
    {
    	$cutis = Cuti::where('soft_delete',0)->get();

        return view('admin.cuti_izin.cuti.index',['cutis'=>$cutis]);
    }

    public function getCreate()
    {
    	$pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('admin.cuti_izin.cuti.create',['pegawais'=>$pegawais]);
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

      return redirect('/admin/cuti');
      
    }

    public function getSuratCuti($id)
    {
      $cuti = Cuti::find($id);
      $user = Pegawai::where('nip',$cuti->nip)->first();
      $sdm = Pegawai::where('posisi_id',6)->first();
      $pm = Pegawai::where('posisi_id',1)->first();
      $manager = Pegawai::where('posisi_id',$user->posisi->parent)->first();
      $pdf = PDF::loadView('admin.cuti_izin.cuti.surat_cuti',['cuti' => $cuti,'sdm'=>$sdm,'pm'=>$pm,'manager'=>$manager]);
      $pdf->setPaper('A4');
      return $pdf->download('Surat Cuti_'.$cuti->nip.'.pdf');
    }


    public function getPengajuanCuti()
    {
      //list cuti dari user yg login
      $cutis = Cuti::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('admin.cuti_izin.cuti.user.index',['cutis'=>$cutis]);
    }

    public function getPengajuanCutiCreate()
    {
      $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('admin.cuti_izin.cuti.user.create',['pegawais'=>$pegawais]);
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

      return redirect('/admin/pengajuan_cuti');
      
    }

    public function deletePengajuan(){
      $data = \Input::all();
      $del = Cuti::where('id',$data['id_cuti'])->delete();

      if($del){
        return redirect('admin/cuti');
      }

    }
}
