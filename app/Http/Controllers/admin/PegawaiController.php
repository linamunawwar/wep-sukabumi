<?php

namespace App\Http\Controllers\admin;
use PDF;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;
use App\Roles;
use App\Pegawai;
use App\Models\User;
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
use App\PelatihanCV;
use App\Pengalaman;
use App\Penugasan;
use App\KaryaIlmiah;
use App\Pertemuan;
use App\Organisasi;
use App\Publikasi;
use App\TenagaPengajar;
use App\Penghargaan;
use App\Pkwt;
use App\Menu;
use App\Permission;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{

    public function index()
    {
    	 $pegawais= Pegawai::where('is_active','!=',0)
                            ->where('soft_delete',0)
                            ->orwhere('is_active','')
                            ->where('soft_delete',0)
                            ->get();
        foreach ($pegawais as $key => $value) {
          $pkwt = Pkwt::where('nip',$value->nip)->latest()->first();
          $value->data_pkwt = $pkwt;
        }
        
        return view('admin.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function indexNonAktif()
    {
       $pegawais= Pegawai::where('is_active',0)
                          ->where('soft_delete',1)
                          ->get();

        return view('admin.pegawai.index_non_aktif',['pegawais'=>$pegawais]);
    }

     public function deleteNonAktif(){
      $data = Input::all();
      $del = Pegawai::where('nip',$data['nip'])->delete();
      $del_user = User::where('pegawai_id',$data['nip'])->delete();

      if($del && $del_user){
        return redirect('admin/pegawai_non_aktif');
      }

    }

    public function getCreate()
    {
        $roles= Roles::get();
        $kode = KodeBagian::all();
        $posisi = Posisi::where('soft_delete',0)->get();
        
        return view('admin.pegawai.create',['roles'=>$roles,'kode'=>$kode,'posisi'=>$posisi]);
    }

    public function getPosisi($kode)
    {
        $posisi = Posisi::where('kode',$kode)->get();
        
        return $posisi;
    }

    public function postCreate()
    {
    	date_default_timezone_set("Asia/Jakarta");
        $nama = \Input::get('nama');
        $gender = \Input::get('gender');
        $date = \Input::get('tgl_lahir');
        $date_masuk = \Input::get('tgl_masuk');
        $status_pegawai = \Input::get('status_pegawai');

        $dates = explode('-', $date);
		    $tgl_lahir = $dates[2].'-'.$dates[1].'-'.$dates[0];

        $dates_msk = explode('-', $date_masuk);
        $tgl_masuk = $dates_msk[2].'-'.$dates_msk[1].'-'.$dates_msk[0];

        $kode_bagian = \Input::get('kode_bagian');
        $role = \Input::get('role');
        
        $tahun = str_split($dates[2],2);
        if(($role == 3) || ($role == 4)){
          $nip = $kode_bagian.'M'.$dates[0].$dates[1].$tahun[1];
        }else{
          $nip = $kode_bagian.$dates[0].$dates[1].$tahun[1];
        }
        $password = str_random(6);

        //cek nip ada yg sama gak
        $array_nip = [];
        $nips = Pegawai::select('nip')->where('soft_delete',0)->get();
        foreach ($nips as $key => $val) {
          $array_nip[]=$val->nip;
        }
        
        while (in_array($nip, $array_nip)) {
          $nip = $nip.rand(0,9);
        }

        $user['name'] = $nama;
        $user['pegawai_id'] = $nip;
        $user['pass_asli'] = $password;
        $user['password'] = \Hash::make($password);
        $user['role_id'] = $role;
        $user['created_at'] = date('Y-m-d H:i:s');

        $query_user = \DB::table('users')->insertGetId($user);

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
        $data['status_pegawai'] = $status_pegawai;
        $data['is_active'] = '';
        $data['is_new'] = 1;
        $data['is_verif_admin'] = 0;
        $data['is_verif_mngr'] = 0;
        $data['is_verif_pm'] = 0;
        $data['user_id'] = $query_user;
        $query_pegawai = \DB::table('mst_pegawai')->insert($data);

        // set permission menu
        $menus = Menu::where('default_role',$role)->where('active',1)->get();
        foreach ($menus as $key => $menu) {
          $insert = new Permission;
          $insert->id_menu = $menu->id;
          $insert->id_user = $query_user;
          if(!($insert->save())){
            break;
          }
        }


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

    public function postDelete(){
      $data = Input::all();
      $update = Pegawai::where('nip',$data['nip'])->update(['soft_delete'=>1]);

      if($update){
        return redirect('admin/pegawai');
      }

    }

    public function getEditCV($id)
    {
        $pegawai = Pegawai::find($id);
        $bank= BankAsuransi::where('nip',$pegawai->nip)->first();
        $kode = KodeBagian::all();
        $mcus = MCU::where('soft_delete','0')->get();
        $pkwt = Pkwt::where('nip',$pegawai->nip)->where('soft_delete',0)->latest()->first();

        $pendidikan = Pendidikan::where('user_id',$pegawai->user_id)->get();
        $pendidikans = json_decode(json_encode($pendidikan), true);

        $sertifikat = Sertifikat::where('user_id',$pegawai->user_id)->get();
        $sertifikats = json_decode(json_encode($sertifikat), true);

        $pelatihan = PelatihanCV::where('user_id',$pegawai->user_id)->get();
        $pelatihans = json_decode(json_encode($pelatihan), true);

        $pengalaman = Pengalaman::where('user_id',$pegawai->user_id)->get();
        $pengalamans = json_decode(json_encode($pengalaman), true);

        $penugasan = Penugasan::where('user_id',$pegawai->user_id)->get();
        $penugasans = json_decode(json_encode($penugasan), true);

        $presentasi = KaryaIlmiah::where('user_id',$pegawai->user_id)->where('publikasi','presentasi')->get();
        $presentasis = json_decode(json_encode($presentasi), true);

        $nopresentasi = KaryaIlmiah::where('user_id',$pegawai->user_id)->where('publikasi','nopresentasi')->get();
        $nopresentasis = json_decode(json_encode($nopresentasi), true);

        $nopublikasi = KaryaIlmiah::where('user_id',$pegawai->user_id)->where('publikasi','nopublikasi')->get();
        $nopublikasis = json_decode(json_encode($nopublikasi), true);

        $pertemuan = Pertemuan::where('user_id',$pegawai->user_id)->get();
        $pertemuans = json_decode(json_encode($pertemuan), true);

        $organisasi = Organisasi::where('user_id',$pegawai->user_id)->get();
        $organisasis = json_decode(json_encode($organisasi), true);

        $publikasi = Publikasi::where('user_id',$pegawai->user_id)->get();
        $publikasis = json_decode(json_encode($publikasi), true);

        $pengajar = TenagaPengajar::where('user_id',$pegawai->user_id)->get();
        $pengajars = json_decode(json_encode($pengajar), true);

        $penghargaan = Penghargaan::where('user_id',$pegawai->user_id)->get();
        $penghargaans = json_decode(json_encode($penghargaan), true);

        return view('admin.pegawai.edit_cv',['pegawai'=>$pegawai,'pkwt'=>$pkwt,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus,'pendidikans'=>$pendidikans,'sertifikats'=>$sertifikats,'pelatihans'=>$pelatihans,'pengalamans'=>$pengalamans,'penugasans'=>$penugasans,'presentasis'=>$presentasis, 'nopresentasis'=>$nopresentasis,'nopublikasis'=>$nopublikasis,'pertemuans'=>$pertemuans,'organisasis'=>$organisasis,'publikasis'=>$publikasis,'pengajars'=>$pengajars,'penghargaans'=>$penghargaans]);
    }

    public function postEditCV($id)
    {
      $data = \Input::all();

      $user = User::where('pegawai_id',$data['nip'])->first();

       $pegawai['nama'] = $data['nama'];
       $pegawai['gelar_depan'] = $data['gelar_depan'];
       $pegawai['gelar_belakang'] = $data['gelar_belakang'];
       $pegawai['agama'] = $data['gelar_belakang'];
       if(array_key_exists('gender', $data)){
            $pegawai['gender'] = $data['gender'];
       }
       $pegawai['tempat_lahir'] = $data['tempat_lahir'];
       $pegawai['status_kawin'] = $data['status_kawin'];
       $pegawai['suami_istri'] = $data['suami_istri'];
       $pegawai['alamat_tetap'] = $data['alamat_tetap'];
       $pegawai['anak'] = $data['anak'];
       $pegawai['agama'] = $data['agama'];
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
       $pegawai['is_verif_admin'] = 0;
       $pegawai['verif_admin_by'] = '';
       $pegawai['verify_admin_time'] = '';
       $pegawai['is_verif_mngr'] = 0;
       $pegawai['verif_mngr_by'] = '';
       $pegawai['verify_mngr_time'] = '';
       $pegawai['is_verif_pm'] = 0;
       $pegawai['verif_pm_by'] = '';
       $pegawai['verify_pm_time'] = '';
       $pegawai['user_id'] = $user->id;
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
       $bank['user_id'] = $user->id;
       $find_bank = BankAsuransi::where('user_id',$user->id)->first();
       if($find_bank){
        $update_bank = BankAsuransi::where('user_id',$user->id)->update($bank);
      }else{
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
         $bank->user_id = $user->id;
       
        $bank->save();
      }

       //-------------Pendidikan---------
        $del_pendidikan = Pendidikan::where('user_id',$user->id)->delete();

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
          $pendidikan->user_id = $user->id;
          $pendidikan->role_id = $user->role_id;

          if($pendidikan->jenjang != ''){
            $pendidikan->save();
          }
        }

        //-------------Sertifikat---------
        $del_sertifikat = Sertifikat::where('user_id',$user->id)->delete();

        $sertifikat_mulai = \Input::get('sertifikat_mulai');
        $sertifikat_akhir = \Input::get('sertifikat_akhir');
        $nama_sertifikat = \Input::get('sertifikat');
        $no_sertifikat = \Input::get('no_sertifikat');
        $institusi_sertifikat = \Input::get('institusi_sertifikat');

        for ($i=0; $i < sizeof($sertifikat_mulai) ; $i++) { 
          $sertifikat = new Sertifikat;
          $sertifikat->nip = $data['nip'];
          $sertifikat->tanggal_mulai = konversi_tanggal($sertifikat_mulai[$i]);
          $sertifikat->tanggal_akhir = konversi_tanggal($sertifikat_akhir[$i]);
          $sertifikat->sertifikat = $nama_sertifikat[$i];
          $sertifikat->no_sertifikat = $no_sertifikat[$i];
          $sertifikat->institusi = $institusi_sertifikat[$i];
          $sertifikat->user_id = $user->id;
          $sertifikat->role_id = $user->role_id;

          if($sertifikat->sertifikat != ''){
            $sertifikat->save();
          }
        }

        //-------------Pelatihan---------
        $del_pelatihan = PelatihanCV::where('user_id',$user->id)->delete();

        $pelatihan_tanggal = \Input::get('pelatihan_tanggal');
        $nama_pelatihan = \Input::get('nama_pelatihan');
        $tempat_pelatihan = \Input::get('tempat_pelatihan');
        $jam_hari = \Input::get('jam_hari');
        $penyelenggara_pelatihan = \Input::get('penyelenggara_pelatihan');

        for ($i=0; $i < sizeof($pelatihan_tanggal) ; $i++) { 
          $pelatihan = new PelatihanCV;
          $pelatihan->nip = $data['nip'];
          $pelatihan->tanggal = konversi_tanggal($pelatihan_tanggal[$i]);
          $pelatihan->nama_pelatihan = $nama_pelatihan[$i];
          $pelatihan->tempat = $tempat_pelatihan[$i];
          $pelatihan->jam_hari = $jam_hari[$i];
          $pelatihan->penyelenggara = $penyelenggara_pelatihan[$i];
          $pelatihan->user_id = $user->id;
          $pelatihan->role_id = $user->role_id;

          if($pelatihan->tanggal != ''){
            $pelatihan->save();
          }
        }

        //-------------Pengalaman Kerja---------
        $del_pengalaman = Pengalaman::where('user_id',$user->id)->delete();

        $mulai_kerja = \Input::get('mulai_kerja');
        $akhir_kerja = \Input::get('akhir_kerja');
        $nama_perusahaan = \Input::get('nama_perusahaan');
        $jabatan = \Input::get('jabatan');
        $keterangan = \Input::get('keterangan');

        for ($i=0; $i < sizeof($mulai_kerja) ; $i++) { 
          $pengalaman = new Pengalaman;
          $pengalaman->nip = $data['nip'];
          $pengalaman->tanggal_mulai = konversi_tanggal($mulai_kerja[$i]);
          $pengalaman->tanggal_akhir = konversi_tanggal($akhir_kerja[$i]);
          $pengalaman->nama_perusahaan = $nama_perusahaan[$i];
          $pengalaman->jabatan = $jabatan[$i];
          $pengalaman->keterangan = $keterangan[$i];
          $pengalaman->user_id = $user->id;
          $pengalaman->role_id = $user->role_id;

          if($pengalaman->tanggal_mulai != ''){
            $pengalaman->save();
          }
        }

        //-------------Penugasan---------
        $del_penugasan= Penugasan::where('user_id',$user->id)->delete();

        $mulai_tugas = \Input::get('mulai_tugas');
        $akhir_tugas = \Input::get('akhir_tugas');
        $no_sk = \Input::get('no_sk');
        $jabatan_tugas = \Input::get('jabatan_tugas');
        $unit_kerja = \Input::get('unit_kerja');
        $kj = \Input::get('kj');
        $kk = \Input::get('kk');
        $tempat_kerja = \Input::get('tempat_kerja');
        $prestasi_rencana = \Input::get('prestasi_rencana');
        $prestasi_realisasi = \Input::get('prestasi_realisasi');
        $nama_atasan = \Input::get('nama_atasan');
        $jabatan_atasan = \Input::get('jabatan_atasan');

        for ($i=0; $i < sizeof($mulai_tugas) ; $i++) { 
          $penugasan = new Penugasan;
          $penugasan->nip = $data['nip'];
          $penugasan->tanggal_mulai = konversi_tanggal($mulai_tugas[$i]);
          $penugasan->tanggal_akhir = konversi_tanggal($akhir_tugas[$i]);
          $penugasan->no_sk = $no_sk[$i];
          $penugasan->jabatan = $jabatan_tugas[$i];
          $penugasan->unit_kerja = $unit_kerja[$i];
          $penugasan->KJ = $kj[$i];
          $penugasan->KK = $kk[$i];
          $penugasan->tempat_kerja = $tempat_kerja[$i];
          $penugasan->prestasi_rencana = $prestasi_rencana[$i];
          $penugasan->prestasi_realisasi = $prestasi_realisasi[$i];
          $penugasan->nama_atasan = $nama_atasan[$i];
          $penugasan->jabatan_atasan = $jabatan_atasan[$i];
          $penugasan->user_id = $user->id;
          $penugasan->role_id = $user->role_id;

          if($penugasan->tanggal_mulai != ''){
            $penugasan->save();
          }
        }

        //-------------Karya Ilmiah Presentasi---------
        $del_presentasi = KaryaIlmiah::where('user_id',$user->id)->where('publikasi','presentasi')->delete();

        $tanggal_presentasi = \Input::get('tanggal_presentasi');
        $judul_presentasi = \Input::get('judul_presentasi');
        $tempat_presentasi = \Input::get('tempat_presentasi');
        $sifat_presentasi = \Input::get('sifat_presentasi');
        $lingkup_presentasi = \Input::get('lingkup_presentasi');
        $referensi_presentasi = \Input::get('referensi_presentasi');

        for ($i=0; $i < sizeof($tanggal_presentasi) ; $i++) { 
          $presentasi = new KaryaIlmiah;
          $presentasi->nip = $data['nip'];
          $presentasi->tanggal = konversi_tanggal($tanggal_presentasi[$i]);
          $presentasi->publikasi = 'presentasi';
          $presentasi->judul = $judul_presentasi[$i];
          $presentasi->tempat = $tempat_presentasi[$i];
          $presentasi->sifat = $sifat_presentasi[$i];
          $presentasi->lingkup_kegiatan = $lingkup_presentasi[$i];
          $presentasi->referensi = $referensi_presentasi[$i];
          $presentasi->user_id = $user->id;
          $presentasi->role_id = $user->role_id;

          if($presentasi->tanggal != ''){
            $presentasi->save();
          }
        }

        //-------------Karya Ilmiah No Presentasi---------
        $del_nopresentasi = KaryaIlmiah::where('user_id',$user->id)->where('publikasi','nopresentasi')->delete();

        $tanggal_nopresentasi = \Input::get('tanggal_nopresentasi');
        $judul_nopresentasi = \Input::get('judul_nopresentasi');
        $tempat_nopresentasi = \Input::get('tempat_nopresentasi');
        $sifat_nopresentasi = \Input::get('sifat_nopresentasi');
        $lingkup_nopresentasi = \Input::get('lingkup_nopresentasi');
        $referensi_nopresentasi = \Input::get('referensi_nopresentasi');

        for ($i=0; $i < sizeof($tanggal_nopresentasi) ; $i++) { 
          $nopresentasi = new KaryaIlmiah;
          $nopresentasi->nip = $data['nip'];
          $nopresentasi->tanggal = konversi_tanggal($tanggal_nopresentasi[$i]);
          $nopresentasi->publikasi = 'nopresentasi';
          $nopresentasi->judul = $judul_nopresentasi[$i];
          $nopresentasi->tempat = $tempat_nopresentasi[$i];
          $nopresentasi->sifat = $sifat_nopresentasi[$i];
          $nopresentasi->lingkup_kegiatan = $lingkup_nopresentasi[$i];
          $nopresentasi->referensi = $referensi_nopresentasi[$i];
          $nopresentasi->user_id = $user->id;
          $nopresentasi->role_id = $user->role_id;

          if($nopresentasi->tanggal != ''){
            $nopresentasi->save();
          }
        }

        //-------------Karya Ilmiah No Publikasi---------
        $del_nopublikasi = KaryaIlmiah::where('user_id',$user->id)->where('publikasi','nopublikasi')->delete();

        $tanggal_nopublikasi = \Input::get('tanggal_nopublikasi');
        $judul_nopublikasi = \Input::get('judul_nopublikasi');
        $tempat_nopublikasi = \Input::get('tempat_nopublikasi');
        $sifat_nopublikasi = \Input::get('sifat_nopublikasi');
        $lingkup_nopublikasi = \Input::get('lingkup_nopublikasi');
        $referensi_nopublikasi = \Input::get('referensi_nopublikasi');

        for ($i=0; $i < sizeof($tanggal_nopublikasi) ; $i++) { 
          $nopublikasi = new KaryaIlmiah;
          $nopublikasi->nip = $data['nip'];
          $nopublikasi->tanggal = konversi_tanggal($tanggal_nopublikasi[$i]);
          $nopublikasi->publikasi = 'nopublikasi';
          $nopublikasi->judul = $judul_nopublikasi[$i];
          $nopublikasi->tempat = $tempat_nopublikasi[$i];
          $nopublikasi->sifat = $sifat_nopublikasi[$i];
          $nopublikasi->lingkup_kegiatan = $lingkup_nopublikasi[$i];
          $nopublikasi->referensi = $referensi_nopublikasi[$i];
          $nopublikasi->user_id = $user->id;
          $nopublikasi->role_id = $user->role_id;

          if($nopublikasi->tanggal != ''){
            $nopublikasi->save();
          }
        }

        //-------------Pertemuan---------
        $del_pertemuan = Pertemuan::where('user_id',$user->id)->delete();

        $tanggal_pertemuan = \Input::get('tanggal_pertemuan');
        $tema = \Input::get('tema');
        $organisasi_penyelenggara = \Input::get('organisasi_penyelenggara');
        $tempat_pertemuan = \Input::get('tempat_pertemuan');
        $hadir_sebagai = \Input::get('hadir_sebagai');
        $lingkup_pertemuan = \Input::get('lingkup_pertemuan');
        $referensi_pertemuan = \Input::get('referensi_pertemuan');

        for ($i=0; $i < sizeof($tanggal_pertemuan) ; $i++) { 
          $pertemuan = new Pertemuan;
          $pertemuan->nip = $data['nip'];
          $pertemuan->tanggal = konversi_tanggal($tanggal_pertemuan[$i]);
          $pertemuan->tema = $tema[$i];
          $pertemuan->penyelenggara = $organisasi_penyelenggara[$i];
          $pertemuan->tempat = $tanggal_pertemuan[$i];
          $pertemuan->hadir_sebagai = $hadir_sebagai[$i];
          $pertemuan->lingkup_kegiatan = $lingkup_pertemuan[$i];
          $pertemuan->referensi = $referensi_pertemuan[$i];
          $pertemuan->user_id = $user->id;
          $pertemuan->role_id = $user->role_id;

          if($pertemuan->tanggal != ''){
            $pertemuan->save();
          }
        }

        //-------------Organisasi---------
        $del_organisasi = Organisasi::where('user_id',$user->id)->delete();

        $tanggal_organisasi = \Input::get('tanggal_organisasi');
        $nama_organisasi = \Input::get('nama_organisasi');
        $tempat_organisasi = \Input::get('tempat_organisasi');
        $aktif_sebagai = \Input::get('aktif_sebagai');
        $lingkup_organisasi = \Input::get('lingkup_organisasi');
        $referensi_organisasi = \Input::get('referensi_organisasi');

        for ($i=0; $i < sizeof($tanggal_organisasi) ; $i++) { 
          $organisasi = new Organisasi;
          $organisasi->nip = $data['nip'];
          $organisasi->tanggal = konversi_tanggal($tanggal_organisasi[$i]);
          $organisasi->nama_organisasi = $nama_organisasi[$i];
          $organisasi->tempat = $tempat_organisasi[$i];
          $organisasi->aktif_sebagai = $aktif_sebagai[$i];
          $organisasi->lingkup_kegiatan = $lingkup_organisasi[$i];
          $organisasi->referensi = $referensi_organisasi[$i];
          $organisasi->user_id = $user->id;
          $organisasi->role_id = $user->role_id;

          if($organisasi->tanggal != ''){
            $organisasi->save();
          }
        }

        //-------------Publikasi---------
        $del_publikasi = Publikasi::where('user_id',$user->id)->delete();

        $tanggal_publikasi = \Input::get('tanggal_publikasi');
        $nama_publikasi = \Input::get('nama_publikasi');
        $tempat_publikasi = \Input::get('tempat_publikasi');
        $aktif_sebagai_publikasi = \Input::get('aktif_sebagai_publikasi');
        $lingkup_publikasi = \Input::get('lingkup_publikasi');
        $referensi_publikasi = \Input::get('referensi_publikasi');

        for ($i=0; $i < sizeof($tanggal_publikasi) ; $i++) { 
          $publikasi = new Publikasi;
          $publikasi->nip = $data['nip'];
          $publikasi->tanggal = konversi_tanggal($tanggal_organisasi[$i]);
          $publikasi->nama_organisasi = $nama_organisasi[$i];
          $publikasi->tempat = $tempat_organisasi[$i];
          $publikasi->aktif_sebagai = $aktif_sebagai[$i];
          $publikasi->lingkup_kegiatan = $lingkup_organisasi[$i];
          $publikasi->referensi = $referensi_organisasi[$i];
          $publikasi->user_id = $user->id;
          $publikasi->role_id = $user->role_id;

          if($publikasi->tanggal != ''){
            $publikasi->save();
          }
        }

        //-------------Tenaga Pengajar---------
        $del_pengajar = TenagaPengajar::where('user_id',$user->id)->delete();

        $mulai_pengajar = \Input::get('mulai_pengajar');
        $materi = \Input::get('materi');
        $institusi = \Input::get('institusi');
        $tempat_pengajar = \Input::get('tempat_pengajar');
        $aktif_sebagai_pengajar = \Input::get('aktif_sebagai_pengajar');
        $lingkup_pengajar = \Input::get('lingkup_pengajar');
        $referensi_pengajar = \Input::get('referensi_pengajar');

        for ($i=0; $i < sizeof($mulai_pengajar) ; $i++) { 
          $pengajar = new TenagaPengajar;
          $pengajar->nip = $data['nip'];
          $pengajar->tanggal_mulai = konversi_tanggal($mulai_pengajar[$i]);
          $pengajar->materi = $materi[$i];
          $pengajar->institusi = $institusi[$i];
          $pengajar->tempat = $tempat_pengajar[$i];
          $pengajar->aktif_sebagai = $aktif_sebagai_pengajar[$i];
          $pengajar->lingkup_kegiatan = $lingkup_pengajar[$i];
          $pengajar->referensi = $referensi_pengajar[$i];
          $pengajar->user_id = $user->id;
          $pengajar->role_id = $user->role_id;

          if($pengajar->tanggal != ''){
            $pengajar->save();
          }
        }

        //-------------Penghargaan---------
        $del_penghargaan = Penghargaan::where('user_id',$user->id)->delete();

        $tanggal_penghargaan = \Input::get('tanggal_penghargaan');
        $nama_penghargaan = \Input::get('nama_penghargaan');
        $tempat_penghargaan = \Input::get('tempat_penghargaan');
        $jenis_penghargaan = \Input::get('jenis_penghargaan');
        $lingkup_penghargaan = \Input::get('lingkup_penghargaan');
        $referensi_penghargaan = \Input::get('referensi_penghargaan');

        for ($i=0; $i < sizeof($tanggal_penghargaan) ; $i++) { 
          $penghargaan = new Penghargaan;
          $penghargaan->nip = $data['nip'];
          $penghargaan->tanggal_mulai = konversi_tanggal($tanggal_penghargaan[$i]);
          $penghargaan->nama_penghargaan = $nama_penghargaan[$i];
          $penghargaan->tempat = $tempat_penghargaan[$i];
          $penghargaan->jenis_penghargaan = $jenis_penghargaan[$i];
          $penghargaan->lingkup_kegiatan = $lingkup_penghargaan[$i];
          $penghargaan->referensi = $referensi_penghargaan[$i];
          $penghargaan->user_id = $user->id;
          $penghargaan->role_id = $user->role_id;

          if($penghargaan->tanggal != ''){
            $penghargaan->save();
          }
        }


        return redirect('/admin/pegawai');
    }

    public function getUnduhCV($id)
    {
      $pegawai = Pegawai::find($id);
      $pegawai->bank = BankAsuransi::where('user_id',$pegawai->user_id)->first();
      $pegawai->pendidikan = Pendidikan::where('user_id',$pegawai->user_id)->get();
      $pegawai->sertifikat = Sertifikat::where('user_id',$pegawai->user_id)->get();
      $pegawai->pelatihan = PelatihanCV::where('user_id',$pegawai->user_id)->get();
      $pegawai->pengalaman = Pengalaman::where('user_id',$pegawai->user_id)->get();
      $pegawai->penugasan = Penugasan::where('user_id',$pegawai->user_id)->get();
      $pegawai->karya_presentasi = KaryaIlmiah::where('publikasi','presentasi')->where('user_id',$pegawai->user_id)->get();
      $pegawai->karya_nopresentasi = KaryaIlmiah::where('publikasi','nopresentasi')->where('user_id',$pegawai->user_id)->get();
      $pegawai->karya_nopublikasi = KaryaIlmiah::where('publikasi','nopublikasi')->where('user_id',$pegawai->user_id)->get();
      $pegawai->pertemuan = Pertemuan::where('user_id',$pegawai->user_id)->get();
      $pegawai->organisasi = Organisasi::where('user_id',$pegawai->user_id)->get();
      $pegawai->publikasi = Publikasi::where('user_id',$pegawai->user_id)->get();
      $pegawai->pengajar = TenagaPengajar::where('user_id',$pegawai->user_id)->get();
      $pegawai->penghargaan = Penghargaan::where('user_id',$pegawai->user_id)->get();

      $pdf = PDF::loadView('admin.pegawai.unduh_cv',['pegawai' => $pegawai]);
      $pdf->setPaper('A4','landscape');
      return $pdf->download('CV_'.$pegawai->nip.'.pdf');
    }

    public function getUnduhMCU($id)
    {
      $pegawai = Pegawai::find($id);
      $mcus = MCUPegawai::where('nip',$pegawai->nip)->get();
      $pdf = PDF::loadView('admin.pegawai.unduh_mcu',['pegawai' => $pegawai,'mcus'=>$mcus]);
      $pdf->setPaper('A4');
      return $pdf->download('MCU_'.$pegawai->nip.'.pdf');
    }

    public function getUnduhPKWT($id)
    {
      $pegawai = Pegawai::find($id);
      $pkwt = Pkwt::where('nip',$pegawai->nip)->latest()->first();
      $pegawai->data_pkwt = $pkwt;
      $pdf = PDF::loadView('admin.pegawai.unduh_pkwt',['pegawai' => $pegawai]);
      $pdf->setPaper('A4');
      return $pdf->download('PKWT_'.$pegawai->nip.'.pdf');
    }

    public function getApprove($id)
    {
        $pegawai = Pegawai::find($id);
        $bank= BankAsuransi::where('user_id',$pegawai->user_id)->first();
        $kode = KodeBagian::all();
        $mcus = MCU::where('soft_delete','0')->get();
        $data_mcus = MCUPegawai::where('user_id',$pegawai->user_id)->where('soft_delete','0')->get();
        $gaji= Gaji::where('user_id',$pegawai->user_id)->first();

        $pendidikan = Pendidikan::where('user_id',$pegawai->user_id)->get();
        $pendidikans = json_decode(json_encode($pendidikan), true);

        $sertifikat = Sertifikat::where('user_id',$pegawai->user_id)->get();
        $sertifikats = json_decode(json_encode($sertifikat), true);

        $pelatihan = PelatihanCV::where('user_id',$pegawai->user_id)->get();
        $pelatihans = json_decode(json_encode($pelatihan), true);

        $pengalaman = Pengalaman::where('user_id',$pegawai->user_id)->get();
        $pengalamans = json_decode(json_encode($pengalaman), true);

        $penugasan = Penugasan::where('user_id',$pegawai->user_id)->get();
        $penugasans = json_decode(json_encode($penugasan), true);

        $presentasi = KaryaIlmiah::where('user_id',$pegawai->user_id)->where('publikasi','presentasi')->get();
        $presentasis = json_decode(json_encode($presentasi), true);

        $nopresentasi = KaryaIlmiah::where('user_id',$pegawai->user_id)->where('publikasi','nopresentasi')->get();
        $nopresentasis = json_decode(json_encode($nopresentasi), true);

        $nopublikasi = KaryaIlmiah::where('user_id',$pegawai->user_id)->where('publikasi','nopublikasi')->get();
        $nopublikasis = json_decode(json_encode($nopublikasi), true);

        $pertemuan = Pertemuan::where('user_id',$pegawai->user_id)->get();
        $pertemuans = json_decode(json_encode($pertemuan), true);

        $organisasi = Organisasi::where('user_id',$pegawai->user_id)->get();
        $organisasis = json_decode(json_encode($organisasi), true);

        $publikasi = Publikasi::where('user_id',$pegawai->user_id)->get();
        $publikasis = json_decode(json_encode($publikasi), true);

        $pengajar = TenagaPengajar::where('user_id',$pegawai->user_id)->get();
        $pengajars = json_decode(json_encode($pengajar), true);

        $penghargaan = Penghargaan::where('user_id',$pegawai->user_id)->get();
        $penghargaans = json_decode(json_encode($penghargaan), true);

        return view('admin.pegawai.approve_admin',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus,'data_mcus'=>$data_mcus,'gaji'=>$gaji,'pendidikans'=>$pendidikans,'sertifikats'=>$sertifikats,'pelatihans'=>$pelatihans,'pengalamans'=>$pengalamans,'penugasans'=>$penugasans,'presentasis'=>$presentasis, 'nopresentasis'=>$nopresentasis,'nopublikasis'=>$nopublikasis,'pertemuans'=>$pertemuans,'organisasis'=>$organisasis,'publikasis'=>$publikasis,'pengajars'=>$pengajars,'penghargaans'=>$penghargaans ]);
    }

    public function postApprove($id)
    {
      $data = \Input::all();

      $user = User::where('pegawai_id',$data['nip'])->first();
       $pegawai['nama'] = $data['nama'];
       $pegawai['gelar_depan'] = $data['gelar_depan'];
       $pegawai['gelar_belakang'] = $data['gelar_belakang'];
       $pegawai['agama'] = $data['agama'];
       $pegawai['no_pkwt'] = $data['no_pkwt'];
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
       $pegawai['is_verif_admin'] = 1;
       $pegawai['verif_admin_by'] = \Auth::user()->id;
       $pegawai['verify_admin_time'] = date('Y-m-d H:i:s');
       //karena deo minta aktivasi sampe akun admin deo aja jd tak bikin verif pm langsung ke de verif pas admin verif
       $pegawai['is_active'] = 1;
       $pegawai['is_verif_pm'] = 1;
       $pegawai['verif_pm_by'] = \Auth::user()->id;
       $pegawai['verify_pm_time'] = date('Y-m-d H:i:s');

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

       $find_bank = BankAsuransi::where('user_id',$user->id)->first();
       if($find_bank){
        $update_bank = BankAsuransi::where('user_id',$user->id)->update($bank);
      }else{
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
         $bank->user_id = $user->id;
         $bank->role_id = $user->role_id;
       
        $bank->save();
      }

       $find_gaji = Gaji::where('user_id',$user->id)->first();

       if($find_gaji){
            $gaji['nip'] = $data['nip'];
           $gaji['gaji_pokok'] = $data['gaji_pokok'];
           $gaji['tunj_komunikasi'] = $data['tunj_komunikasi'];
           $gaji['tunj_transportasi'] = $data['tunj_transportasi'];
           $gaji['uang_makan'] = $data['uang_makan'];
           $gaji['uang_lembur'] = $data['uang_lembur'];
           $gaji['tunj_pph21'] = $data['tunj_pph21'];
           $gaji['ptkp'] = $data['ptkp'];
           $gaji['pph21'] = $data['pph21'];
           $gaji['user_id'] = $user->id;
           $gaji['role_id'] = $user->role_id;
            $update_gaji = Gaji::where('user_id',$user->id)->update($gaji);

        }else{
            $gaji = new Gaji;
            $gaji->nip = $data['nip'];
           $gaji->gaji_pokok = $data['gaji_pokok'];
           $gaji->tunj_komunikasi = $data['tunj_komunikasi'];
           $gaji->tunj_transportasi = $data['tunj_transportasi'];
           $gaji->uang_makan = $data['uang_makan'];
           $gaji->uang_lembur = $data['uang_lembur'];
           $gaji->tunj_pph21 = $data['tunj_pph21'];
           $gaji->ptkp = $data['ptkp'];
           $gaji->pph21 = $data['pph21'];
           $gaji->user_id = $user->id;
           $gaji->role_id = $user->role_id;

            $gaji->save();
        }

        //---------------PKWT-------------------
        $no_pkwt = \Input::get('no_pkwt');
        $find_pkwt = Pkwt::where('no_pkwt',$no_pkwt)->where('soft_delete',0)->first();
        if($find_pkwt && ($find_pkwt->no_pkwt == $no_pkwt)){
          $pkwt['nip'] = $data['nip'];
          $pkwt['posisi'] = \Input::get('posisi');
          $pkwt['jangka_waktu'] = \Input::get('jangka_waktu');
          $pkwt['tanggal_mulai'] = \Input::get('tanggal_mulai');
          $pkwt['tanggal_selesai'] = \Input::get('tanggal_selesai');
          $pkwt['created_at'] = date('Y-m-d H:i:s');
          $pkwt['user_id'] = $user->id;
          $pkwt['role_id'] = $user->role_id;


          $update_pkwt = Pkwt::where('no_pkwt',$no_pkwt)->update($pkwt);
        }else{
          $pkwt = new Pkwt;
          $pkwt->no_pkwt = $no_pkwt;
          $pkwt->nip = $data['nip'];
          $pkwt->posisi = \Input::get('posisi');
          $pkwt->jangka_waktu = \Input::get('jangka_waktu');
          $pkwt->tanggal_mulai = \Input::get('tanggal_mulai');
          $pkwt->tanggal_selesai = \Input::get('tanggal_selesai');
          $pkwt->created_at = date('Y-m-d H:i:s');
          $pkwt->user_id = $user->id;
          $pkwt->role_id = $user->role_id;


          $pkwt->save();
        }


        return redirect('/admin/pegawai');
    }

    public function getReject($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $pegawai = Pegawai::find($id);
        if($pegawai){
            $data['is_verif_admin'] = '-1';
            $data['verif_admin_by'] = \Auth::user()->id;
            $data['verify_admin_time'] = date('Y-m-d H:i:s');
            $data['is_active'] = '';
            $data['is_new'] = 1;

            $query = Pegawai::where('id',$id)->update($data);
        }
  
        return redirect('/admin/pegawai');
    }

    public function getEditRole($id)
    {
        $pegawai = Pegawai::find($id);
        if($pegawai){
            $roles= Roles::get();
            $kode = KodeBagian::all();
          $posisi = Posisi::where('soft_delete',0)->get();
            return view('admin.pegawai.edit_role',['pegawai'=>$pegawai,'roles'=>$roles,'kode'=>$kode,'posisi'=>$posisi]);
        }
    }

    public function postEditRole($id)
    {
        $pegawai = Pegawai::find($id);
        $user = User::where('pegawai_id',$pegawai->nip)->first();
        if($pegawai && $user){
          $data= \Input::all();

          $dates = explode('-', $pegawai->tanggal_lahir);

          $kode_bagian = $data['kode_bagian'];
          $role = \Input::get('role');
          
          $tahun = str_split($dates[0],2);
          //kalau role ganti jadi manager
          if($kode_bagian != 'PM'){
            if(($data['role'] == 3) || ($data['role'] == 4)){
              $nip = $kode_bagian.'M'.$dates[2].$dates[1].$tahun[1];
              $dt_user['pegawai_id'] = $nip;
              $dt_pegawai['nip'] = $nip;

              //duplicate data yg lama dengan nip yg baru
              $dt_new = $pegawai->replicate();
              $dt_new->nip = $dt_pegawai['nip'];
              $dt_new->kode_bagian = $data['kode_bagian'];
              $dt_new->posisi_id = $data['posisi_id'];
              $dt_new->user_id = $user->id;
              $dt_new->save();

              $dt_pegawai_update['is_new'] = 0;
              $dt_pegawai_update['is_active'] = null;
              $dt_pegawai_update['soft_delete'] = 1;
              $dt_pegawai_update['tanggal_keluar'] = date('Y-m-d H:i:s');
               // $query_pegawai = Pegawai::where('nip',$pegawai->nip)->update($dt_pegawai);
              \File::copyDirectory('upload/pegawai/'.$pegawai->nip, 'upload/pegawai/'.$dt_pegawai['nip']);

            }else{
            //kalau role staff biasa
              // $nip = $kode_bagian.$dates[2].$dates[1].$tahun[1];
              // $dt_user['pegawai_id'] = $nip;
              // $dt_pegawai['nip'] = $nip;

              // $dt_new = $pegawai->replicate();
              // $dt_new->nip = $dt_pegawai['nip'];
              // $dt_new->kode_bagian = $data['kode_bagian'];
              // $dt_new->posisi_id = $data['posisi_id'];  
              // $dt_new->user_id = $user->id;
              // $dt_new->role_id = $data['role'];
              // $dt_new->save();
            $dt_pegawai_update['kode_bagian'] = $kode_bagian;
            $dt_pegawai_update['posisi_id'] = $data['posisi_id'];

          }
        }
        //kalau role ganti jadi PM
        elseif ($kode_bagian == 'PM') {
             $nip = 'PM'.$dates[2].$dates[1].$tahun[1];
              $dt_user['pegawai_id'] = $nip;
              $dt_pegawai['nip'] = $nip;

              //duplicate data yg lama dengan nip yg baru
              $dt_new = $pegawai->replicate();
              $dt_new->nip = $dt_pegawai['nip'];
              $dt_new->kode_bagian = $data['kode_bagian'];
              $dt_new->posisi_id = $data['posisi_id'];  
              $dt_new->user_id = $user->id;
              $dt_new->role_id = $data['role'];
              $dt_new->save();

              $dt_pegawai_update['is_new'] = 0;
              $dt_pegawai_update['is_active'] = null;
              $dt_pegawai_update['soft_delete'] = 1;
              $dt_pegawai_update['tanggal_keluar'] = date('Y-m-d H:i:s');

            \File::copyDirectory('upload/pegawai/'.$pegawai->nip, 'upload/pegawai/'.$dt_pegawai['nip']);
        }
          
          //update data yg lama
           $query_pegawai = Pegawai::where('nip',$pegawai->nip)->update($dt_pegawai_update);

            $dt_user['role_id'] = $data['role'];
            $query_user = User::where('pegawai_id',$pegawai->nip)->update($dt_user);
           
            if($query_pegawai && $query_user){
              //change menu dan permission
              //hapus permission lama
              $del_permission = Permission::where('id_user',$user->id)->delete();
              // set permission baru
              $menus = Menu::where('default_role',$data['role'])->where('active',1)->get();
              foreach ($menus as $key => $menu) {
                $insert = new Permission;
                $insert->id_menu = $menu->id;
                $insert->id_user = $user->id;
                if(!($insert->save())){
                  break;
                }
              }
              return redirect('admin/pegawai');
            }
          
        }
    }

    public function getUpdatePkwt($id)
    {
      $pegawai = Pegawai::find($id);

        $find_pkwt = Pkwt::where('nip',$pegawai->nip)->where('soft_delete',0)->latest()->first();
        return view('admin.pegawai.update_pkwt',['pkwt'=>$find_pkwt,'pegawai'=>$pegawai]);
    }

    public function postUpdatePkwt($id)
    {
      $pegawai = Pegawai::find($id);
        $user = User::where('pegawai_id',$pegawai->nip)->first();
        $no_pkwt = \Input::get('no_pkwt');
        $find_pkwt = Pkwt::where('no_pkwt',$no_pkwt)->where('soft_delete',0)->first();
        if($find_pkwt && ($find_pkwt->no_pkwt == $no_pkwt)){
          $pkwt['nip'] = $pegawai->nip;
          $pkwt['posisi'] = \Input::get('posisi');
          $pkwt['jangka_waktu'] = \Input::get('jangka_waktu');
          $pkwt['tanggal_mulai'] = \Input::get('tanggal_mulai');
          $pkwt['tanggal_selesai'] = \Input::get('tanggal_selesai');
          $pkwt['created_at'] = date('Y-m-d H:i:s');
          $pkwt['user_id'] = $user->id;
          $pkwt['role_id'] = $user->role_id;


          $update_pkwt = Pkwt::where('no_pkwt',$no_pkwt)->update($pkwt);
        }else{
          $pkwt = new Pkwt;
          $pkwt->no_pkwt = $no_pkwt;
          $pkwt->nip = $pegawai->nip;
          $pkwt->posisi = \Input::get('posisi');
          $pkwt->jangka_waktu = \Input::get('jangka_waktu');
          $pkwt->tanggal_mulai = \Input::get('tanggal_mulai');
          $pkwt->tanggal_selesai = \Input::get('tanggal_selesai');
          $pkwt->created_at = date('Y-m-d H:i:s');
          $pkwt->user_id = $user->id;
          $pkwt->role_id = $user->role_id;


          $pkwt->save();
        }

        $update_pegawai = Pegawai::where('id',$id)->update(['no_pkwt'=>$no_pkwt]);

        return redirect('admin/pegawai');
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

      return view('admin.pegawai.pecat.index',['pecats'=>$pecats]);
    }

    public function getCreatePecat(){
      $pegawais = Pegawai::where('is_active','1')->where('soft_delete',0)->get();
      
      return view('admin.pegawai.pecat.create',['pegawais'=>$pegawais]);
      
    }

    public function postCreatePecat(){
      $data = \Input::all();
      
      $user = User::where('pegawai_id',$data['nip'])->first();
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
      $pecat->user_id = $user->id;
      $pecat->role_id = $user->role_id;

      $pecat->save();

      $update = Pegawai::where('nip',$data['nip'])->update(['tanggal_keluar'=>$data['terakhir_kerja']]);

      return redirect('/admin/pegawai/pecat');
      
    }

    public function getDeletePecat(){
      $data = \Input::all();
      $del = Pecat::where('id',$data['id_pecat'])->delete();

      if($del){
        return redirect('admin/pegawai/pecat');
      }

    }

    public function getUnduhSPK($id)
    {
      $pecat = Pecat::find($id);
      $pdf = PDF::loadView('admin.pegawai.pecat.spk',['pecat' => $pecat]);
      $pdf->setPaper('A4');
      return $pdf->download('SPK_'.$pecat->nip.'.pdf');
    }

    public function getResign()
    {
      $resigns = Resign::get();

      return view('admin.pegawai.resign.index',['resigns'=>$resigns]);
    }

    public function getProd05()
    {
      $pegawais = Pegawai::where('soft_delete',0)->where('is_active',1)->get();

      return view('admin.pegawai.prod05.index',['pegawais'=>$pegawais]);
    }

    public function getProd05Unduh()
    {
            $periode = date('F Y');
            $pegawais = Pegawai::where('status_pegawai','PT')
                                  ->where('soft_delete',0)
                                  ->where('is_active',1)
                                  ->orwhere('status_pegawai','PTT')
                                  ->where('soft_delete',0)
                                  ->where('is_active',1)
                                  ->orwhere('status_pegawai','OJT')
                                  ->where('soft_delete',0)
                                  ->where('is_active',1)
                                  ->get();
            $oss = Pegawai::where('status_pegawai','OS')
                                  ->where('soft_delete',0)
                                  ->where('is_active',1)
                                  ->get();
            $harians = Pegawai::where('status_pegawai','harian')
                                  ->where('soft_delete',0)
                                  ->where('is_active',1)
                                  ->get();

            $gajis = Pegawai::where('soft_delete',0)->where('is_active',1)->get();
            $total = 0;

            foreach ($gajis as $key => $gaji) {
              $total = $total + $gaji->gaji->gaji_pokok;
            }
            $excel = \Excel::create('Prod05_'.$periode, function($excel) use ($pegawais,$oss,$harians,$total,$periode) {

                    $excel->sheet('New sheet', function($sheet) use ($pegawais,$oss,$harians,$total,$periode) {

                        $sheet->loadView('admin.pegawai.prod05.unduh',['pegawais' => $pegawais,'oss'=>$oss,'harians'=>$harians,'total'=>$total,'periode'=>$periode]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/Waskita.png'));
                        $objDrawing->setCoordinates('C1');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(40);
                        $objDrawing->setHeight(35);
                        $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                        $sheet->getStyle('A13:P14')->getAlignment()->setWrapText(true);
                        $sheet->getStyle('A13:P14')->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                        );
                        $sheet->cells('A10:P10', function ($cells) {
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                            $cells->setFontSize('14');
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cells('A13:P14', function ($cells) {
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                            $cells->setFontSize('10');
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cells('A15:P15', function ($cells) {
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                            $cells->setFontSize('8');
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cell('B13:E13', function($cell){
                            $cell->setBorder('','thin','','');
                        });
                        // $sheet->cell('B14:E14', function($cell){
                        //     $cell->setBorder('','','','thin');
                        // });
                    });
                });
                return $excel->export('xls');
    }

    public function getPelatihan()
    {
      $pelatihans = Pelatihan::where('soft_delete',0)->get();

      return view('admin.pegawai.pelatihan.index',['pelatihans'=>$pelatihans]);
    }

    public function getCreatePelatihan()
    {
      $pegawais = Pegawai::where('is_active','1')->where('soft_delete',0)->get();
      
      return view('admin.pegawai.pelatihan.create',['pegawais'=>$pegawais]);
    }

    public function postCreatePelatihan(){
      $data = \Input::all();

      $user = User::where('pegawai_id',$data['nip'])->first();
      
      $pelatihan = new Pelatihan;
      $pelatihan->nip = $data['nip'];
      $pelatihan->nama_pelatihan = $data['nama_pelatihan'];
      $tanggal_mulai = explode('-',$data['tanggal_mulai']);
      $data['tanggal_mulai'] = $tanggal_mulai[2].'-'.$tanggal_mulai[1].'-'.$tanggal_mulai[0];
      $pelatihan->tanggal_mulai =$data['tanggal_mulai'];
      $tanggal_selesai = explode('-',$data['tanggal_selesai']);
      $data['tanggal_selesai'] = $tanggal_selesai[2].'-'.$tanggal_selesai[1].'-'.$tanggal_selesai[0];
      $pelatihan->tanggal_selesai =$data['tanggal_selesai'];
      $pelatihan->tempat =$data['tempat'];
      $pelatihan->penyelenggara =$data['penyelenggara'];
      $pelatihan->no_im =$data['no_im'];
     
      $pelatihan->user_id = $user->id;
      $pelatihan->role_id = $user->role_id;

      $pelatihan->save();

      return redirect('/admin/pegawai/pelatihan');
      
    }

    public function getEditPelatihan($id)
    {
      $pegawais = Pegawai::where('is_active','1')->where('soft_delete',0)->get();
      $pelatihan = Pelatihan::find($id);
      
      return view('admin.pegawai.pelatihan.edit',['pegawais'=>$pegawais,'pelatihan'=>$pelatihan]);
    }

    public function postEditPelatihan($id){
      $data = \Input::all();
      $user = User::where('pegawai_id',$data['nip'])->first();

      $data['user_id'] = $user->id;
      $data['role_id'] = $user->role_id;
      unset($data['_token']);
      $update = Pelatihan::where('id',$id)->update($data);

      return redirect('/admin/pegawai/pelatihan');
      
    }

    public function getDeletePelatihan($id)
    {
      $update = Pelatihan::where('id',$id)->update(['soft_delete'=>1]);
      
      return redirect('/admin/pegawai/pelatihan');
    }

    public function postUnduhPelatihan()
    {
      $tahun = \Input::get('tahun');

      if($tahun == 'all'){
        $tahuns = Pelatihan::select(\DB::raw('YEAR(tanggal_mulai) year'))->where('soft_delete',0)->groupby('year')->get();
        foreach ($tahuns as $key => $value) {
          $pelatihans[$value->year] = Pelatihan::where('soft_delete',0)->whereYear('tanggal_mulai',$value->year)->get();
          
        }
        

        $excel = \Excel::create('Monitoring Pelatihan_'.$tahun, function($excel) use ($tahuns,$pelatihans,$tahun) {
                  foreach ($tahuns as $key => $value) {
                    $data = $pelatihans[$value->year];
                    $nama_sheet = $value->year;
                    $excel->sheet('Tahun '.$nama_sheet, function($sheet) use ($data,$tahun,$nama_sheet) {

                        $sheet->loadView('admin.pegawai.pelatihan.unduh',['data' => $data,'nama_sheet'=>$nama_sheet]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/Waskita.png'));
                        $objDrawing->setCoordinates('A1');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(60);
                        $objDrawing->setHeight(50);
                        
                        $sheet->cell('B6', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('B8', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('A10', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('B9', function($cell){
                            $cell->setBorder('','','medium','');
                        });
                        $sheet->cell('C9', function($cell){
                            $cell->setBorder('','','medium','');
                        });
                        $sheet->cell('D9', function($cell){
                            $cell->setBorder('','','medium','');
                        });
                        $sheet->cell('E9', function($cell){
                            $cell->setBorder('','','medium','');
                        });
                        $sheet->cell('B12', function($cell){
                            $cell->setBorder('medium','','','');
                        });
                        $sheet->cell('C12', function($cell){
                            $cell->setBorder('medium','','','');
                        });
                        $sheet->cell('D12', function($cell){
                            $cell->setBorder('medium','','','');
                        });
                        $sheet->cell('E12', function($cell){
                            $cell->setBorder('medium','','','');
                        });
                        $sheet->cell('F10', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('G10', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('H10', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('I10', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('J10', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('K10', function($cell){
                            $cell->setBorder('medium','medium','medium','medium');
                        });
                        $sheet->cell('A12:K12', function($cell){
                            $cell->setBorder('double','','','');
                        });
                        $sheet->cell('K11', function($cell){
                            $cell->setBorder('','','','medium');
                        });

                          
                    });
                  }
                });

                $excel->getActiveSheet()
                    ->getPageSetup()
                    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
                $excel->getActiveSheet()
                    ->getPageSetup()
                    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

                $excel->getActiveSheet()
                    ->getPageMargins()->setTop(0.75);
                $excel->getActiveSheet()
                    ->getPageMargins()->setRight(0.5);
                $excel->getActiveSheet()
                    ->getPageMargins()->setLeft(0.5);
                $excel->getActiveSheet()
                    ->getPageMargins()->setBottom(0.5);
      }else{
        $pelatihans = Pelatihan::whereYear('tanggal_mulai',$tahun)->where('soft_delete',0)->get();
        $excel = \Excel::create('Monitoring Pelatihan_'.$tahun, function($excel) use ($pelatihans,$tahun) {

                    $excel->sheet('New sheet', function($sheet) use ($pelatihans,$tahun) {
                        $nama_sheet = $tahun;
                        $sheet->loadView('admin.pegawai.pelatihan.unduh',['data' => $pelatihans,'nama_sheet'=>$nama_sheet]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/Waskita.png'));
                        $objDrawing->setCoordinates('A1');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(3);
                        $objDrawing->setHeight(50);
                      
                        $sheet->cell('B6', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        $sheet->cell('B8', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });

                        $sheet->cell('A10:K11', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        
                    });
                });
      }


      
      return $excel->export('xls');
    }
}
