<style type="text/css">
  h3, h4 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  }
  #data {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size: 14px;
    border-collapse: collapse;
    width: 100%;
    table-layout: fixed;
  }

  #data td, #data th {
    border: 1px solid black;
    text-align: center;
  }

  #data tbody .nama{
    width: 15%;
    table-layout: fixed;
    text-align: left;
  }

  #data tr .nomor{
    width: 3%;
    table-layout: fixed;
    text-align: left;
  }

  #data tr .barang{
    text-align: left;
  }

  #data tr:nth-child(even){background-color: #f2f2f2;}
  
  #data th {
    text-align: center;
    background-color: #4CAF50;
    color: white;
  }
</style>

<img src="{{ asset("public/img/kop.png") }}" style="width: 100%; height: 100px;"/>
<div style="text-align: center;">
  <h3 style="font-family: "Times New Roman";">Surat Pengalaman Kerja</h3>
</div>
<?php
  $pm = getPM('Resign',$resign->id);
?>
<div style="text-align: left;">
  <table>
    <tr>
      <td>Nomor</td>
      <td>:</td>
      <td>{{$resign->no_surat}}</td>
    </tr>
    <tr>
      <td>Lampiran</td>
      <td>:</td>
      <td>-</td>
    </tr>
    <tr>
      <td>Perihal</td>
      <td>:</td>
      <td>Surat Pengalaman Kerja</td>
    </tr>
  </table>
</div>
  
<br><br>
Dengan ini kami dari PT. Waskita Karya (Persero), Tbk Proyek Jalan Tol CIAWI SUKABUMI SEKSI 3 menyatakan bahwa: <br>

<table style="margin: 8px;">
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td>{{$resign->pegawai->nama}}</td>
  </tr>
  <tr>
    <td>Tempat, Tanggal Lahir</td>
    <td>:</td>
    <td>{{$resign->pegawai->tempat_lahir}}, {{konversi_tanggal($resign->pegawai->tanggal_lahir)}}</td>
  </tr>
  <tr>
    <td>Jabatan</td>
    <td>:</td>
    <td>{{$resign->pegawai->posisi->posisi}}</td>
  </tr>
  <tr>
    <td>Penugasan</td>
    <td>:</td>
    <td>Jalan Tol CIAWI SUKABUMI SEKSI 3</td>
  </tr>
  <tr>
    <td>Tanggal Masuk Kerja</td>
    <td>:</td>
    <td>{{$resign->pegawai->tanggal_masuk}}</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>:</td>
    @if($resign->pegawai->status_pegawai == 'PT')
      <td>Pegawai Tetap</td>
    @elseif($resign->pegawai->status_pegawai == 'PTT')
      <td>Pegawai Tidak Tetap</td>
    @elseif($resign->pegawai->status_pegawai == 'OS')
      <td>Outsourcing</td>
    @elseif($resign->pegawai->status_pegawai == 'Harian')
      <td>Harian</td>
    @endif
  </tr>
</table>
<br>
Benar-benar telah bekerja di PT. Waskita Karya (Persero), Tbk Proyek Jalan Tol CIAWI SUKABUMI SEKSI 3 dalam kurun waktu:
<br><br>
{{konversi_tanggal($resign->pegawai->tanggal_masuk)}} sampai dengan {{konversi_tanggal($resign->pegawai->tanggal_keluar)}}
<br><br>
Yang bersangkutan telah memberikan kontribusi yang baik bagi perusahaan dan selama bekerja tidak pernah melakukan perbuatan yang merugikan perusahaan kami.<br><br>
Kami berterima kasih atas semua kerjasama yang telah diberikan selama ini dan semoga yang bersangkutan dapat lebih sukses dan berhasil dimasa mendatang.<br><br>
Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya. <br>
<br><br>
Project Manager<br>
Jalan Tol CIAWI SUKABUMI SEKSI 3
<br><br>
<img src="{{asset('upload/pegawai/'.$pm->nip.'/'.$pm->ttd.'')}}" style="width: 220px; height: 60px;">
<br>
{{$pm->gelar_depan}}.{{$pm->nama}} {{$pm->gelar_belakang}}