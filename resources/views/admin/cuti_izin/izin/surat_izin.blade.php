<style type="text/css">
  table tr td {
    padding: 0px;
  }
</style>

<img src="{{ asset("public/img/Waskita.png") }}" style="width: 80px; height: 60px;"/>
<div style="text-align: center;">
  <h3 style="font-family: 'Times New Roman';padding: 0;margin: 0;">SURAT IZIN TIDAK MASUK KERJA<br>
PEGAWAI PROYEK CIAWI SUKABUMI SEKSI 3</h3>
  <div style="border-top: 1px solid black;width: 480px; float: center; margin: 0 auto;padding: 0;"></div>
  <h4 style="font-family: 'Times New Roman';padding: 0;margin: 0;margin-left: 150px; text-align: left;">Nomor  :       </h4>
  <br>
</div>
<div style="text-align: left;">
  <table cellpadding="0" cellspacing="3">
    <tr>
      <td style="width: 20px;">A.</td>
      <td style="width: 10px;">1.</td>
      <td style="width: 350px;">Nama</td>
      <td style="width: 10px;">:</td>
      <td>{{$izin->pegawai->nama}}</td>
    </tr>
    <tr>
      <td></td>
      <td>2.</td>
      <td>Jabatan / Tempat Tugas</td>
      <td>:</td>
      <?php
        if($izin->pegawai->status_pegawai == 'PT'){
          $status = 'Pegawai Tetap';
        }elseif($izin->pegawai->status_pegawai == 'PTT'){
          $status = 'Pegawai Tidak Tetap';
        }elseif($izin->pegawai->status_pegawai == 'OS'){
          $status = 'Outsourcing';
        }elseif($izin->pegawai->status_pegawai == 'Harian'){
          $status = 'Harian';
        }
      ?>
      <td>{{$status}} / Ciawi Sukabumi Seksi 3</td>
    </tr>
    <tr>
      <td></td>
      <td>3.</td>
      <td>Maksud Izin</td>
      <td>:</td>
      <td>{{$izin->alasan}}</td>
    </tr>
     <tr>
      <td></td>
      <td>4.</td>
      <td>Menjalani  izin</td>
      <td>:</td>
      <td>{{konversi_tanggal($izin->tanggal_mulai)}} s.d {{konversi_tanggal($izin->tanggal_selesai)}}</td>
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
        $created_at = explode(' ', $izin->created_at);
      ?>
      <td style="text-align: center;">Bekasi, {{konversi_tanggal($created_at[0])}} </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <?php
        $created_at = explode(' ', $izin->created_at);
      ?>
      <td style="text-align: center;">Pemohon, </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <td style="text-align: center;"><img src='{{asset("upload/pegawai/$izin->nip/$izin->pegawai->ttd")}}' style="width: 150px; height: 40px;"> </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <td style="text-align: center;">({{$izin->pegawai->nama}}) </td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="2"></td>
      <td style="border-bottom: 1px solid black;"> </td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="3"></td>
      <td style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
      <td>B.</td>
      <td colspan="3">Catatan izin yang diajukan :</td>
      <td style="text-align: center;"><b>Atasan Langsung</b></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="4">BERKEBERATAN / TIDAK BERKEBERATAN )*</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      @if($izin->pegawai->kode_bagian == 'SA')
        <td style="text-align: center;"><img src='{{asset("upload/pegawai/$sdm->nip/$sdm->ttd")}}' style="width: 150px; height: 40px;"></td>
      @else
        <td style="text-align: center;"><img src='{{asset("upload/pegawai/$manager->nip/$manager->ttd")}}' style="width: 150px; height: 40px;"></td>
      @endif
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
      @if($izin->pegawai->kode_bagian == 'SA')
        <td style="text-align: center;">( {{$sdm->nama}} )</td>
      @else
        <td style="text-align: center;">( {{$manager->nama}} )</td>
      @endif
      
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="3"></td>
      <td style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
      <td>C.</td>
      <td colspan="3">Catatan izin yang diajukan :</td>
      <td style="text-align: center;"><b>SAM</b></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="4">BERKEBERATAN / TIDAK BERKEBERATAN )*</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;"><img src='{{asset("upload/pegawai/$sdm->nip/$sdm->ttd")}}' style="width: 150px; height: 40px;"></td>
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
      <td style="text-align: center;">( {{$sdm->nama}} )</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
      <td style="border-bottom: 1px solid black;"></td>
      <td style="border-bottom: 1px solid black;" colspan="3"></td>
      <td style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
      <td>D.</td>
      <td colspan="3">Disetujui:<br>BERKEBERATAN / TIDAK BERKEBERATAN *)</td>
      <td style="text-align: center;"><b>Project Manager</b></td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3"></td>
      <td style="text-align: center;"><img src='{{asset("upload/pegawai/$pm->nip/$pm->ttd")}}' style="width: 150px; height: 40px;"></td>
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
      <td style="border-bottom: 1px solid black; text-align: center;">( {{$pm->nama}} )</td>
    </tr>
  </table>
</div>
  
