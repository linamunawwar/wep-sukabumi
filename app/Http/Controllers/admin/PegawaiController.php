<?php

namespace App\Http\Controllers\admin;

use App\Roles;
use App\Pegawai;
use App\KodeBagian;
use App\BankAsuransi;
use App\Gaji;
use App\Posisi;
use App\Pecat;
use App\MCU;
use App\MCUPegawai;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{

    public function index()
    {
    	 $pegawais= Pegawai::get();
        return view('admin.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function getCreate()
    {
        $roles= Roles::get();
        $kode = KodeBagian::all();
        $posisi = Posisi::all();
        
        return view('admin.pegawai.create',['roles'=>$roles,'kode'=>$kode,'posisi'=>$posisi]);
    }

    public function postCreate()
    {
    	date_default_timezone_set("Asia/Jakarta");
        $nama = \Input::get('nama');
        $gender = \Input::get('gender');
        $date = \Input::get('tgl_lahir');
        $date_masuk = \Input::get('tgl_masuk');

        $dates = explode('-', $date);
		  $tgl_lahir = $dates[2].'-'.$dates[1].'-'.$dates[0];

        $dates_msk = explode('-', $date_masuk);
        $tgl_masuk = $dates_msk[2].'-'.$dates_msk[1].'-'.$dates_msk[0];

        $kode_bagian = \Input::get('kode_bagian');
        $role = \Input::get('role');
        
        $tahun = str_split($dates[2],2);
        $nip = $kode_bagian.$dates[0].$dates[1].$tahun[1];
        $password = str_random(6);

        $user['name'] = $nama;
        $user['pegawai_id'] = $nip;
        $user['pass_asli'] = $password;
        $user['password'] = \Hash::make($password);
        $user['role_id'] = $role;
        $user['created_at'] = date('Y-m-d H:i:s');

        $query_user = \DB::table('users')->insert($user);

        unset($user['pass_asli']);
        unset($user['password']);
        unset($user['pegawai_id']);
        unset($user['name']);
        $data = $user;
        $data['nama'] = $nama;
        $data['nip'] = $nip;
        $data['kode_bagian'] = $kode_bagian;
        $data['posisi_id'] = \Input::get('posisi_id');
        $data['gender'] = $gender;
        $data['tanggal_lahir'] = $tgl_lahir;
        $data['tanggal_masuk'] = $tgl_masuk;
        $data['is_new'] = 1;
        $data['is_verif_admin'] = 0;
        $data['is_verif_mngr'] = 0;
        $data['is_verif_pm'] = 0;
        $query_pegawai = \DB::table('mst_pegawai')->insert($data);


        if($query_user && $query_pegawai){
            return Redirect('admin/pegawai')->with(['msg'=>'Data berhasil ditambahkan','status'=>1]);
        }else{
            return Redirect('admin/pegawai')->with(['msg'=>'Terdapat Kesalahan','status'=>0]);
        }
    }

    public function getEdit($id)
    {
        $pegawai = Pegawai::find($id);
        $roles= Roles::get();
        $kode = KodeBagian::all();
        $posisi = Posisi::all();

        return view('admin.pegawai.edit',['pegawai'=>$pegawai,'roles'=>$roles,'kode'=>$kode,'posisi'=>$posisi]);
    }

    public function postEdit($id)
    {
        $pegawai = Pegawai::find($id);

        date_default_timezone_set("Asia/Jakarta");
        $nama = \Input::get('nama');
        $gender = \Input::get('gender');
        $date = \Input::get('tgl_lahir');
        $date_masuk = \Input::get('tgl_masuk');

        $dates = explode('-', $date);
        $tgl_lahir = $dates[2].'-'.$dates[1].'-'.$dates[0];

        $dates_msk = explode('-', $date_masuk);
        $tgl_masuk = $dates_msk[2].'-'.$dates_msk[1].'-'.$dates_msk[0];

        $kode_bagian = \Input::get('kode_bagian');
        $role = \Input::get('role');
        
        $tahun = str_split($dates[2],2);
        $nip = $kode_bagian.$dates[0].$dates[1].$tahun[1];
        $password = str_random(6);

        $user['name'] = $nama;
        $user['pegawai_id'] = $nip;
        $user['pass_asli'] = $password;
        $user['password'] = \Hash::make($password);
        $user['role_id'] = $role;
        $user['updated_at'] = date('Y-m-d H:i:s');

        $query_user = \DB::table('users')->where('pegawai_id',$pegawai->nip)->update($user);

        unset($user['pass_asli']);
        unset($user['password']);
        unset($user['pegawai_id']);
        unset($user['name']);
        $data = $user;
        $data['nama'] = $nama;
        $data['nip'] = $nip;
        $data['kode_bagian'] = $kode_bagian;
        $data['posisi_id'] = \Input::get('posisi_id');
        $data['gender'] = $gender;
        $data['tanggal_lahir'] = $tgl_lahir;
        $data['tanggal_masuk'] = $tgl_masuk;
        $data['is_new'] = 1;
        $data['is_verif_admin'] = 0;
        $data['is_verif_mngr'] = 0;
        $data['is_verif_pm'] = 0;
        $query_pegawai = \DB::table('mst_pegawai')->where('id',$id)->update($data);


        if($query_user && $query_pegawai){
            return Redirect('admin/pegawai')->with(['msg'=>'Data berhasil ditambahkan','status'=>1]);
        }else{
            return Redirect('admin/pegawai')->with(['msg'=>'Terdapat Kesalahan','status'=>0]);
        }
    }

    public function getEditCV($id)
    {
        $pegawai = Pegawai::find($id);
        $bank= BankAsuransi::where('nip',$pegawai->nip)->first();
        $kode = KodeBagian::all();
        $mcus = MCU::where('soft_delete','0')->get();

        return view('admin.pegawai.edit_cv',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus]);
    }

    public function postEditCV($id)
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

       $update = Pegawai::where('nip',$data['nip'])->update($pegawai);

       $bank['nip'] = $data['nip'];
       $bank['nama_bank'] = $data['nama_bank'];
       $bank['no_rekening'] = $data['no_rek'];
       $bank['npwp'] = $data['npwp'];
       $bank['jamsostek'] = $data['jamsostek'];
       $bank['dplk'] = $data['dplk'];
       $bank['jiwasraya'] = $data['jiwasraya'];
       $bank['asuransi_lain'] = $data['nama_asuransi'];
       $bank['nomor_lain'] = $data['nomor_asuransi'];

       $update_bank = BankAsuransi::where('nip',$data['nip'])->update($bank);

        return redirect('/admin/pegawai');
    }

    public function getApprove($id)
    {
        $pegawai = Pegawai::find($id);
        $bank= BankAsuransi::where('nip',$pegawai->nip)->first();
        $kode = KodeBagian::all();
        $mcus = MCU::where('soft_delete','0')->get();

        return view('admin.pegawai.approve_admin',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus]);
    }

    public function postApprove($id)
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
       $pegawai['is_verif_admin'] = 1;
       $pegawai['verif_admin_by'] = \Auth::user()->id;
       $pegawai['verify_admin_time'] = date('Y-m-d H:i:s');

       $update = Pegawai::where('nip',$data['nip'])->update($pegawai);

       $bank['nip'] = $data['nip'];
       $bank['nama_bank'] = $data['nama_bank'];
       $bank['no_rekening'] = $data['no_rek'];
       $bank['npwp'] = $data['npwp'];
       $bank['jamsostek'] = $data['jamsostek'];
       $bank['dplk'] = $data['dplk'];
       $bank['jiwasraya'] = $data['jiwasraya'];
       $bank['asuransi_lain'] = $data['nama_asuransi'];
       $bank['nomor_lain'] = $data['nomor_asuransi'];

       $update_bank = BankAsuransi::where('nip',$data['nip'])->update($bank);

       $find_gaji = Gaji::where('nip',$data['nip'])->first();

       if($find_gaji){
            $gaji['nip'] = $data['nip'];
           $gaji['gaji_pokok'] = $data['gaji_pokok'];
           $gaji['tunj_komunikasi'] = $data['tunj_komunikasi'];
           $gaji['tunj_transportasi'] = $data['tunj_transportasi'];
           $gaji['uang_makan'] = $data['uang_makan'];
           $gaji['tunj_pph21'] = $data['tunj_pph21'];
           $gaji['pph21'] = $data['pph21'];
           $gaji['user_id'] = \Auth::user()->id;
           $gaji['role_id'] = \Auth::user()->role_id;
            $update_gaji = Gaji::where('nip',$data['nip'])->update($gaji);

        }else{
            $gaji = new Gaji;
            $gaji->nip = $data['nip'];
           $gaji->gaji_pokok = $data['gaji_pokok'];
           $gaji->tunj_komunikasi = $data['tunj_komunikasi'];
           $gaji->tunj_transportasi = $data['tunj_transportasi'];
           $gaji->uang_makan = $data['uang_makan'];
           $gaji->tunj_pph21 = $data['tunj_pph21'];
           $gaji->pph21 = $data['pph21'];
           $gaji->user_id = \Auth::user()->id;
           $gaji->role_id = \Auth::user()->role_id;

            $gaji->save();
        }


        return redirect('/admin/pegawai');
    }

    public function getStruktur()
    {
      $level = Posisi::groupBy('level')->get();
      foreach ($level as $key => $value) {
         $posisi[$value->level] = Posisi::where('level',$value->level)->get();

      }

      // $atasans = Pegawai::whereHas('posisi', function ($q){
      //     $q->where('parent', '1');
      // })->get();


      return view('admin.pegawai.struktur.index',['level'=>$level,'posisi'=>$posisi]);
    }

    public function getPecat()
    {
      $pecats = Pecat::get();

      return view('admin.pegawai.pecat.index',['pecats'=>$pecats]);
    }

    public function getCreatePecat(){
      $pegawais = Pegawai::where('is_active','1')->get();
      
      return view('admin.pegawai.pecat.create',['pegawais'=>$pegawais]);
      
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

      return redirect('/admin/pegawai/pecat');
      
    }
}
