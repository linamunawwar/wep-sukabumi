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
use App\Resign;
use App\MCU;
use App\MCUPegawai;

class PegawaiController extends Controller
{
    public function index()
    {
    	 $pegawais= Pegawai::where('is_active','!=',0)->where('soft_delete',0)->orwhere('is_active','')
                            ->where('soft_delete',0)->get();
        return view('pm.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function indexNonAktif()
    {
       $pegawais= Pegawai::where('is_active',0)
                          ->where('soft_delete',1)
                          ->get();

        return view('pm.pegawai.index_non_aktif',['pegawais'=>$pegawais]);
    }

    public function getApprove($id)
    {
        $pegawai = Pegawai::find($id);
        $bank= BankAsuransi::where('nip',$pegawai->nip)->first();
        $gaji= Gaji::where('nip',$pegawai->nip)->first();
        $kode = KodeBagian::all();
        $data_mcus = MCUPegawai::where('nip',$pegawai->nip)->where('soft_delete','0')->get();

        return view('pm.pegawai.approve_pm',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'data_mcus'=>$data_mcus,'gaji'=>$gaji]);
    }

    public function postApprove($id)
    {
      date_default_timezone_set("Asia/Jakarta");

    	$nip = \Input::get('nip');
       $pegawai['is_active'] = 1;
       $pegawai['is_verif_pm'] = 1;
       $pegawai['verif_pm_by'] = \Auth::user()->id;
       $pegawai['verify_pm_time'] = date('Y-m-d H:i:s');

       $update = Pegawai::where('nip',$nip)->update($pegawai);
       
       return redirect('/pm/pegawai');
    }

     public function getStruktur()
    {
      $level = Posisi::groupBy('level')->get();
      foreach ($level as $key => $value) {
         $posisi[$value->level] = Posisi::where('level',$value->level)->where('soft_delete',0)->get();
      }

      $posisi = Posisi::where('level','0')->get();
      // dd($posisi);
        foreach ($posisi as $key => $value) {
          $value->anggota = Pegawai::where('posisi_id',$value->id)->where('soft_delete',0)->get();
          $value->anak = Posisi::where('parent',$value->id)->where('soft_delete',0)->get();
          foreach ($value->anak as $key => $anak2) {
            $anak2->anggota = Pegawai::where('posisi_id',$anak2->id)->where('soft_delete',0)->get();
            $anak2->anak = Posisi::where('parent',$anak2->id)->where('soft_delete',0)->get();
            foreach ($anak2->anak as $key => $anak3) {
              $anak3->anggota = Pegawai::where('posisi_id',$anak3->id)->where('soft_delete',0)->get();
              $anak3->anak = Posisi::where('parent',$anak3->id)->where('soft_delete',0)->get();
              foreach ($anak3->anak as $key => $anak4) {
                $anak4->anggota = Pegawai::where('posisi_id',$anak4->id)->where('soft_delete',0)->get();
                $anak4->anak = Posisi::where('parent',$anak4->id)->where('soft_delete',0)->get();
              }
            }
          }
        }
      // $atasans = Pegawai::whereHas('posisi', function ($q){
      //     $q->where('parent', '1');
      // })->get();

// dd($posisi);
      return view('admin.pegawai.struktur.index',['level'=>$level,'posisi'=>$posisi]);
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
      date_default_timezone_set("Asia/Jakarta");
      
       $kode = env("KODE_PROYEK");
      $jml_resign = env("USER_OUT");
      $jml = (int)$jml_resign + 1;
      setEnvironmentValue('USER_OUT',$jml);

      $nip = \Input::get('nip');
       $pecat['is_verif_pm'] = 1;
       $pecat['verif_pm_by'] = \Auth::user()->id;
       $pecat['verify_pm_time'] = date('Y-m-d H:i:s');

       $pecat['no_surat'] = tigadigit($jml).'/SKPK/WK/'.$kode.'/'.bulanRomawi(date('m')).'/'.date('Y');
       $update = Pecat::where('nip',$nip)->update($pecat);
       $non_aktif = Pegawai::where('nip',$nip)->update(['is_active'=>0,'soft_delete'=>1]);

       return redirect('/pm/pegawai/pecat');
    }

    public function getResign()
    {
      $resigns = Resign::get();

      return view('pm.pegawai.resign.index',['resigns'=>$resigns]);
    }

    public function getApproveResign($id)
    {
        $resign = Resign::find($id);

        return view('pm.pegawai.resign.approve',['resign'=>$resign]);
    }

    public function postApproveResign($id)
    {
      date_default_timezone_set("Asia/Jakarta");
      
      $kode = env("KODE_PROYEK");
      $jml_resign = env("USER_OUT");
      $jml = (int)$jml_resign + 1;
      setEnvironmentValue('USER_OUT',$jml);

      $nip = \Input::get('nip');
       $resign['is_verif_pm'] = 1;
       $resign['verif_pm_by'] = \Auth::user()->id;
       $resign['verify_pm_time'] = date('Y-m-d H:i:s');

       $resign['no_surat'] = tigadigit($jml).'/SKPK/WK/'.$kode.'/'.bulanRomawi(date('m')).'/'.date('Y');
       $update = Resign::where('nip',$nip)->update($resign);
       $non_aktif = Pegawai::where('nip',$nip)->update(['is_active'=>0,'soft_delete'=>1]);

       return redirect('/pm/pegawai/resign');
    }
}
