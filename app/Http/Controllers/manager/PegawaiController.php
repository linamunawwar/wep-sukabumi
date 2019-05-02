<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Pegawai;
use App\KodeBagian;
use App\BankAsuransi;
use App\Gaji;
use App\Pecat;
use App\Resign;
use App\MCU;
use App\MCUPegawai;

class PegawaiController extends Controller
{
    public function index()
    {

    	 // $pegawais= Pegawai::get();
      if(\Auth::user()->pegawai->kode_bagian == 'SA'){
        $pegawais = Pegawai::get();
      }else{
        $pegawais = Pegawai::where('kode_bagian', \Auth::user()->pegawai->kode_bagian)->get();

      }
        return view('manager.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function getApprove($id)
    {
        $pegawai = Pegawai::find($id);
        $bank= BankAsuransi::where('nip',$pegawai->nip)->first();
        $kode = KodeBagian::all();
        $data_mcus = MCUPegawai::where('nip',$pegawai->nip)->where('soft_delete','0')->get();

        return view('manager.pegawai.approve_manager',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'data_mcus'=>$data_mcus]);
    }

    public function postApprove($id)
    {
    	$nip = \Input::get('nip');
       $pegawai['is_verif_mngr'] = 1;
       $pegawai['verif_mngr_by'] = \Auth::user()->id;
       $pegawai['verify_mngr_time'] = date('Y-m-d H:i:s');

       $update = Pegawai::where('nip',$nip)->update($pegawai);
       
       return redirect('/manager/pegawai');
    }

    //-----------------------PEMECATAN_----------------------
    public function getPecat()
    {
      if(\Auth::user()->pegawai->kode_bagian == 'SA'){
        $pecats = Pecat::get();
      }else{
        $pecats = Pecat::whereHas('pegawai',function ($q){
            $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
        })->get();

      }

      return view('manager.pegawai.pecat.index',['pecats'=>$pecats]);
    }

    public function getApprovePecat($id)
    {
        $pecat = Pecat::find($id);

        return view('manager.pegawai.pecat.approve',['pecat'=>$pecat]);
    }

    public function postApprovePecat($id)
    {
      date_default_timezone_set("Asia/Jakarta");
      
      $nip = \Input::get('nip');
       $pecat['is_verif_mngr'] = 1;
       $pecat['verif_mngr_by'] = \Auth::user()->id;
       $pecat['verify_mngr_time'] = date('Y-m-d H:i:s');

       $update = Pecat::where('nip',$nip)->update($pecat);
       
       return redirect('/manager/pegawai/pecat');
    }

    public function getApprovePecatSDM($id)
    {
        $pecat = Pecat::find($id);

        return view('manager.pegawai.pecat.approve',['pecat'=>$pecat]);
    }

    public function postApprovePecatSDM($id)
    {
      $nip = \Input::get('nip');
      $pegawai = Pegawai::where('nip',$nip)->first();
      date_default_timezone_set("Asia/Jakarta");

      if($pegawai->kode_bagian == 'SA'){
        $pecat['is_verif_mngr'] = 1;
        $pecat['verif_mngr_by'] = \Auth::user()->id;
        $pecat['verify_mngr_time'] = date('Y-m-d H:i:s');

        $pecat['is_verif_sdm'] = 1;
        $pecat['verif_sdm_by'] = \Auth::user()->id;
        $pecat['verify_sdm_time'] = date('Y-m-d H:i:s');

        $update = Pecat::where('nip',$nip)->update($pecat);
      }else{
         $pecat['is_verif_sdm'] = 1;
         $pecat['verif_sdm_by'] = \Auth::user()->id;
         $pecat['verify_sdm_time'] = date('Y-m-d H:i:s');

         $update = Pecat::where('nip',$nip)->update($pecat);
      }
       return redirect('/manager/pegawai/pecat');
    }

    //----------------------------RESIGN--------------------------------
    public function getResign()
    {
      if(\Auth::user()->pegawai->kode_bagian == 'SA'){
        $resigns = Resign::get();
      }else{
        $resigns = Resign::whereHas('pegawai',function ($q){
            $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
        })->get();

      }

      return view('manager.pegawai.resign.index',['resigns'=>$resigns]);
    }

    public function getApproveResign($id)
    {
        $resign = Resign::find($id);

        return view('manager.pegawai.resign.approve',['resign'=>$resign]);
    }

    public function postApproveResign($id)
    {
      $nip = \Input::get('nip');
       $resign['is_verif_mngr'] = 1;
       $resign['verif_mngr_by'] = \Auth::user()->id;
       $resign['verify_mngr_time'] = date('Y-m-d H:i:s');

       $update = Resign::where('nip',$nip)->update($resign);
       
       return redirect('/manager/pegawai/resign');
    }

    public function getApproveResignSDM($id)
    {
        $resign = Resign::find($id);

        return view('manager.pegawai.resign.approve',['resign'=>$resign]);
    }

    public function postApproveResignSDM($id)
    {
      $nip = \Input::get('nip');
      $pegawai = Pegawai::where('nip',$nip)->first();

      if($pegawai->kode_bagian == 'SA'){
        $resign['is_verif_mngr'] = 1;
        $resign['verif_mngr_by'] = \Auth::user()->id;
        $resign['verify_mngr_time'] = date('Y-m-d H:i:s');

        $resign['is_verif_sdm'] = 1;
        $resign['verif_sdm_by'] = \Auth::user()->id;
        $resign['verify_sdm_time'] = date('Y-m-d H:i:s');

        $update = Resign::where('nip',$nip)->update($resign);
      }else{
         $resign['is_verif_sdm'] = 1;
         $resign['verif_sdm_by'] = \Auth::user()->id;
         $resign['verify_sdm_time'] = date('Y-m-d H:i:s');

         $update = Resign::where('nip',$nip)->update($resign);
      }
       return redirect('/manager/pegawai/resign');
    }

}
