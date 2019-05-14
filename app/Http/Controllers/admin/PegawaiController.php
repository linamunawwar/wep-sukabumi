<?php

namespace App\Http\Controllers\admin;

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
use App\Pendidikan;
use App\Sertifikat;
use App\Pelatihan;
use App\Pengalaman;
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

        $pendidikan = Pendidikan::where('nip',$pegawai->nip)->get();
        $pendidikans = json_decode(json_encode($pendidikan), true);

        $sertifikat = Sertifikat::where('nip',$pegawai->nip)->get();
        $sertifikats = json_decode(json_encode($sertifikat), true);

        $pelatihan = Pelatihan::where('nip',$pegawai->nip)->get();
        $pelatihans = json_decode(json_encode($pelatihan), true);

        $pengalaman = Pengalaman::where('nip',$pegawai->nip)->get();
        $pengalamans = json_decode(json_encode($pengalaman), true);

        return view('admin.pegawai.edit_cv',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus,'pendidikans'=>$pendidikans,'sertifikats'=>$sertifikats,'pelatihans'=>$pelatihans,'pengalamans'=>$pengalamans]);
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

       //-------------Pendidikan---------
        $del_pendidikan = Pendidikan::where('nip',$data['nip'])->delete();

        $jenjang = \Input::get('jenjang');
        $asal_sekolah = \Input::get('asal_sekolah');
        $kota = \Input::get('kota');
        $jurusan = \Input::get('jurusan');
        $tahun_lulus = \Input::get('tahun_lulus');
        $no_ijazah = \Input::get('no_ijazah');
        for ($i=0; $i < sizeof($jenjang) ; $i++) { 
          $pendidikan = new Pendidikan;
          $pendidikan->nip = $data['nip'];
          $pendidikan->jenjang = $jenjang[$i];
          $pendidikan->asal_sekolah = $asal_sekolah[$i];
          $pendidikan->kota = $kota[$i];
          $pendidikan->jurusan = $jurusan[$i];
          $pendidikan->tahun_lulus = $tahun_lulus[$i];
          $pendidikan->no_ijazah = $no_ijazah[$i];
          $pendidikan->user_id = \Auth::user()->id;
          $pendidikan->role_id = \Auth::user()->role_id;

          $pendidikan->save();
        }

        //-------------Sertifikat---------
        $del_sertifikat = Sertifikat::where('nip',$data['nip'])->delete();

        $sertifikat_mulai = \Input::get('sertifikat_mulai');
        $sertifikat_akhir = \Input::get('sertifikat_akhir');
        $nama_sertifikat = \Input::get('sertifikat');
        $no_sertifikat = \Input::get('no_sertifikat');
        $institusi_sertifikat = \Input::get('institusi_sertifikat');

        for ($i=0; $i < sizeof($sertifikat_mulai) ; $i++) { 
          $sertifikat = new Sertifikat;
          $sertifikat->nip = $data['nip'];
          $sertifikat->tanggal_mulai = $sertifikat_mulai[$i];
          $sertifikat->tanggal_akhir = $sertifikat_akhir[$i];
          $sertifikat->sertifikat = $nama_sertifikat[$i];
          $sertifikat->no_sertifikat = $no_sertifikat[$i];
          $sertifikat->institusi = $institusi_sertifikat[$i];
          $sertifikat->user_id = \Auth::user()->id;
          $sertifikat->role_id = \Auth::user()->role_id;

          $sertifikat->save();
        }

        //-------------Pelatihan---------
        $del_pelatihan = Pelatihan::where('nip',$data['nip'])->delete();

        $pelatihan_tanggal = \Input::get('pelatihan_tanggal');
        $nama_pelatihan = \Input::get('nama_pelatihan');
        $tempat_pelatihan = \Input::get('tempat_pelatihan');
        $jam_hari = \Input::get('jam_hari');
        $penyelenggara_pelatihan = \Input::get('penyelenggara_pelatihan');

        for ($i=0; $i < sizeof($pelatihan_tanggal) ; $i++) { 
          $pelatihan = new Pelatihan;
          $pelatihan->nip = $data['nip'];
          $pelatihan->tanggal = $pelatihan_tanggal[$i];
          $pelatihan->nama_pelatihan = $nama_pelatihan[$i];
          $pelatihan->tempat = $tempat_pelatihan[$i];
          $pelatihan->jam_hari = $jam_hari[$i];
          $pelatihan->penyelenggara = $penyelenggara_pelatihan[$i];
          $pelatihan->user_id = \Auth::user()->id;
          $pelatihan->role_id = \Auth::user()->role_id;

          $pelatihan->save();
        }

        //-------------Pengalaman Kerja---------
        $del_pengalaman = Pengalaman::where('nip',$data['nip'])->delete();

        $mulai_kerja = \Input::get('mulai_kerja');
        $akhir_kerja = \Input::get('akhir_kerja');
        $nama_perusahaan = \Input::get('nama_perusahaan');
        $jabatan = \Input::get('jabatan');
        $keterangan = \Input::get('keterangan');

        for ($i=0; $i < sizeof($mulai_kerja) ; $i++) { 
          $pengalaman = new Pengalaman;
          $pengalaman->nip = $data['nip'];
          $pengalaman->tanggal_mulai = $mulai_kerja[$i];
          $pengalaman->tanggal_akhir = $akhir_kerja[$i];
          $pengalaman->nama_perusahaan = $nama_perusahaan[$i];
          $pengalaman->jabatan = $jabatan[$i];
          $pengalaman->keterangan = $keterangan[$i];
          $pengalaman->user_id = \Auth::user()->id;
          $pengalaman->role_id = \Auth::user()->role_id;

          $pengalaman->save();
        }

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

    public function getResign()
    {
      $resigns = Resign::get();

      return view('admin.pegawai.resign.index',['resigns'=>$resigns]);
    }
}
