<table>
  <tr>
    <td></td>
    <td></td>
    <th style="width: 6;"></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="7"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
    <td></td>
    <td style="border: 1px solid #000000;  " colspan="3" align="center">Formulir Log-08</td>
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
    <th></th>
    <th></th>
    <th></th>
    <td style="border: 1px solid #000000;" colspan="2">Edisi : {{$waste->bulan}} {{$waste->tahun}}</b></td>
    <td style="border: 1px solid #000000;">Revisi : </td>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Business Unit</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>    
    <td>Proyek</td>
    <td colspan="3">: Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3" style="font-weight: bold;"> No. AB</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="12" style="text-align: center;border: 1px solid #000000"><h4><b>EVALUASI "WASTE MATERIAL"</b></h4></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4">Nama Bahan : {{$waste->wasteMaterial->nama}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">Bulan : {{$waste->bulan}}</td>
    <td></td>
    <td colspan="2">Tahun : {{$waste->tahun}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="5">Jenis Pekerjaan : {{$waste->wasteJenisKerja->nama}}</td>
    <td></td>
    <td></td>
    <td colspan="3">Volume Pekerjaan : {{$waste->volume_pekerjaan}}</td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">No.</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10; width: 20;" rowspan="2" align="center">Lokasi Pekerjaan</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10; width: 20;" rowspan="2" align="center">Kalap/ Pelaksana</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10; width: 12;" colspan="2" align="center">Progress Pekerjaan</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10; width: 15; text-align: center;" rowspan="2" align="center" >Volume Bahan Sesuai Progress</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9; width: 16;" rowspan="2" align="center">Realisasi Pemakaian Bahan</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;width: 16;" rowspan="2" align="center">Waste dalam Satuan Volume</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10; width: 12;"  colspan="3"align="center" >Waste Bahan (%)</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center">Keterangan</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;font-weight: bold; font-size: 10;">%</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Volume</td>
    <td></th>
    <td></td>
    <td ></td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Renc</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Real</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" >Deviasi</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td colspan="3" style="border: 1px double #000000; font-weight: bold; font-size: 10;" align="center">Jumlah Sampai dengan Bulan lalu</td>
    <td style="border: 1px double #000000;" align="right">{{$jml_progress_persen}}</td>
    <td style="border: 1px double #000000;" align="right">{{$jml_progress_vol}}</td>
    <td style="border: 1px double #000000;" align="right">{{$jml_vol_bahan}}</td>
    <td style="border: 1px double #000000;" align="right">{{$jml_real_pemakaian}}</td>
    <td style="border: 1px double #000000;" align="right">{{$jml_waste_vol}}</td>
    <td style="border: 1px double #000000;" align="right"></td>
    <td style="border: 1px double #000000;" align="right"></td>
    <td style="border: 1px double #000000;" align="right"></td>
    <td style="border: 1px double #000000;" align="right"></td>
  </tr>
  <?php $i =1; $progress_vol=0; $progress_persen=0; $vol_bahan=0; $real_pemakaian=0; $waste_vol=0; ?>
  @foreach($datas as $data)
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;" align="center">{{$i++}}</td>
      <td style="border: 1px solid #000000;"  align="left" >{{$data->wasteLokasi->nama}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->pelaksanaPegawai->nama}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->progress_persen}}</td>
      <?php $progress_persen = $progress_persen + $data->progress_persen;?>
      <td style="border: 1px solid #000000;"  align="right">{{$data->progress_vol}}</td>
      <?php $progress_vol = $progress_vol + $data->progress_vol;?>
      <td style="border: 1px solid #000000;"  align="right">{{$data->vol_bahan}}</td>
      <?php $vol_bahan = $vol_bahan + $data->vol_bahan;?>
      <td style="border: 1px solid #000000;"  align="right">{{$data->real_pemakaian}}</td>
      <?php $real_pemakaian = $real_pemakaian + $data->real_pemakaian;?>
      <td style="border: 1px solid #000000;"  align="right">{{$data->waste_vol}}</td>
      <?php $waste_vol = $waste_vol + $data->waste_vol;?>
      <td style="border: 1px solid #000000;"  align="right">{{$data->waste_rencana}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->waste_real}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->waste_deviasi}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->keterangan}}</td>
    </tr>
  @endforeach
  @if(count($datas) < 18)
    <?php
      for($i=count($datas);$i<=18;$i++){
        echo '<tr>
              <td></td>
              <td></td>
              <td style="border: 1px solid #000000;" align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
            </tr>';
      }
    ?>
  @endif
  <tr>
    <td></td>
    <td></td>
    <td colspan="3" style="border: 1px solid #000000; font-weight: bold; font-size: 10;" align="center">Jumlah Bulan ini</td>
    <td style="border: 1px solid #000000;" align="right">{{$progress_persen}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$progress_vol}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$vol_bahan}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$real_pemakaian}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$waste_vol}}</td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="3" style="border: 1px solid #000000; font-weight: bold; font-size: 10;" align="center">Jumlah Sampai Dengan Bulan ini</td>
    <td style="border: 1px solid #000000;" align="right">{{$jml_progress_persen + $progress_persen}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$jml_progress_vol + $progress_vol}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$jml_vol_bahan + $vol_bahan}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$jml_real_pemakaian + $real_pemakaian}}</td>
    <td style="border: 1px solid #000000;" align="right">{{$jml_waste_vol + $waste_vol}}</td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
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
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Disetujui</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Dibuat Oleh</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Project Manager</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center" >SPLEM</td>
    <td colspan="2"  >SEM</td>
    <td colspan="2" >SCARM</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center; height: 15;" height="15" colspan="2">
      @if(file_exists("upload/pegawai/$pm->nip/$pm->ttd"))
        <img src="upload/pegawai/{{$pm->nip}}/{{$pm->ttd}}" width="100" align="center">
      @endif
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center;">
      @if(file_exists("upload/pegawai/$splem->nip/$splem->ttd"))
        <img src="upload/pegawai/{{$splem->nip}}/{{$splem->ttd}}" width="100" align="center">
      @endif
    </td>
    <td style="text-align: center;" colspan="2">
      @if(file_exists("upload/pegawai/$sem->nip/$sem->ttd"))
        <img src="upload/pegawai/{{$sem->nip}}/{{$sem->ttd}}" width="100" align="center" style="margin-left: 10; padding: 10;">
      @endif
    </td>
    <td style="text-align: center;" colspan="2">
      @if(file_exists("upload/pegawai/$scarm->nip/$scarm->ttd"))
        <img src="upload/pegawai/{{$scarm->nip}}/{{$scarm->ttd}}" width="100" align="center">
      @endif
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">{{$pm->nama}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">{{$splem->nama}}</td>
    <td colspan="2">{{$sem->nama}}</td>
    <td colspan="2">{{$scarm->nama}}</td>
  </tr>
</table>
  