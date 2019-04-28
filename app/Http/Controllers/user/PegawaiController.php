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

class PegawaiController extends Controller
{
	public function index()
    {
        $pegawai = Pegawai::where('nip',\Auth::user()->pegawai_id)->first();
        $bank = BankAsuransi::where('nip',\Auth::user()->pegawai_id)->first();
        return view('user.pegawai.index',['pegawai'=>$pegawai,'bank'=>$bank]);
    }

    public function getEditCV($nip)
    {
      $pegawai = Pegawai::where('nip',$nip)->first();
      $bank = BankAsuransi::where('nip',$nip)->first();
    	$mcus = MCU::where('soft_delete','0')->get();
      $data_mcus = MCUPegawai::where('nip',$nip)->where('soft_delete','0')->get();
    	// dd($pegawai);
        return view('user.pegawai.cv',['pegawai'=>$pegawai,'bank'=>$bank,'mcus'=>$mcus,'data_mcus'=>$data_mcus]);
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
        
        foreach ($data['mcu'] as $key => $mcu) {
          $mcu = new MCUPegawai;
          $mcu->nip = $data['nip'];
          $mcu->pernyataan_id = $pernyataan[$key-1];
          $mcu->nilai = $mcu;
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
        return view('user.pegawai.resign.index');
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
