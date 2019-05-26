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
    font-size: 13px;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  }
  .fa {
    display: inline;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 1;
    font-family: FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
</style>

<div style="text-align: center;">
  <h3 style="font-family: 'Times New Roman';padding: 0;margin: 0;">KUESIONER  PEMERIKSAAN  KESEHATAN (MCU)<br><br>
SEBELUM  BEKERJA</h3>
</div><br>
<div style="text-align: left;">
  <h4 style="font-size: 14px;"><i>Identifikasi Kesehatan</i></h4>
  <table border="1" style="width: 100%;border-collapse: collapse; text-align: left;" cellspacing="1" cellpadding="3">
    <tr>
      <td style="height: 15px;">Nama : {{$pegawai->nama}}</td>
      <td>Tgl. Lahir : {{konversi_tanggal($pegawai->tanggal_lahir)}}</td>
      @if($pegawai->gender == 'P')
        <td>Jenis Kelamin : Pria</td>
      @else
        <td>Jenis Kelamin : Wanita</td>
      @endif
    </tr>
    <tr>
      <td style="height: 15px;">Perusahaan : PT Waskita Karya (Persero) Tbk</td>
      <td colspan="2">Terakhir MCU :</td>
    </tr>
  </table>
  <br>
  <p style="font-size: 14px;"><i>Pentunjuk : Berilah tanda (<span class="fa fa-check"></span>) yang menurut anda sesuai.</i></p>
  <table border="1" style="width: 100%;border-collapse: collapse;" cellspacing="1" cellpadding="3">
    <tr>
      <td style="text-align: center;"><b>NO</b></td>
      <td style="text-align: center;"><b>Ya</b></td>
      <td style="text-align: center;"><b>Tdk</b></td>
      <td style="text-align: center;"><b>Pernahkah Anda terkena</b></td>
    </tr>
    <?php $i = 1; ?>
    @foreach($mcus as $mcu)
      <tr>
        <td style="text-align: center;">{{$i++}}</td>
        @if($mcu->nilai == 1)
          <td><span class="fa fa-check"></span></td>
          <td></td>
        @else
          <td></td>
          <td><span class="fa fa-check"></span></td>
        @endif
        <td>{{$mcu->mcu->pernyataan}}</td>
      </tr>
    @endforeach
  </table>
  <p>Sebutkan nama obat yang sedang diminum :</p><br>
  <div style="width: 500px; border-bottom: 1px solid black;"></div>
  <div>
  <p>Saya menyatakan bahwa keterangan diatas saya isi dengan benar dan saya sadar bahwa kesalahan informasi yang saya berikan akan menyebabkan cacatnya sertifikat yang diberikan :<br><br>
    Tanggal: {{konversi_tanggal(date('Y-m-d'))}}<br>
    Tanda Tangan<br></p>
    <img src="{{ asset("public/img/Waskita.png") }}" style="width: 70px; height: 50px;"/>
    
  </div>
</div>
  