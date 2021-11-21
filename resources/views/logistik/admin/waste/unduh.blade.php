<table>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
      <th colspan="11"></th>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="2" align="center">FORMULIR LOGINV-06</td>
    </tr>
    <tr>
      <td colspan="11"></td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 8;">Edisi : Mei 2020</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 8;">Revisi : 01 </td>
    </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="7"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="7"><b style="font-weight: 3; font-size:16px; ">INDUSTRI KONSTRUKSI</b></th>
  </tr>
  <tr>
    <td></td>
  </tr>
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
    <td colspan="4">: </td>
    <td colspan="3" style="font-weight: bold;"> ID Project :</td>
  </tr> 
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="11" style="text-align: center;border: 1px solid #000000"><h4><b>EVALUASI "WASTE MATERIAL"</b></h4></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4">Bulan : {{bulan($waste->bulan)}}</td>
    <td colspan="2">Tahun : {{$waste->tahun}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4">
      @php 
          ($waste->jenis_pekerjaan_id === '') ? $jenis = 'Semua Jenis Pekerjaan' : $jenis = $waste->wasteJenisKerja->nama;
      @endphp
      Jenis Pekerjaan : {{$jenis}}
    </td>
    <td colspan="3">
      @php 
          ($waste->lokasi_id === '') ? $lokasi = 'Semua Lokasi' : $lokasi = $waste->wasteLokasi->nama;
      @endphp
      Lokasi : {{$lokasi}}
    </td>
    <td colspan="3">Progress Pekerjaan :</td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">No.</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">Jenis Material</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">Sat</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">Vol (APP)</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">Progress (%)</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">Vol APP sesuai Progress</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">Pemakaian Material di Lapangan</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center" >Deviasi Volume</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;"  colspan="3"align="center" >Waste (%)</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Deviasi Terhadap Rencana</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Rencana Waste di APP</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" >Realisasi</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">1</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">2</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">3</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">4</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">5</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">6 = 4 x 5</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">7</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">8 = 6 - 7</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">9 = 8 / 6</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">10</td>
    <td style="border: 1px solid #000000; color: #FF0000; font-weight: bold;font-size: 9;">11 = 9 + 10</td>
  </tr>
  @php $i=1; @endphp
  @foreach($details as $data)
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;" align="center">{{$i++}}</td>
      <td style="border: 1px solid #000000;"  align="left" >{{$data->wasteMaterial->nama}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->satuan}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->vol_app}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->progress_persen}}%</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->vol_progress}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->pemakaian}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->deviasi_vol}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->deviasi}}%</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->rencana_waste}}%</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data->realisasi}}%</td>
    </tr>
  @endforeach
  @if(count($details) < 18)
    <?php
      for($i=count($details);$i<=18;$i++){
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
            </tr>';
      }
    ?>
  @endif
  <tr></tr>
  <tr>
    <td colspan="11">*Catatan : Vol. APP sudah termasuk volume waste rencana</td>
  </tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Disetujui</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" align="center">Dibuat Oleh</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Project Manager</td>
    <td></td>
    <td colspan="2" align="center" >SPLEM</td>
    <td></td>
    <td colspan="2" align="center" >SEM</td>
    <td></td>
    <td colspan="2" align="center" >SCARM</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">{{$pm->nama}}</td>
    <td></td>
    <td colspan="2" align="center">{{$splem->nama}}</td>
    <td></td>
    <td colspan="2" align="center">{{$sem->nama}}</td>
    <td></td>
    <td colspan="2" align="center">{{$scarm->nama}}</td>
  </tr>
</table>
  