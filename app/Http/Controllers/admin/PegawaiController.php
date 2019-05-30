<?php

namespace App\Http\Controllers\admin;
use PDF;
use PHPExcel_Worksheet_Drawing;
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
use App\Penugasan;
use App\KaryaIlmiah;
use App\Pertemuan;
use App\Organisasi;
use App\Publikasi;
use App\TenagaPengajar;
use App\Penghargaan;
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
        return view('admin.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function indexNonAktif()
    {
       $pegawais= Pegawai::where('is_active',0)
                            ->where('soft_delete',0)
                          ->get();
        return view('admin.pegawai.index_non_aktif',['pegawais'=>$pegawais]);
    }

    public function getCreate()
    {
        $roles= Roles::get();
        $kode = KodeBagian::all();
        $posisi = Posisi::all();
        
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
        $data['status_pegawai'] = $status_pegawai;
        $data['is_active'] = '';
        $data['is_new'] = 1;
        $data['is_verif_admin'] = 0;
        $data['is_verif_mngr'] = 1;
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

        return view('admin.pegawai.edit_cv',['pegawai'=>$pegawai,'bank'=>$bank,'kode'=>$kode,'mcus'=>$mcus,'pendidikans'=>$pendidikans,'sertifikats'=>$sertifikats,'pelatihans'=>$pelatihans,'pengalamans'=>$pengalamans,'penugasans'=>$penugasans,'presentasis'=>$presentasis, 'nopresentasis'=>$nopresentasis,'nopublikasis'=>$nopublikasis,'pertemuans'=>$pertemuans,'organisasis'=>$organisasis,'publikasis'=>$publikasis,'pengajars'=>$pengajars,'penghargaans'=>$penghargaans]);
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

          if($pendidikan->jenjang != ''){
            $pendidikan->save();
          }
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

          if($sertifikat->sertifikat != ''){
            $sertifikat->save();
          }
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

          if($pelatihan->tanggal != ''){
            $pelatihan->save();
          }
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

          if($pengalaman->tanggal_mulai != ''){
            $pengalaman->save();
          }
        }

        //-------------Penugasan---------
        $del_penugasan= Penugasan::where('nip',$data['nip'])->delete();

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
          $penugasan->tanggal_mulai = $mulai_tugas[$i];
          $penugasan->tanggal_akhir = $akhir_tugas[$i];
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
          $penugasan->user_id = \Auth::user()->id;
          $penugasan->role_id = \Auth::user()->role_id;

          if($penugasan->tanggal_mulai != ''){
            $penugasan->save();
          }
        }

        //-------------Karya Ilmiah Presentasi---------
        $del_presentasi = KaryaIlmiah::where('nip',$data['nip'])->where('publikasi','presentasi')->delete();

        $tanggal_presentasi = \Input::get('tanggal_presentasi');
        $judul_presentasi = \Input::get('judul_presentasi');
        $tempat_presentasi = \Input::get('tempat_presentasi');
        $sifat_presentasi = \Input::get('sifat_presentasi');
        $lingkup_presentasi = \Input::get('lingkup_presentasi');
        $referensi_presentasi = \Input::get('referensi_presentasi');

        for ($i=0; $i < sizeof($tanggal_presentasi) ; $i++) { 
          $presentasi = new KaryaIlmiah;
          $presentasi->nip = $data['nip'];
          $presentasi->tanggal = $tanggal_presentasi[$i];
          $presentasi->publikasi = 'presentasi';
          $presentasi->judul = $judul_presentasi[$i];
          $presentasi->tempat = $tempat_presentasi[$i];
          $presentasi->sifat = $sifat_presentasi[$i];
          $presentasi->lingkup_kegiatan = $lingkup_presentasi[$i];
          $presentasi->referensi = $referensi_presentasi[$i];
          $presentasi->user_id = \Auth::user()->id;
          $presentasi->role_id = \Auth::user()->role_id;

          if($presentasi->tanggal != ''){
            $presentasi->save();
          }
        }

        //-------------Karya Ilmiah No Presentasi---------
        $del_nopresentasi = KaryaIlmiah::where('nip',$data['nip'])->where('publikasi','nopresentasi')->delete();

        $tanggal_nopresentasi = \Input::get('tanggal_nopresentasi');
        $judul_nopresentasi = \Input::get('judul_nopresentasi');
        $tempat_nopresentasi = \Input::get('tempat_nopresentasi');
        $sifat_nopresentasi = \Input::get('sifat_nopresentasi');
        $lingkup_nopresentasi = \Input::get('lingkup_nopresentasi');
        $referensi_nopresentasi = \Input::get('referensi_nopresentasi');

        for ($i=0; $i < sizeof($tanggal_nopresentasi) ; $i++) { 
          $nopresentasi = new KaryaIlmiah;
          $nopresentasi->nip = $data['nip'];
          $nopresentasi->tanggal = $tanggal_nopresentasi[$i];
          $nopresentasi->publikasi = 'nopresentasi';
          $nopresentasi->judul = $judul_nopresentasi[$i];
          $nopresentasi->tempat = $tempat_nopresentasi[$i];
          $nopresentasi->sifat = $sifat_nopresentasi[$i];
          $nopresentasi->lingkup_kegiatan = $lingkup_nopresentasi[$i];
          $nopresentasi->referensi = $referensi_nopresentasi[$i];
          $nopresentasi->user_id = \Auth::user()->id;
          $nopresentasi->role_id = \Auth::user()->role_id;

          if($nopresentasi->tanggal != ''){
            $nopresentasi->save();
          }
        }

        //-------------Karya Ilmiah No Publikasi---------
        $del_nopublikasi = KaryaIlmiah::where('nip',$data['nip'])->where('publikasi','nopublikasi')->delete();

        $tanggal_nopublikasi = \Input::get('tanggal_nopublikasi');
        $judul_nopublikasi = \Input::get('judul_nopublikasi');
        $tempat_nopublikasi = \Input::get('tempat_nopublikasi');
        $sifat_nopublikasi = \Input::get('sifat_nopublikasi');
        $lingkup_nopublikasi = \Input::get('lingkup_nopublikasi');
        $referensi_nopublikasi = \Input::get('referensi_nopublikasi');

        for ($i=0; $i < sizeof($tanggal_nopublikasi) ; $i++) { 
          $nopublikasi = new KaryaIlmiah;
          $nopublikasi->nip = $data['nip'];
          $nopublikasi->tanggal = $tanggal_nopublikasi[$i];
          $nopublikasi->publikasi = 'nopublikasi';
          $nopublikasi->judul = $judul_nopublikasi[$i];
          $nopublikasi->tempat = $tempat_nopublikasi[$i];
          $nopublikasi->sifat = $sifat_nopublikasi[$i];
          $nopublikasi->lingkup_kegiatan = $lingkup_nopublikasi[$i];
          $nopublikasi->referensi = $referensi_nopublikasi[$i];
          $nopublikasi->user_id = \Auth::user()->id;
          $nopublikasi->role_id = \Auth::user()->role_id;

          if($nopublikasi->tanggal != ''){
            $nopublikasi->save();
          }
        }

        //-------------Pertemuan---------
        $del_pertemuan = Pertemuan::where('nip',$data['nip'])->delete();

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
          $pertemuan->tanggal = $tanggal_pertemuan[$i];
          $pertemuan->tema = $tema[$i];
          $pertemuan->penyelenggara = $organisasi_penyelenggara[$i];
          $pertemuan->tempat = $tanggal_pertemuan[$i];
          $pertemuan->hadir_sebagai = $hadir_sebagai[$i];
          $pertemuan->lingkup_kegiatan = $lingkup_pertemuan[$i];
          $pertemuan->referensi = $referensi_pertemuan[$i];
          $pertemuan->user_id = \Auth::user()->id;
          $pertemuan->role_id = \Auth::user()->role_id;

          if($pertemuan->tanggal != ''){
            $pertemuan->save();
          }
        }

        //-------------Organisasi---------
        $del_organisasi = Organisasi::where('nip',$data['nip'])->delete();

        $tanggal_organisasi = \Input::get('tanggal_organisasi');
        $nama_organisasi = \Input::get('nama_organisasi');
        $tempat_organisasi = \Input::get('tempat_organisasi');
        $aktif_sebagai = \Input::get('aktif_sebagai');
        $lingkup_organisasi = \Input::get('lingkup_organisasi');
        $referensi_organisasi = \Input::get('referensi_organisasi');

        for ($i=0; $i < sizeof($tanggal_organisasi) ; $i++) { 
          $organisasi = new Organisasi;
          $organisasi->nip = $data['nip'];
          $organisasi->tanggal = $tanggal_organisasi[$i];
          $organisasi->nama_organisasi = $nama_organisasi[$i];
          $organisasi->tempat = $tempat_organisasi[$i];
          $organisasi->aktif_sebagai = $aktif_sebagai[$i];
          $organisasi->lingkup_kegiatan = $lingkup_organisasi[$i];
          $organisasi->referensi = $referensi_organisasi[$i];
          $organisasi->user_id = \Auth::user()->id;
          $organisasi->role_id = \Auth::user()->role_id;

          if($organisasi->tanggal != ''){
            $organisasi->save();
          }
        }

        //-------------Publikasi---------
        $del_publikasi = Publikasi::where('nip',$data['nip'])->delete();

        $tanggal_publikasi = \Input::get('tanggal_publikasi');
        $nama_publikasi = \Input::get('nama_publikasi');
        $tempat_publikasi = \Input::get('tempat_publikasi');
        $aktif_sebagai_publikasi = \Input::get('aktif_sebagai_publikasi');
        $lingkup_publikasi = \Input::get('lingkup_publikasi');
        $referensi_publikasi = \Input::get('referensi_publikasi');

        for ($i=0; $i < sizeof($tanggal_publikasi) ; $i++) { 
          $publikasi = new Publikasi;
          $publikasi->nip = $data['nip'];
          $publikasi->tanggal = $tanggal_organisasi[$i];
          $publikasi->nama_organisasi = $nama_organisasi[$i];
          $publikasi->tempat = $tempat_organisasi[$i];
          $publikasi->aktif_sebagai = $aktif_sebagai[$i];
          $publikasi->lingkup_kegiatan = $lingkup_organisasi[$i];
          $publikasi->referensi = $referensi_organisasi[$i];
          $publikasi->user_id = \Auth::user()->id;
          $publikasi->role_id = \Auth::user()->role_id;

          if($publikasi->tanggal != ''){
            $publikasi->save();
          }
        }

        //-------------Tenaga Pengajar---------
        $del_pengajar = TenagaPengajar::where('nip',$data['nip'])->delete();

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
          $pengajar->tanggal_mulai = $mulai_pengajar[$i];
          $pengajar->materi = $materi[$i];
          $pengajar->institusi = $institusi[$i];
          $pengajar->tempat = $tempat_pengajar[$i];
          $pengajar->aktif_sebagai = $aktif_sebagai_pengajar[$i];
          $pengajar->lingkup_kegiatan = $lingkup_pengajar[$i];
          $pengajar->referensi = $referensi_pengajar[$i];
          $pengajar->user_id = \Auth::user()->id;
          $pengajar->role_id = \Auth::user()->role_id;

          if($pengajar->tanggal != ''){
            $pengajar->save();
          }
        }

        //-------------Penghargaan---------
        $del_penghargaan = Penghargaan::where('nip',$data['nip'])->delete();

        $tanggal_penghargaan = \Input::get('tanggal_penghargaan');
        $nama_penghargaan = \Input::get('nama_penghargaan');
        $tempat_penghargaan = \Input::get('tempat_penghargaan');
        $jenis_penghargaan = \Input::get('jenis_penghargaan');
        $lingkup_penghargaan = \Input::get('lingkup_penghargaan');
        $referensi_penghargaan = \Input::get('referensi_penghargaan');

        for ($i=0; $i < sizeof($tanggal_penghargaan) ; $i++) { 
          $penghargaan = new Penghargaan;
          $penghargaan->nip = $data['nip'];
          $penghargaan->tanggal_mulai = $tanggal_penghargaan[$i];
          $penghargaan->nama_penghargaan = $nama_penghargaan[$i];
          $penghargaan->tempat = $tempat_penghargaan[$i];
          $penghargaan->jenis_penghargaan = $jenis_penghargaan[$i];
          $penghargaan->lingkup_kegiatan = $lingkup_penghargaan[$i];
          $penghargaan->referensi = $referensi_penghargaan[$i];
          $penghargaan->user_id = \Auth::user()->id;
          $penghargaan->role_id = \Auth::user()->role_id;

          if($penghargaan->tanggal != ''){
            $penghargaan->save();
          }
        }

        return redirect('/admin/pegawai');
    }

    public function getUnduhCV($id)
    {
      $pegawai = Pegawai::find($id);
      $pegawai->bank = BankAsuransi::where('nip',$pegawai->nip)->first();
      $pegawai->pendidikan = Pendidikan::where('nip',$pegawai->nip)->get();
      $pegawai->sertifikat = Sertifikat::where('nip',$pegawai->nip)->get();
      $pegawai->pelatihan = Pelatihan::where('nip',$pegawai->nip)->get();
      $pegawai->pengalaman = Pengalaman::where('nip',$pegawai->nip)->get();
      $pegawai->penugasan = Penugasan::where('nip',$pegawai->nip)->get();
      $pegawai->karya_presentasi = KaryaIlmiah::where('publikasi','presentasi')->where('nip',$pegawai->nip)->get();
      $pegawai->karya_nopresentasi = KaryaIlmiah::where('publikasi','nopresentasi')->where('nip',$pegawai->nip)->get();
      $pegawai->karya_nopublikasi = KaryaIlmiah::where('publikasi','nopublikasi')->where('nip',$pegawai->nip)->get();
      $pegawai->pertemuan = Pertemuan::where('nip',$pegawai->nip)->get();
      $pegawai->organisasi = Organisasi::where('nip',$pegawai->nip)->get();
      $pegawai->publikasi = Publikasi::where('nip',$pegawai->nip)->get();
      $pegawai->pengajar = TenagaPengajar::where('nip',$pegawai->nip)->get();
      $pegawai->penghargaan = Penghargaan::where('nip',$pegawai->nip)->get();

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
         $posisi[$value->level] = Posisi::where('level',$value->level)->where('soft_delete',0)->get();
      }

      $posisi = Posisi::where('level',0)->get();
        foreach ($posisi as $key => $value) {
          $value->anggota = Pegawai::where('posisi_id',$value->id)->where('soft_delete',0)->get();
          $value->anak = Posisi::where('parent',$value->id)->get();
          foreach ($value->anak as $key => $anak2) {
            $anak2->anggota = Pegawai::where('posisi_id',$anak2->id)->where('soft_delete',0)->get();
            $anak2->anak = Posisi::where('parent',$anak2->id)->get();
            foreach ($anak2->anak as $key => $anak3) {
              $anak3->anggota = Pegawai::where('posisi_id',$anak3->id)->where('soft_delete',0)->get();
              $anak3->anak = Posisi::where('parent',$anak3->id)->get();
              foreach ($anak3->anak as $key => $anak4) {
                $anak4->anggota = Pegawai::where('posisi_id',$anak4->id)->where('soft_delete',0)->get();
                $anak4->anak = Posisi::where('parent',$anak4->id)->get();
              }
            }
          }
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
}
