<style type="text/css">
  table tr td {
    padding: 0px;
  }
</style>

<img src="{{ asset("public/img/Waskita.png") }}" style="width: 80px; height: 60px;"/>
<div style="text-align: center;">
  <h3 style="font-family: 'Times New Roman';padding: 0;margin: 0;">SURAT CUTI TAHUNAN / IZIN TIDAK MASUK KERJA/CUTI BESAR  *)
PEGAWAI KANTOR PUSAT</h3>
  <div style="border-top: 1px solid black;width: 240px; float: center; margin: 0 auto;padding: 0;"></div>
  <h4 style="font-family: 'Times New Roman';padding: 0;margin: 0;">Nomor  :      01/ WK/     /    /2019</h4>
  <br>
</div>
<div style="text-align: left;">
  <table cellpadding="0" cellspacing="3">
    <tr>
      <td style="width: 20px;">A.</td>
      <td style="width: 10px;">1.</td>
      <td style="width: 350px;">Nama</td>
      <td style="width: 10px;">:</td>
      <td>{{$cuti->pegawai->nama}}</td>
    </tr>
    <tr>
      <td></td>
      <td>2.</td>
      <td>Grade / C/ R</td>
      <td>:</td>
      <td>-</td>
    </tr>
    <tr>
      <td></td>
      <td>3.</td>
      <td>Jabatan / Tempat Tugas</td>
      <td>:</td>
      <?php
        if($cuti->pegawai->status_pegawai == 'PT'){
          $status = 'Pegawai Tetap';
        }elseif($cuti->pegawai->status_pegawai == 'PTT'){
          $status = 'Pegawai Tidak Tetap';
        }elseif($cuti->pegawai->status_pegawai == 'OS'){
          $status = 'Outsourcing';
        }elseif($cuti->pegawai->status_pegawai == 'Harian'){
          $status = 'Harian';
        }
      ?>
      <td>{{$status}} / Becakayu Seksi 2A Ujung</td>
    </tr>
    <tr>
      <td></td>
      <td>4.</td>
      <td>Maksud Cuti Izin</td>
      <td>:</td>
      <td>{{$cuti->alasan}}</td>
    </tr>
    <tr>
      <td></td>
      <td>5.</td>
      <td>Tujuan / Alamat selama menjalani cuti/izin</td>
      <td>:</td>
      <td>{{$cuti->alamat_cuti}}</td>
    </tr>
    <tr>
      <td></td>
      <td>6.</td>
      <td>Menjalani cuti / izin</td>
      <td>:</td>
      <td>{{konversi_tanggal($cuti->tanggal_mulai)}} s.d {{konversi_tanggal($cuti->tanggal_selesai)}}</td>
    </tr>
    <tr>
      <td></td>
      <td>7.</td>
      <td>Alat angkutan yang digunakan</td>
      <td>:</td>
      <td>{{$cuti->angkutan}}</td>
    </tr>
    <tr>
      <td></td>
      <td>8.</td>
      <td>Tanggal cuti / izin terakhir</td>
      <td>:</td>
      <td>{{konversi_tanggal($cuti->tanggal_mulai_terakhir)}} s.d {{konversi_tanggal($cuti->tanggal_selesai_terakhir)}}</td>
    </tr>
    <tr>
      <td style="height: 20px;"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <?php
        $created_at = explode(' ', $cuti->created_at);
      ?>
      <td style="text-align: center;">Bekasi, {{konversi_tanggal($created_at[0])}} </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <?php
        $created_at = explode(' ', $cuti->created_at);
      ?>
      <td style="text-align: center;">Pemohon, </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <td style="text-align: center;"><img src="{{asset('public/img/ttd.png')}}" style="width: 150px; height: 40px;"> </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <td style="text-align: center;">({{$cuti->pegawai->nama}}) </td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="2"></td>
      <td style="border-bottom: 1px solid black;"> </td>
    </tr>
    <tr>
      <td>B.</td>
      <td colspan="3">Keterangan tentang cuti / izin yang pernah dijalani :<br>{{konversi_tanggal($cuti->tanggal_mulai_terakhir)}} s.d {{konversi_tanggal($cuti->tanggal_selesai_terakhir)}}</td>
      <td style="text-align: center;">Kepala Bagian SDM</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;"><img src="{{asset('public/img/ttd.png')}}" style="width: 150px; height: 40px;"></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;">( Kepala Bagian SDM )</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="3"></td>
      <td style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
      <td>C.</td>
      <td colspan="4">Keterangan dari Kalap / Kasie SDM/ Kasie Teknik/ Kasie Adkon / Kasie Loglat / QC / K3LP * :</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;"><img src="{{asset('public/img/ttd.png')}}" style="width: 150px; height: 40px;"></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td ></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;">( Manager )</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="3"></td>
      <td style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
      <td>D.</td>
      <td colspan="4">Selama menjalani cuti / izin tanggal {{konversi_tanggal($cuti->tanggal_mulai)}}  s.d {{konversi_tanggal($cuti->tanggal_selesai)}}<br>pekerjaan rutin diserahkan kepada {{$cuti->pegawaiPengganti->nama}}</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;"><img src="{{asset('public/img/ttd.png')}}" style="width: 150px; height: 40px;"></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td ></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;">( {{$cuti->pegawaiPengganti->nama}} )</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="3"></td>
      <td style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
      <td>E.</td>
      <td colspan="3">Disetujui:<br>BERKEBERATAN / TIDAK BERKEBERATAN *)</td>
      <td style="text-align: center;"><b>Kepala Proyek</b></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;"><img src="{{asset('public/img/ttd.png')}}" style="width: 150px; height: 40px;"></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td ></td>
    </tr>
    <tr>
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="3"></td>
      <td style="border-bottom: 1px solid black; text-align: center;">( Waskito Adi )</td>
    </tr>
  </table>
</div>
  
