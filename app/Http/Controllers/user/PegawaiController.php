<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Pegawai;
use App\KodeBagian;
use App\BankAsuransi;
use App\MCU;
use App\MCUPegawai;
use App\Resign;
use App\Pendidikan;
use App\Sertifikat;
use App\Pelatihan;
use App\Pengalaman;
use App\Penugasan;
use App\KaryaIlmiah;
use App\Pertemuan;
use App\Organisasi;
use App\Publikasi;
use App\TenagaPengajar;
use App\Penghargaan;

class PegawaiController extends Controller
{
	public function index()
    {
        $pegawai = Pegawai::where('is_active','!=',0)->where('nip',\Auth::user()->pegawai_id)->first();
        $bank = BankAsuransi::where('nip',\Auth::user()->pegawai_id)->first();
        return view('user.pegawai.index',['pegawai'=>$pegawai,'bank'=>$bank]);
    }

    public function getEditCV($nip)
    {
      $pegawai = Pegawai::where('nip',$nip)->first();
      $bank = BankAsuransi::where('nip',$nip)->first();
    	$mcus = MCU::where('soft_delete','0')->get();
      $kode = KodeBagian::all();
      $data_mcus = MCUPegawai::where('nip',$nip)->where('soft_delete','0')->get();
    	$pendidikan = Pendidikan::where('nip',$pegawai->nip)->get();
        $pendidikans = json_decode(json_encode($pendidikan), true);

        $sertifikat = Sertifikat::where('nip',$pegawai->nip)->get();
        $sertifikats = json_decode(json_encode($sertifikat), true);

        $pelatihan = Pelatihan::where('nip',$pegawai->nip)->get();
        $pelatihans = json_decode(json_encode($pelatihan), true);

        $pengalaman = Pengalaman::where('nip',$pegawai->nip)->get();
        $pengalamans = json_decode(json_encode($pengalaman), true);

        $penugasan = Penugasan::where('nip',$pegawai->nip)->get();
        $penugasans = json_decode(json_encode($penugasan), true);

        $presentasi = KaryaIlmiah::where('nip',$pegawai->nip)->where('publikasi','presentasi')->get();
        $presentasis = json_decode(json_encode($presentasi), true);

        $nopresentasi = KaryaIlmiah::where('nip',$pegawai->nip)->where('publikasi','nopresentasi')->get();
        $nopresentasis = json_decode(json_encode($nopresentasi), true);

        $nopublikasi = KaryaIlmiah::where('nip',$pegawai->nip)->where('publikasi','nopublikasi')->get();
        $nopublikasis = json_decode(json_encode($nopublikasi), true);

        $pertemuan = Pertemuan::where('nip',$pegawai->nip)->get();
        $pertemuans = json_decode(json_encode($pertemuan), true);

        $organisasi = Organisasi::where('nip',$pegawai->nip)->get();
        $organisasis = json_decode(json_encode($organisasi), true);

        $publikasi = Publikasi::where('nip',$pegawai->nip)->get();
        $publikasis = json_decode(json_encode($publikasi), true);

        $pengajar = TenagaPengajar::where('nip',$pegawai->nip)->get();
        $pengajars = json_decode(json_encode($pengajar), true);

        $penghargaan = Penghargaan::where('nip',$pegawai->nip)->get();
        $penghargaans = json_decode(json_encode($penghargaan), true);

        return view('user.pegawai.cv',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus,'data_mcus'=>$data_mcus,'pendidikans'=>$pendidikans,'sertifikats'=>$sertifikats,'pelatihans'=>$pelatihans,'pengalamans'=>$pengalamans,'penugasans'=>$penugasans,'presentasis'=>$presentasis, 'nopresentasis'=>$nopresentasis,'nopublikasis'=>$nopublikasis,'pertemuans'=>$pertemuans,'organisasis'=>$organisasis,'publikasis'=>$publikasis,'pengajars'=>$pengajars,'penghargaans'=>$penghargaans]);
    }

     public function postEditCV($nip)
    {
       $data = \Input::all();

       $pegawai['nama'] = $data['nama'];
       $pegawai['gelar_depan'] = $data['gelar_depan'];
       $pegawai['gelar_belakang'] = $data['gelar_belakang'];
       $pegawai['agama'] = $data['gelar_belakang'];
       $pegawai['tempat_lahir'] = $data['tempat_lahir'];
       $pegawai['status_kawin'] = $data['status_kawin'];
       $pegawai['suami_istri'] = $data['suami_istri'];
       $pegawai['alamat_tetap'] = $data['alamat_tetap'];
       $pegawai['anak'] = $data['anak'];
       $pegawai['alamat_sementara'] = $data['alamat_sementara'];
       $pegawai['telp'] = $data['telp'];
       $pegawai['hp'] = $data['hp'];
       $pegawai['fax'] = $data['fax'];
       $pegawai['email'] = $data['email'];
       $pegawai['email_kantor'] = $data['email_kantor'];
       $pegawai['nama_keluarga'] = $data['nama_keluarga'];
       $pegawai['hub_keluarga'] = $data['hub_keluarga'];
       $pegawai['alamat_keluarga'] = $data['alamat_keluarga'];
       $pegawai['telp_keluarga'] = $data['telp_keluarga'];
       $ori_file  = \Request::file('ttd');
       $tujuan = "upload/".$nip;
       $ekstension = $ori_file->getClientOriginalExtension();

      $nama_file = 'ttd_'.$nip.'.'.$ekstension;

      $ori_file->move($tujuan,$nama_file);
      $pegawai['ttd'] = $tujuan.'/'.$nama_file;
       $pegawai['is_new'] = 0;
       $pegawai['is_active'] = 0;
       $pegawai['is_verif_admin'] = 0;
       $pegawai['verif_admin_by'] = '';
       $pegawai['verify_admin_time'] = '';
       $pegawai['is_verif_mngr'] = 0;
       $pegawai['verif_mngr_by'] = '';
       $pegawai['verify_mngr_time'] = '';
       $pegawai['is_verif_pm'] = 0;
       $pegawai['verif_pm_by'] = '';
       $pegawai['verify_pm_time'] = '';

       $update = Pegawai::where('nip',$nip)->update($pegawai);

       $bank = new BankAsuransi;
       $bank->nip = $data['nip'];
       $bank->nama_bank = $data['nama_bank'];
       $bank->no_rekening = $data['no_rek'];
       $bank->npwp = $data['npwp'];
       $bank->jamsostek = $data['jamsostek'];
       $bank->dplk = $data['dplk'];
       $bank->jiwasraya = $data['jiwasraya'];
       $bank->asuransi_lain = $data['nama_asuransi'];
       $bank->nomor_lain = $data['nomor_asuransi'];

       $bank->save();

       $find_mcu = MCUPegawai::where('nip',$data['nip'])->first();

       if($find_mcu){
          $find_mcu = MCUPegawai::where('nip',$data['nip'])->update(['soft_delete'=>'1']);
        }

        $pernyataan = $data['pernyataan'];
        $data_mcu = $data['mcu'];
        
        foreach ($data['mcu'] as $key => $mcus) {
          $mcu = new MCUPegawai;
          $mcu->nip = $data['nip'];
          $mcu->pernyataan_id = $pernyataan[$key];
          $mcu->nilai = $mcus;
          $mcu->user_id = \Auth::user()->id;
          $mcu->role_id = \Auth::user()->role_id;

          $mcu->save();
        }
          
        
        
       return redirect('/user/pegawai');
    }

    public function getStruktur()
    {
        return view('user.pegawai.struktur.index');
    }

    public function getResign()
    {
      $resigns = Resign::where('soft_delete',0)->get();
      
      return view('user.pegawai.resign.index',['resigns'=>$resigns]);
    }

    public function getCreateResign()
    {
        return view('user.pegawai.resign.create');
    }

    public function postCreateResign()
    {
        $data = \Input::all();

        $resign = new Resign;
        $resign->nip = $data['nip'];
        $resign->alasan = $data['alasan'];
        $terakhir_kerja = explode('-', $data['terakhir_kerja']);
        $data['terakhir_kerja'] = $terakhir_kerja[2].'-'.$terakhir_kerja[1].'-'.$terakhir_kerja[0];
        $resign->terakhir_kerja = $data['terakhir_kerja'];
        $resign->user_id = \Auth::user()->id;
        $resign->role_id = \Auth::user()->role_id;
         $resign->is_verif_mngr = 0;
         $resign->verif_mngr_by = '';
         $resign->verify_mngr_time = '';
         $resign->is_verif_sdm = 0;
         $resign->verif_sdm_by = '';
         $resign->verify_sdm_time = '';
         $resign->is_verif_pm = 0;
         $resign->verif_pm_by = '';
         $resign->verify_pm_time = '';
        
        $resign->save();

        return redirect('/user/pegawai/resign');
    }
}
