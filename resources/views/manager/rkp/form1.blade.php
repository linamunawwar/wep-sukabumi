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
    <th colspan="7"><b style="font-weight: 3;">PT. WASKITA KARYA (Persero) Tbk</b></th>
    <th style="border: 1px solid #000000 width:30;" colspan="3">Form. WK-SDM-03-01</th>
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
    <th style="border: 1px solid #000000 width:30;" colspan="3"><b>Edisi : 3</b></th>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>PUSAT</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><b>V</b></td>    
    <td>Unit Kerja/Bisnis/Proyek</td>
    <td>: Proyek Jalan Tol CIAWI SUKABUMI SEKSI 3</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="14" style="text-align: center;"><h4><b>RENCANA KEBUTUHAN PEGAWAI</b></h4></td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;" rowspan="3" align="center">No.</th>
    <td  colspan="2" align="center"></th>
    <td style="border: 1px solid #000000; width: 27;" rowspan="3" align="center">Kebutuhan</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="3" align="center">Tersedia</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="3" align="center">Kurang / Lebih</th>
    <td style="border: 1px solid #000000; width: 15; text-align: center;" colspan="4" align="center" >Pemenuhan</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="3" align="center">Keterangan</th>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <th></th>
    <td colspan="2" align="center">Unit Kerja</td>
    <th></th>
    <th></th>
    <th></th>
    <td style="border: 1px solid #000000;" colspan="4"  align="center">Promosi/Mutasi</td>
    <td ></td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2"></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td style="border: 1px solid #000000;">Masuk</td>
    <td style="border: 1px solid #000000;">Keluar</td>
    <td style="border: 1px solid #000000;">Jumlah</td>
    <td style="border: 1px solid #000000;">Rekrut</td>
    <td></td>
  </tr>
  <?php $i =1; ?>
  @foreach($dt_rkp as $data)
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;" align="center">{{$i++}}</td>
      <td style="border: 1px solid #000000;"  align="center" colspan="2" >{{$data->posisi->posisi}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->kebutuhan}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->tersedia}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->kurang_lebih}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->masuk}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->keluar}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->jumlah}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->rekrut}}</td>
      <td style="border: 1px solid #000000;"  align="center"></td>
    </tr>
  @endforeach
  @if(count($dt_rkp) < 12)
    <?php
      for($i=count($dt_rkp);$i<=12;$i++){
        echo '<tr>
              <td></td>
              <td></td>
              <td style="border: 1px solid #000000;" align="center"></td>
              <td style="border: 1px solid #000000;"  align="center" colspan="2" ></td>
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
    @if($rkp->is_verif_pm ==1)
      <td>Bekasi, {{formatTanggalPanjang($rkp->tanggal)}}</td>
    @else
      <td>Bekasi, </td>
    @endif
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Menyetujui,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Yang Mengusulkan,</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center; height: 15;" height="15">
      @if(file_exists("upload/pegawai/$pm->nip/$pm->ttd"))
        <img src="upload/pegawai/{{$pm->nip}}/{{$pm->ttd}}" width="150" align="center">
      @endif
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center;">
      @if(file_exists("upload/pegawai/$manager->nip/$manager->ttd"))
        <img src="upload/pegawai/{{$manager->nip}}/{{$manager->ttd}}" width="150" align="center">
      @endif
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">{{$pm->nama}}</td>
    <td></td>
    <td><</td>
    <td></td>
    <td></td>
    <td align="center">{{$manager->nama}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Project Manager</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center" colspan="2">{{$manager->posisi->posisi}}</td>
  </tr>
</table>
  