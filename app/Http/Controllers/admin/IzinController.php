<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Izin;
use App\Pegawai;

class IzinController extends Controller
{
    public function index()
    {
    	$izins = Izin::where('soft_delete',0)->get();

        return view('admin.cuti_izin.izin.index',['izins'=>$izins]);
    }

    public function getPengajuanIzin()
    {
    	//list cuti dari user yg login
    	$izins = Izin::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('admin.cuti_izin.izin.user.index',['izins'=>$izins]);
    }

    public function getPengajuanIzinCreate()
    {
        return view('admin.cuti_izin.izin.user.create');
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

      return redirect('/admin/pengajuan_izin');
      
    }

    public function getSuratIzin($id)
    {
      $izin = Izin::find($id);
      $user = Pegawai::where('nip',$izin->nip)->first();
      $sdm = Pegawai::where('posisi_id',6)->first();
      $pm = Pegawai::where('posisi_id',1)->first();
      $manager = Pegawai::where('posisi_id',$user->posisi->parent)->first();
      $pdf = PDF::loadView('admin.cuti_izin.izin.surat_izin',['izin' => $izin,'sdm'=>$sdm,'pm'=>$pm,'manager'=>$manager]);
      $pdf->setPaper('A4');
      return $pdf->download('Surat Izin_'.$izin->nip.'.pdf');
    }
}
