<table>
  <tr>
    <td></td>
    <td></td>
    <th style="width: 6;">
      <img src="{{public_path('img/Waskita.png')}}" width="45" align="center">
    </th>
    <th colspan="4"><b style="font-weight: 3; font-size:12px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"></th>
    <td></td>
    <td style="border: 1px solid #000000;  " colspan="2" align="center">Formulir Log-07</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <td style="border: 1px solid #000000;">Edisi : </b></td>
    <td style="border: 1px solid #000000;">Revisi : </td>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="padding-left: 10px;">Business Unit</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td style="width: 6;"></td>    
    <td style="width: 17;">Proyek</td>
    <td colspan="4">: Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
    <td colspan="2" style="font-weight: bold;"> No. AB</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="8" style="text-align: center;border: 1px solid #000000"><h4><b>BUKU HARIAN PENGELUARAN BAHAN</b></h4></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Jenis Pekerjaan :</td>
    <td colspan="2">{{$data['jenis']->nama}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Volume Pekerjaan :</td>
    <td colspan="2">{{$data['volume']}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Lokasi Pekerjaan :</td>
    <td colspan="2">{{$data['lokasi']->nama}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">SOM/Superintendent Pekerjaan :</td>
    <td colspan="2">{{$data['som']}}</td>
    <td colspan="2">Nomor Pekerjaan :</td>
    <td >{{$data['nomor_pekerjaan']}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Periode:</td>
    <td colspan="2">{{konversi_tanggal($data['tanggal_mulai'])}} s.d {{konversi_tanggal($data['tanggal_selesai'])}}</td>
    <td align="left">No. Buku</td>
    <td >{{$data['no_buku']}}</td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="font-weight: bold; font-size: 10;" colspan="2" rowspan="2"  align="center">Tanggal</td>
    @foreach($materials as $material)
      <td style="border: 1px double #000000; font-weight: bold; font-size: 9; width: 13;" align="center" colspan="2">Bahan: {{$material['nama']}}</td>
    @endforeach
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    @foreach($materials as $material)
      <?php $jumlah[$material['material_id']] = 0; ?>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 11;" align="center">Jumlah</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" align="center">Jumlah Terusan</td>
    @endforeach
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td style="border: 1px double #000000; font-size: 10;" colspan="2">Jumlah s.d Bulan Lalu</td>
    <td style="border: 1px double #000000;"></td>
  </tr>
  <?php $i =1; ?>
  <?php
    for ($j=0; $j < count($tanggal) ; $j++) { 
  ?>
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000; font-size: 10; " colspan="2">{{konversi_tanggal($tanggal[$j])}}</td>
      @foreach($materials as $key=> $material)
        <td style="border: 1px solid #000000;font-size: 10;">{{$material['jumlah'][$tanggal[$j]]}}</td>
        <td style="border: 1px solid #000000;font-size: 10;">{{$jumlah[$material['material_id']] = $jumlah[$material['material_id']] + $material['jumlah'][$tanggal[$j]]}}</td>
      @endforeach
    </tr>
  <?php 
    }
  ?>

  @if(count($tanggal) < 31)
    <?php
      for($i=count($tanggal);$i<=31;$i++){?>
        <tr>
              <td></td>
              <td></td>
              <td style="border: 1px solid #000000;" colspan="2"></td>
        @foreach($materials as $key=> $material)
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
            
        @endforeach
        </tr>
    <?php  } ?>
    ?>
  @endif
  <tr>
    <td></td>
    <td></td>
    <td style="border: 1px double #000000; font-size: 10;" colspan="2">Jumlah Bulan ini</td>
    <td style="border: 1px double #000000; font-size: 10;"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td style="border: 1px double #000000; font-size: 10;" colspan="2">Jumlah s.d Bulan Ini</td>
    <td style="border: 1px double #000000; font-size: 10;"></td>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Bekasi,</td>
    <td>{{date('d-m-Y')}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Mengetahui</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Diisi oleh,</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">SPLEM</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" >Petugas Gudang</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>
      @if(file_exists("upload/pegawai/$splem->nip/$splem->ttd"))
        <img src="upload/pegawai/{{$splem->nip}}/{{$splem->ttd}}" width="100" align="center">
      @endif
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>
      <?php $nip = \Auth::user()->pegawai_id;
            $ttd= \Auth::user()->pegawai->ttd;
            $nama = \Auth::user()->name;
      ?>
      @if(file_exists("upload/pegawai/$nip/$ttd"))
        <img src="upload/pegawai/{{$nip}}/{{$ttd}}" width="100" align="center">
      @endif
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" >{{$splem->nama}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">{{$nama}}</td>
  </tr>
</table>
  