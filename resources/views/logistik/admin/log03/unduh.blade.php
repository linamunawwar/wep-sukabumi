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
    <th colspan="3"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
    <th></th>
    <th></th>
    <td style="border: 1px solid #000000;  " colspan="2" align="center">Formulir Log-03</td>
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
    <td></td>    
    <td>Proyek</td>
    <td colspan="2">: </td>
    <td></td>
    <td colspan="3" style="font-weight: bold;"> No. AB</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="8" style="text-align: center;border: 1px solid #000000"><h4><b>LAPORAN EVALUASI MINGGUAN PENGADAAN BAHAN</b></h4></td>
  </tr>
  <tr></tr>
  <tr>
      <td></td>
      <td></td>
      <td colspan="3">Periode : {{$dataInput['tanggal_mulai']}} s.d {{$dataInput['tanggal_selesai']}} </td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center">No</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center"> Jenis Bahan </td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 15;" rowspan="2" align="center"> Satuan </td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 20;" rowspan="2" align="center"> Rencana Pengadaan </td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 20;" rowspan="2" align="center"> Realiasi Pengadaan </td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" colspan="2" align="center"> Penyimpangan </td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center"> Keterangan </td>
  </tr>
  <tr class="thead-light" >
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;"align="center"> ( + ) </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;"align="center"> ( - ) </td>
      <td></td>
  </tr>
  <?php $no = 1;  ?>
  @foreach ($data as $key => $val)
    <tr class="thead-light" style="text-align: center;">
        <td></td>
        <td></td>
        <td style="border: 1px double #000000;">{{ $no++ }}</td>
        <td style="border: 1px double #000000;">{{ $val['nama'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['satuan'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['rencana'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['realisasi'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['sesuai'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['tidakSesuai'] }}</td>
        <td style="border: 1px double #000000;"> </td>
    </tr>
    @endforeach
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
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;"> Tanggal </td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;">Disetujui</td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;"> Dibuat Oleh, </td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;">Project Manager</td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;"> SPLEM </td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" style="height:70; content-align:center;">
      @if(file_exists(url('upload/pegawai').'/'.$pm->nip.'/'.$pm->ttd))
          <img src="url('upload/pegawai').'/'.$pm->nip.'/'.$pm->ttd)" width="100" align="center">
      @endif
    </td>
    <td></td>
    <td></td>
    <td colspan="2" style="height:70;"> 
      @if(file_exists(url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd))
          <img src="url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd)" width="100" align="center">
      @endif
    </td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;"> {{ $pm->nama }}  </td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;"> {{ $splem->nama }} </td>
    <td></td>
    <td></td>
</tr>
</table>
  