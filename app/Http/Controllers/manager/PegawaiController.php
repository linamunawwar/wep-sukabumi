<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Pegawai;
use App\KodeBagian;
use App\BankAsuransi;
use App\Gaji;
use App\Posisi;
use App\Pecat;
use App\Resign;
use App\MCU;
use App\MCUPegawai;

class PegawaiController extends Controller
{
    public function index()
    {
      if(\Auth::user()->pegawai->kode_bagian == 'SA'){
          $pegawais = Pegawai::where('is_active','!=',0)->where('soft_delete',0)->orwhere('is_active','')
                            ->where('soft_delete',0)->get();
        }elseif(\Auth::user()->pegawai->kode_bagian == 'QHSE'){
         $pegawais_qc = Pegawai::where('kode_bagian', 'QC')
                              ->where('is_active','!=',0)
                              ->where('soft_delete',0)
                              ->orwhere('is_active','')
                            ->where('soft_delete',0)
                            ->where('kode_bagian', 'QC')
                            ->get();

          $pegawais = [];

          foreach ($pegawais_qc as $key => $value) {
            $pegawais[] = $value;
          }

          $pegawais_hs =Pegawai::where('kode_bagian', 'HS')
                              ->where('is_active','!=',0)
                              ->where('soft_delete',0)
                              ->orwhere('is_active','')
                              ->where('kode_bagian', 'HS')
                            ->where('soft_delete',0)
                            ->get();

          foreach ($pegawais_hs as $key => $value) {
            $pegawais[] = $value;
          }

        }else{
          $pegawais = Pegawai::where('kode_bagian', \Auth::user()->pegawai->kode_bagian)
                            ->where('is_active','!=',0)
                            ->where('soft_delete',0)
                            ->orwhere('is_active','')
                            ->where('soft_delete',0)
                            ->where('kode_bagian', \Auth::user()->pegawai->kode_bagian)->get();

        }
        return view('manager.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function indexNonAktif()
    {
       $pegawais= Pegawai::where('is_active',0)->where('soft_delete',0)->get();
        return view('admin.pegawai.index_non_aktif',['pegawais'=>$pegawais]);
    }

    public function getStruktur()
    {
      $level = Posisi::groupBy('level')->get();
      foreach ($level as $key => $value) {
         $posisi[$value->level] = Posisi::where('level',$value->level)->where('soft_delete',0)->get();
      }

      $posisi = Posisi::where('level',0)->get();
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


      return view('admin.pegawai.struktur.index',['level'=>$level,'posisi'=>$posisi]);
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

    public function getCreatePecat(){
      $pegawais = Pegawai::where('kode_bagian', \Auth::user()->pegawai->kode_bagian)
                            ->where('is_active','1')
                            ->whereHas('user',function ($q){
                                $q->where('role_id', 2);
                            })
                            ->get();
      
      return view('manager.pegawai.pecat.create',['pegawais'=>$pegawais]);
      
    }

    public function getTanggalMasuk($nip){
      $pegawai = Pegawai::where('nip', $nip)->where('is_active','1')->first();
      
      $pegawai->tanggal_masuk = konversi_tanggal($pegawai->tanggal_masuk);
      $pegawai->gaji = $pegawai->gaji->gaji_pokok;
      
      return $pegawai;
    }

    public function postCreatePecat(){
      $data = \Input::all();
      
      $pecat = new Pecat;
      $pecat->nip = $data['nip'];
      $pecat->alasan = $data['alasan'];
      $terakhir_kerja = explode('-',$data['terakhir_kerja']);
      $data['terakhir_kerja'] = $terakhir_kerja[2].'-'.$terakhir_kerja[1].'-'.$terakhir_kerja[0];
      $pecat->terakhir_kerja =$data['terakhir_kerja'];
      $pecat->pesangon =$data['pesangon'];
      $pecat->is_verif_mngr = 1;
      $pecat->verif_mngr_by = \Auth::user()->id;
      $pecat->verify_mngr_time = date('Y-m-d H:i:s');
      $pecat->is_verif_sdm = 0;
      $pecat->verif_sdm_by = 0;
      $pecat->verify_sdm_time = 0;
      $pecat->is_verif_pm = 0;
      $pecat->verif_pm_by = 0;
      $pecat->verify_pm_time = 0;
      $pecat->user_id = \Auth::user()->id;
      $pecat->role_id = \Auth::user()->role_id;

      $pecat->save();

      $update = Pegawai::where('nip',$data['nip'])->update(['tanggal_keluar'=>$data['terakhir_kerja']]);

      return redirect('/manager/pegawai/pecat');
      
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
