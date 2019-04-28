<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Pegawai;
use App\KodeBagian;
use App\BankAsuransi;
use App\Gaji;
use App\Pecat;
use App\MCU;
use App\MCUPegawai;

class PegawaiController extends Controller
{
    public function index()
    {
    	 $pegawais= Pegawai::get();
        return view('pm.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function getApprove($id)
    {
        $pegawai = Pegawai::find($id);
        $bank= BankAsuransi::where('nip',$pegawai->nip)->first();
        $kode = KodeBagian::all();
        $mcus = MCU::where('soft_delete','0')->get();

        return view('pm.pegawai.approve_manager',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus]);
    }

    public function postApprove($id)
    {
    	$nip = \Input::get('nip');
       $pegawai['is_active'] = 1;
       $pegawai['is_verif_pm'] = 1;
       $pegawai['verif_pm_by'] = \Auth::user()->id;
       $pegawai['verify_pm_time'] = date('Y-m-d H:i:s');

       $update = Pegawai::where('nip',$nip)->update($pegawai);
       
       return redirect('/pm/pegawai');
    }

    public function getPecat()
    {
      $pecats = Pecat::get();

      return view('pm.pegawai.pecat.index',['pecats'=>$pecats]);
    }

    public function getApprovePecat($id)
    {
        $pecat = Pecat::find($id);

        return view('pm.pegawai.pecat.approve',['pecat'=>$pecat]);
    }

    public function postApprovePecat($id)
    {
      $nip = \Input::get('nip');
       $pecat['is_verif_pm'] = 1;
       $pecat['verif_pm_by'] = \Auth::user()->id;
       $pecat['verify_pm_time'] = date('Y-m-d H:i:s');

       $update = Pecat::where('nip',$nip)->update($pecat);
       $non_aktif = Pegawai::where('nip',$nip)->update(['is_active'=>0]);

       return redirect('/pm/pegawai/pecat');
    }
}
