<style type="text/css">
  table tr td {
    min-height: 80px;
  }
  b {
    font-size: 12px;
  }
  p {
    font-size: 15px !important;
  }
  div{
    font-size: 12px;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  }
</style>

<img src="{{ asset("public/img/Waskita.png") }}" style="width: 60px; height: 40px; text-align: right;float: right;"/>
<div style="text-align: center;">
  <h3 style="font-family: 'Times New Roman';padding: 0;margin: 0;">CURRICULUM VITAE</h3>
</div>
<div style="text-align: left;">
  <p style="font-size: 14px;"><b>1. Data Pribadi</b></p>
  <table style="width: 100%;">
    <tr>
      <td>No. Induk Pegawai (NIP)</td>
      <td>:</td>
      <td>{{$pegawai->nip}}</td>
    </tr>
    <tr>
      <td>Nama Karyawan</td>
      <td>:</td>
      <td>{{$pegawai->nama}}</td>
      <td><img src="{{ asset("upload/pegawai/$pegawai->nip/$pegawai->foto") }}" style="width: 80px; height: 100px; text-align: right;float: right;"/></td>
    </tr>
    <tr>
      <td>Gelar Depan</td>
      <td>:</td>
      <td>{{$pegawai->gelar_depan}}</td>
    </tr>
    <tr>
      <td>Gelar Belakang</td>
      <td>:</td>
      <td>{{$pegawai->gelar_belakang}}</td>
    </tr>
    <tr>
      <td>Tempat & Tanggal Lahir</td>
      <td>:</td>
      <td>{{$pegawai->tempat_lahir}}, {{konversi_tanggal($pegawai->tanggal_lahir)}}</td>
    </tr>
    <tr>
      <td>Alamat Rumah Tetap</td>
      <td>:</td>
      <td>{{$pegawai->alamat_tetap}}</td>
    </tr>
    <tr>
      <td>Alamat Rumah Sementara</td>
      <td>:</td>
      <td>{{$pegawai->alamat_sementara}}</td>
    </tr>
    <tr>
      <td style="padding-left: 10px">No. Telepon</td>
      <td>:</td>
      <td>{{$pegawai->telp}}</td>
    </tr>
    <tr>
      <td style="padding-left: 10px">No. HP</td>
      <td>:</td>
      <td>{{$pegawai->hp}}</td>
    </tr>
    <tr>
      <td style="padding-left: 10px">No. Faximile</td>
      <td>:</td>
      <td>{{$pegawai->fax}}</td>
    </tr>
    <tr>
      <td>Alamat Email</td>
    </tr>
    <tr>
      <td style="padding-left: 10px">Kantor</td>
      <td>:</td>
      <td>{{$pegawai->email_kantor}}</td>
    </tr>
    <tr>
      <td style="padding-left: 10px">Pribadi</td>
      <td>:</td>
      <td>{{$pegawai->email}}</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      @if($pegawai->gender == 'P')
        <td>Pria</td>
      @elseif($pegawai->ggender == 'W')
        <td>Wanita</td>
      @endif
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td>{{$pegawai->agama}}</td>
    </tr>
    <tr>
      <td>Status Perkawinan</td>
      <td>:</td>
      @if($pegawai->status_kawin == 'K0')
        <td>Belum Kawin</td>
      @else
        <td>Kawin</td>
      @endif
    </tr>
    <tr>
      <td>Nama Istri / Suami</td>
      <td>:</td>
      <td>{{$pegawai->suami_istri}}</td>
      <td>Pekerjaan</td>
      <td>{{$pegawai->kerja_suami_istri}}</td>
    </tr>
    <tr>
      <td>Nama Anak</td>
      <td>:</td>
      <td>{{$pegawai->anak}}</td>
    </tr>
    <tr>
      <td style="padding-top: 20px;">Keluarga yang bisa dihubungi</td>
    </tr>
    <tr>
      <td style="padding-left: 10px;">Nama</td>
      <td>:</td>
      <td>{{$pegawai->nama_keluarga}}</td>
    </tr>
    <tr>
      <td style="padding-left: 10px;">Hubungan Keluarga</td>
      <td>:</td>
      <td>{{$pegawai->hub_keluarga}}</td>
    </tr>
    <tr>
      <td style="padding-left: 10px;">Alamat</td>
      <td>:</td>
      <td>{{$pegawai->alamat_keluarga}}</td>
    </tr>
    <tr>
      <td style="padding-left: 10px;">No. Telepon</td>
      <td>:</td>
      <td>{{$pegawai->telp_keluarga}}</td>
    </tr>
    <tr>
      <td>Tanggal Masuk</td>
      <td>:</td>
      <td>{{$pegawai->tanggal_masuk}}</td>
    </tr>
    <tr>
      <td>Tanggal Menjadi PT</td>
      <td>:</td>
      <td>{{$pegawai->tanggal_masuk_pt}}</td>
    </tr>
  </table>
  <p style="font-size: 14px;"><b>2.Data Bank & Asuransi</b></p>
  <table style="width: 100%;">
    <tr>
      <td>Nama Bank</td>
      <td>:</td>
      <td>{{$pegawai->bank->nama_bank}}</td>
    </tr>
    <tr>
      <td>No. Rekening</td>
      <td>:</td>
      <td>{{$pegawai->bank->no_rekening}}</td>
    </tr>
    <tr>
      <td>No. NPWP</td>
      <td>:</td>
      <td>{{$pegawai->bank->npwp}}</td>
    </tr>
    <tr>
      <td>No. Jamsostek</td>
      <td>:</td>
      <td>{{$pegawai->bank->jamsostek}}</td>
    </tr>
    <tr>
      <td>No. DPLK</td>
      <td>:</td>
      <td>{{$pegawai->bank->dplk}}</td>
    </tr>
    <tr>
      <td>No. Jiwasraya</td>
      <td>:</td>
      <td>{{$pegawai->bank->jiwasraya}}</td>
    </tr>
    <tr>
      <td>No. {{$pegawai->bank->asuransi_lain}}</td>
      <td>:</td>
      <td>{{$pegawai->bank->nomor_lain}}</td>
    </tr>
  </table>
  <p style="font-size: 14px;"><b>*) Coret yang tidak perlu</b></p>
  <p style="font-size: 14px;"><b>3. Pendidikan Formal</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>JENJANG</b></td>
      <td><b>ASAL SEKOLAH</b></td>
      <td><b>KOTA</b></td>
      <td><b>JURUSAN</b></td>
      <td><b>TANGGAL & TAHUN LULUS</b></td>
      <td><b>NO. IJAZAH</b></td>
      <td><b>CHECKLIST *</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->pendidikan as $pendidikan)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$pendidikan->jenjang}}</td>
        <td>{{$pendidikan->asal_sekolah}}</td>
        <td>{{$pendidikan->kota}}</td>
        <td>{{$pendidikan->jurusan}}</td>
        <td>{{$pendidikan->tahun_lulus}}</td>
        <td>{{$pendidikan->no_ijazah}}</td>
        <td></td>
      </tr>
    @endforeach
    @if($i < 5)
    <?php
      $selisih = 5 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height: 20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p style="font-size: 14px;"><b>4. Data Sertifikat (Keahlian/Keterampilan)</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL MULAI</b></td>
      <td><b>TANGGAL AKHIR</b></td>
      <td><b>SERTIFIKAT</b></td>
      <td><b>NO SERTIFIKAT</b></td>
      <td><b>INSTITUSI</b></td>
      <td><b>CHECKLIST *</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->sertifikat as $sertifikat)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$sertifikat->tanggal_mulai}}</td>
        <td>{{$sertifikat->tanggal_akhir}}</td>
        <td>{{$sertifikat->sertifkat}}</td>
        <td>{{$sertifikat->no_sertifikat}}</td>
        <td>{{$sertifikat->intitusi}}</td>
        <td></td>
      </tr>
    @endforeach
    @if($i < 7)
    <?php
      $selisih = 7 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p style="font-size: 14px;"><b>5. Data Pelatihan dan Pengembangan</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>NAMA PELATIHAN/PENGEMBANGAN</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>JUMLAH JAM / HARI</b></td>
      <td><b>PENYELENGGARA</b></td>
      <td><b>CHECKLIST *</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->pelatihan as $pelatihan)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$pelatihan->tanggal}}</td>
        <td>{{$pelatihan->nama_pelatihan}}</td>
        <td>{{$pelatihan->tempat}}</td>
        <td>{{$pelatihan->jam_hari}}</td>
        <td>{{$pelatihan->penyelenggara}}</td>
        <td></td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p style="font-size: 14px;"><b>6. Pengalaman kerja di Luar Waskita Raya</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL MULAI</b></td>
      <td><b>TANGGAL AKHIR</b></td>
      <td><b>NAMA ORGANISASI/PERUSAHAAN</b></td>
      <td><b>JABATAN</b></td>
      <td><b>KETERANGAN</b></td>
      <td><b>CHECKLIST *</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->pengalaman as $pengalaman)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$pengalaman->tanggal_mulai}}</td>
        <td>{{$pengalaman->tanggal_akhir}}</td>
        <td>{{$pengalaman->nama_perusahaan}}</td>
        <td>{{$pengalaman->jabatan}}</td>
        <td>{{$pengalaman->keterangan}}</td>
        <td></td>
      </tr>
    @endforeach
    @if($i < 5)
    <?php
      $selisih = 5 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p style="font-size: 14px;"><b>7. Penugasan Karyawan</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td rowspan="2"><b>NO</b></td>
      <td rowspan="2"><b>TANGGAL MULAI</b></td>
      <td rowspan="2"><b>TANGGAL AKHIR</b></td>
      <td rowspan="2"><b>NO SK</b></td>
      <td rowspan="2"><b>JABATAN</b></td>
      <td rowspan="2"><b>UNIT BISNIS / KERJA</b></td>
      <td rowspan="2"><b>KJ</b></td>
      <td rowspan="2"><b>KK</b></td>
      <td rowspan="2"><b>TEMPAT KERJA/PROYEK</b></td>
      <td colspan="2"><b>PRESTASI KERJA **</b></td>
      <td rowspan="2"><b>NAMA ATASAN LANGSUNG</b></td>
      <td rowspan="2"><b>JABATAN ATASAN</b></td>
      <td rowspan="2"><b>CHECKLIST *</b></td>
    </tr>
    <tr>
      <td><b> RENCANA</b></td>
      <td><b> REALISASI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->penugasan as $penugasan)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$penugasan->tanggal_mulai}}</td>
        <td>{{$penugasan->tanggal_akhir}}</td>
        <td>{{$penugasan->no_sk}}</td>
        <td>{{$penugasan->jabatan}}</td>
        <td>{{$penugasan->unit_kerja}}</td>
        <td>{{$penugasan->KJ}}</td>
        <td>{{$penugasan->KK}}</td>
        <td>{{$penugasan->tempat_kerja}}</td>
        <td>{{$penugasan->prestasi_rencana}}</td>
        <td>{{$penugasan->prestasi_realisasi}}</td>
        <td>{{$penugasan->nama_atasan}}</td>
        <td>{{$penugasan->jabatan_atasan}}</td>
        <td></td>
      </tr>
    @endforeach
    @if($i < 14)
    <?php
      $selisih = 14 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p><b> ** : - Untuk Kepala Proyek (Ex Kapro) diisi BK/PU<br>   - Untuk Kepala Cabang (Ex Kacab) diisi NKB
  <p style="font-size: 14px;"><b>8. Karya Ilmiah</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>JUDUL KARYA ILMIAH DIPRESENTASIKAN</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>SIFAT KARYA ILMIAH (GAGASAN, ULASAN, TINJAUAN) *)</b></td>
      <td><b>LINGKUP KEGIATAN (INTERNASIONAL, NASIONAL, LOKAL) *)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->karya_presentasi as $karya_presentasi)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$karya_presentasi->tanggal}}</td>
        <td>{{$karya_presentasi->judul}}</td>
        <td>{{$karya_presentasi->tempat}}</td>
        <td>{{$karya_presentasi->sifat}}</td>
        <td>{{$karya_presentasi->lingkup_kegiatan}}</td>
        <td>{{$karya_presentasi->referensi}}</td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <br><br>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>JUDUL KARYA ILMIAH TIDAK DIPRESENTASIKAN</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>SIFAT KARYA ILMIAH (GAGASAN, ULASAN, TINJAUAN) *)</b></td>
      <td><b>LINGKUP KEGIATAN (INTERNASIONAL, NASIONAL, LOKAL) *)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->karya_nopresentasi as $karya_nopresentasi)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$karya_nopresentasi->tanggal}}</td>
        <td>{{$karya_nopresentasi->judul}}</td>
        <td>{{$karya_nopresentasi->tempat}}</td>
        <td>{{$karya_nopresentasi->sifat}}</td>
        <td>{{$karya_nopresentasi->lingkup_kegiatan}}</td>
        <td>{{$karya_nopresentasi->referensi}}</td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <br><br>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>JUDUL KARYA ILMIAH DIPRESENTASIKAN</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>SIFAT KARYA ILMIAH (GAGASAN, ULASAN, TINJAUAN) *)</b></td>
      <td><b>LINGKUP KEGIATAN (INTERNASIONAL, NASIONAL, LOKAL) *)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->karya_nopublikasi as $karya_nopublikasi)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$karya_nopublikasi->tanggal}}</td>
        <td>{{$karya_nopublikasi->judul}}</td>
        <td>{{$karya_nopublikasi->tempat}}</td>
        <td>{{$karya_nopublikasi->sifat}}</td>
        <td>{{$karya_nopublikasi->lingkup_kegiatan}}</td>
        <td>{{$karya_nopublikasi->referensi}}</td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p style="font-size: 14px;"><b>9. Penunjang</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>TEMA PERTEMUAN</b></td>
      <td><b>ORGANISASI PENYELENGGARA</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>HADIR SEBAGAI (MODERATOR, PENYAJI, PESERTA, PANITIA)*)</b></td>
      <td><b>LINGKUP KEGIATAN(INTERNASIONAL, NASIONAL, LOKAL)*)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->pertemuan as $pertemuan)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$pertemuan->tanggal}}</td>
        <td>{{$pertemuan->tema}}</td>
        <td>{{$pertemuan->penyelenggara}}</td>
        <td>{{$pertemuan->tempat}}</td>
        <td>{{$pertemuan->hadir_sebagai}}</td>
        <td>{{$pertemuan->lingkup_kegiatan}}</td>
        <td>{{$pertemuan->referensi}}</td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <br><br><br>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>NAMA ORGANISASI</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>AKTIF SEBAGAI (KETUA UMUM, WAKIL KETUA, BENDAHARA, SEKRETARIS, PENGURUS PENDUKUNG, ANGGOTA)*)</b></td>
      <td><b>LINGKUP KEGIATAN(INTERNASIONAL, NASIONAL, LOKAL)*)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->organisasi as $organisasi)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$organisasi->tanggal}}</td>
        <td>{{$organisasi->nama_organisasi}}</td>
        <td>{{$organisasi->tempat}}</td>
        <td>{{$organisasi->aktif_sebagai}}</td>
        <td>{{$organisasi->lingkup_kegiatan}}</td>
        <td>{{$organisasi->referensi}}</td>
        <td></td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <br><br>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>NAMA PUBLIKASI / ORGANISASI</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>AKTIF SEBAGAI (EDITOR, READER, PENYUNTING PROSEDING)*)</b></td>
      <td><b>LINGKUP KEGIATAN(INTERNASIONAL, NASIONAL, LOKAL)*)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->publikasi as $publikasi)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$publikasi->tanggal}}</td>
        <td>{{$publikasi->nama_publikasi}}</td>
        <td>{{$publikasi->tempat}}</td>
        <td>{{$publikasi->aktif_sebagai}}</td>
        <td>{{$publikasi->lingkup_kegiatan}}</td>
        <td>{{$publikasi->referensi}}</td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p style="font-size: 14px;margin-bottom: 0px; padding-bottom: 0px;"><b>10. Tenaga Pengajar</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center; margin-top: 4px; padding-top: 0px;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL MULAI</b></td>
      <td><b>MATERI</b></td>
      <td><b>INSTITUSI</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>AKTIF SEBAGAI (PENGAJAR, PEMBIMBING, INSTRUKTUR)*)</b></td>
      <td><b>LINGKUP KEGIATAN(INTERNASIONAL, NASIONAL, LOKAL)*)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->pengajar as $pengajar)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$pengajar->tanggal_mulai}}</td>
        <td>{{$pengajar->materi}}</td>
        <td>{{$pengajar->institusi}}</td>
        <td>{{$pengajar->tempat}}</td>
        <td>{{$pengajar->aktif_sebagai}}</td>
        <td>{{$pengajar->lingkup_kegiatan}}</td>
        <td>{{$pegajar->referensi}}</td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <p style="margin-bottom: 0px; padding-bottom: 0px;"><b>11. Penghargaan</b></p>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: center; margin-top: 4px; padding-top: 0px;" cellspacing="1" cellpadding="3">
    <tr>
      <td><b>NO</b></td>
      <td><b>TANGGAL</b></td>
      <td><b>NAMA PENGHARGAAN</b></td>
      <td><b>TEMPAT</b></td>
      <td><b>JENIS PENGHARGAAN</b></td>
      <td><b>LINGKUP KEGIATAN(INTERNASIONAL, NASIONAL, LOKAL)*)</b></td>
      <td><b>REFERENSI</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($pegawai->penghargaan as $penghargaan)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$penghargaan->tanggal}}</td>
        <td>{{$penghargaan->nama_penghargaan}}</td>
        <td>{{$penghargaan->tempat}}</td>
        <td>{{$penghargaan->jenis_penghargaan}}</td>
        <td>{{$penghargaan->lingkup_kegiatan}}</td>
        <td>{{$penghargaan->referensi}}</td>
        <td></td>
      </tr>
    @endforeach
    @if($i < 4)
    <?php
      $selisih = 4 - $i;
      for ($i=0; $i < $selisih ; $i++) { 
        echo '<tr>';
        echo '<td style="height:20px;"></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
      }
    ?>
    @endif
  </table>
  <b>*) Coret yang tidak perlu</b><br>
  <div style="float: right;">
    <?php 
      $tanggal = explode(' ',$pegawai->created_at);
    ?>
    Tanggal: {{konversi_tanggal($tanggal[0])}}<br>
    Dibuat oleh :
    <br><br>
    <img src="{{asset('upload/pegawai/'.$pegawai->nip.'/'.$pegawai->ttd.'')}}" style="width: 220px; height: 60px;">
    ({{strtoupper($pegawai->nama)}})
  </div>
</div>
  
