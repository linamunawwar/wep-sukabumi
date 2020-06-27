<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PDF;
use App\Cuti;
use App\Pegawai;
use App\Models\User;

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
      
      $user = User::where('pegawai_id',$data['nip'])->first();

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
      $pecat->is_verif_mngr = 0;
      $pecat->verif_mngr_by = 0;
      $pecat->verify_mngr_time = 0;
      $pecat->is_verif_sdm = 0;
      $pecat->verif_sdm_by = 0;
      $pecat->verify_sdm_time = 0;
      $pecat->is_verif_pm = 0;
      $pecat->verif_pm_by = 0;
      $pecat->verify_pm_time = 0;
      $pecat->user_id = $user->id;
      $pecat->role_id = \Auth::user()->role_id;

      $pecat->save();

      return redirect('/admin/cuti');
      
    }

    public function getEdit($id)
    {
      $cuti= Cuti::find($id);
      $penggantis = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('admin.cuti_izin.cuti.edit',['cuti'=>$cuti,'penggantis'=>$penggantis]);
    }

    public function postEdit($id){
      $data = \Input::all();
      
      $user = User::where('pegawai_id',$data['nip'])->first();

   
      $tanggal_mulai = explode('-',$data['tanggal_mulai']);
      $data['tanggal_mulai'] = $tanggal_mulai[2].'-'.$tanggal_mulai[1].'-'.$tanggal_mulai[0];


      $tanggal_selesai = explode('-',$data['tanggal_selesai']);
      $data['tanggal_selesai'] = $tanggal_selesai[2].'-'.$tanggal_selesai[1].'-'.$tanggal_selesai[0];

      $tanggal_mulai_terakhir = explode('-',$data['tanggal_mulai_terakhir']);
      $data['tanggal_mulai_terakhir'] = $tanggal_mulai_terakhir[2].'-'.$tanggal_mulai_terakhir[1].'-'.$tanggal_mulai_terakhir[0];
      unset($data['_token']);
      
      if(isset($data['approve'])){
        $data['is_verif_admin'] = 1;
        $data['verif_admin_by'] = \Auth::user()->pegawai_id;
        $data['verify_admin_time'] = date('Y-m-d H:i:is');
        unset($data['approve']);
      }else{
        unset($data['edit']);
      }

      $update = Cuti::where('id',$id)->update($data);


      return redirect('/admin/cuti');
      
    }

    public function getSuratCuti($id)
    {
      $cuti = Cuti::find($id);
      $user = Pegawai::where('nip',$cuti->nip)->first();

      $user_sdm = User::where('id',$cuti->verif_sdm_by)->first();
      $sdm = Pegawai::where('nip',$user_sdm->pegawai_id)->first();

      $user_pm = User::where('id',$cuti->verif_pm_by)->first();
      $pm = Pegawai::where('nip',$user_pm->pegawai_id)->first();

      $user_manager = User::where('id',$cuti->verif_mngr_by)->first();
      $manager = Pegawai::where('nip',$user_manager->pegawai_id)->first();

      $pdf = PDF::loadView('admin.cuti_izin.cuti.surat_cuti',['cuti' => $cuti,'sdm'=>$sdm,'pm'=>$pm,'manager'=>$manager]);
      $pdf->setPaper('A4');
      return $pdf->download('Surat Cuti_'.$cuti->nip.'.pdf');
    }


    public function getPengajuanCuti()
    {
      //list cuti dari user yg login
      $cutis = Cuti::where('user_id',\Auth::user()->id)->where('soft_delete',0)->get();

        return view('admin.cuti_izin.cuti.user.index',['cutis'=>$cutis]);
    }

    public function getPengajuanCutiCreate()
    {
      $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('admin.cuti_izin.cuti.user.create',['pegawais'=>$pegawais]);
    }

    public function postPengajuanCutiCreate(){
      $data = \Input::all();
      
      $user = User::where('pegawai_id',$data['nip'])->first();
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
      $pecat->user_id = $user->id;
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
