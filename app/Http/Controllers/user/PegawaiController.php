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
use App\PelatihanCV;
use App\Pengalaman;
use App\Posisi;
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
        $pegawai = Pegawai::where('is_active','!=',0)->where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->first();
        $bank = BankAsuransi::where('nip',\Auth::user()->pegawai_id)->first();

        $pendidikan = Pendidikan::where('nip',$pegawai->nip)->get();
        $pendidikans = json_decode(json_encode($pendidikan), true);

        $sertifikat = Sertifikat::where('nip',$pegawai->nip)->get();
        $sertifikats = json_decode(json_encode($sertifikat), true);

        $pelatihan = PelatihanCV::where('nip',$pegawai->nip)->get();
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
        return view('user.pegawai.index',['pegawai'=>$pegawai,'bank'=>$bank,'pendidikans'=>$pendidikans,'sertifikats'=>$sertifikats,'pelatihans'=>$pelatihans,'pengalamans'=>$pengalamans,'penugasans'=>$penugasans,'presentasis'=>$presentasis, 'nopresentasis'=>$nopresentasis,'nopublikasis'=>$nopublikasis,'pertemuans'=>$pertemuans,'organisasis'=>$organisasis,'publikasis'=>$publikasis,'pengajars'=>$pengajars,'penghargaans'=>$penghargaans]);
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

        $pelatihan = PelatihanCV::where('nip',$pegawai->nip)->get();
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
       $db = Pegawai::where('nip',$nip)->first();

       $pegawai['nama'] = $data['nama'];
       $pegawai['no_ktp'] = $data['no_ktp'];
       $pegawai['no_pkwt'] = tigadigit($db->id).'/PKWT/WK/INF2/BSTR-3/'.date('Y');
       if(array_key_exists('gender', $data)){
            $pegawai['gender'] = $data['gender'];
       }
       
       $pegawai['gelar_depan'] = $data['gelar_depan'];
       $pegawai['gelar_belakang'] = $data['gelar_belakang'];
       $pegawai['agama'] = $data['agama'];
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
       if(\Input::hasfile('paraf')){
          $ori_file  = \Request::file('paraf');
         $tujuan = "upload/pegawai/".$nip;
         $ekstension = $ori_file->getClientOriginalExtension();

          $nama_file = 'paraf.png';

        $ori_file->move($tujuan,$nama_file);
       }
       if(\Input::hasfile('ttd')){
         $ori_file  = \Request::file('ttd');
         $tujuan = "upload/pegawai/".$nip;
         $ekstension = $ori_file->getClientOriginalExtension();

          $nama_file = 'ttd.'.$ekstension;

        $ori_file->move($tujuan,$nama_file);
        $pegawai['ttd'] = $nama_file;
      }
      if(\Input::hasfile('foto')){
         $ori_file  = \Request::file('foto');
         $tujuan = "upload/pegawai/".$nip;
         $ekstension = $ori_file->getClientOriginalExtension();

          $nama_file = 'foto.'.$ekstension;

        $ori_file->move($tujuan,$nama_file);
        $pegawai['foto'] = $nama_file;
      }
      
       $pegawai['is_new'] = 0;
       $pegawai['is_active'] = '';
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
        $del_pelatihan = PelatihanCV::where('nip',$data['nip'])->delete();

        $pelatihan_tanggal = \Input::get('pelatihan_tanggal');
        $nama_pelatihan = \Input::get('nama_pelatihan');
        $tempat_pelatihan = \Input::get('tempat_pelatihan');
        $jam_hari = \Input::get('jam_hari');
        $penyelenggara_pelatihan = \Input::get('penyelenggara_pelatihan');

        for ($i=0; $i < sizeof($pelatihan_tanggal) ; $i++) { 
          $pelatihan = new PelatihanCV;
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
          $pengalaman->tanggal_mulai =$mulai_kerja[$i];
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

       $find_mcu = MCUPegawai::where('nip',$data['nip'])->delete();

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
        return view('user.pegawai.struktur.index',['level'=>$level,'posisi'=>$posisi]);
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

    public function getUnduhSPK($id)
    {
      $resign = Resign::find($id);
      $pdf = PDF::loadView('user.pegawai.resign.spk',['resign' => $resign]);
      $pdf->setPaper('A4');
      return $pdf->download('SPK_'.$resign->nip.'.pdf');
    }
}
