<table>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="9"></td>
    <td style="border: 1px solid #000000;font-size: 9; " colspan="3" align="center">Formulir Log-01</td>
  </tr>
  <tr>
    <td colspan="9"></td>
    <td style="border: 1px solid #000000; font-size: 9;" colspan="2">Edisi : {{bulan(date("m",strtotime($penerimaan->updated_at)))}} {{date("Y",strtotime($penerimaan->updated_at))}}</b></td>
    <td style="border: 1px solid #000000; font-size: 9;">Revisi : 01</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="10" style="text-align: center;"><h4><b>BERITA ACARA PENERIMAAN BAHAN</b></h4></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="10" style="text-align: center;"><h4><b>No. : .................</b></h4></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="10" style="font-size: 9;">Pada hari ini {{'senin'}}, tanggal {{$penerimaan->updated_at}} telah diadakan serah terima bahan sesuai SPM No. ……………...… tanggal ……………………… kepada PT Waskita Karya (Persero) Tbk  Divisi….…………….. untuk ……………………… Proyek ………………………, dengan rincian sebagai berikut :</td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;" rowspan="2" align="center">No.</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;" rowspan="2" align="center">Uraian</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;" rowspan="2" align="center">Sat</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;" colspan="5" align="center">Volume</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9; text-align: center;" rowspan="2" align="center" >Harga Satuan (Rp.)</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;" rowspan="2" align="center">Jumlah saat ini (Rp.)</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;" rowspan="2" align="center">Jumlah s.d saat ini (Rp.)</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;">Total (SPPM)</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;">sd. yang Lalu</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;">Saat ini</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;">sd. Saat ini</td>
    <td style="border: 1px solid #000000; font-weight: bold; font-size: 9;" >Sisa</td>
  </tr>
  <?php $i =1; ?>
  @foreach($datas as $key=> $data)
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000; font-size: 9" align="center">{{$i++}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="left" >{{$data->material->nama}}<br>{{$data->keterangan}}</td>
      <td style="border: 1px solid #000000; font-size: 9" align="center">{{$data->material->satuan}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="center">{{$data->penerimaan->permintaan->permintaanDetail[$key]->volume}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="right">{{$data->vol_lalu}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="right">{{$data->vol_saat_ini}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="right">{{$data->vol_jumlah}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="right">{{$data->vol_sisa}}</td>
      <?php 
          $jumlah = (int)$data->vol_jumlah * (int)$data->harga;
            $jumlah_saat_ini = (int)$data->vol_saat_ini * (int)$data->harga;
      ?>
      <td style="border: 1px solid #000000; font-size: 9"  align="right">{{$data->harga}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="right">{{$jumlah_saat_ini}}</td>
      <td style="border: 1px solid #000000; font-size: 9"  align="right">{{$jumlah}}</td>
    </tr>
  @endforeach
  @if(count($datas) < 14)
    <?php
      for($i=count($datas);$i<=15;$i++){
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
  <tr>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;" colspan="9" align="right" ><b>Jumlah<b></td>
    <td style="border: : 1px solid #000;"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="5">Terbilang : </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Prestasi s.d saat ini</td>
    <td></td>
    <td></td>
    <td colspan="3">Rp.</td>
    <td colspan="2"> x 100% = </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2"></td>
    <td></td>
    <td></td>
    <td colspan="4">Rp.</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Prestasi yang lalu</td>
    <td></td>
    <td></td>
    <td colspan="3">Rp.</td>
    <td colspan="2"> x 100% = </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2"></td>
    <td></td>
    <td></td>
    <td colspan="4">Rp.</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Prestasi saat ini</td>
    <td></td>
    <td></td>
    <td colspan="3">Rp.</td>
    <td colspan="2"> x 100% = </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2"></td>
    <td></td>
    <td></td>
    <td colspan="4">Rp.</td>
  </tr>
  <tr>
    <td></td>
    <td>Demikian Berita Acara Penerimaan Material ini dibuat agar dapat dipergunakan sebagaimana mestinya.
</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Menyetujui</td>
    <td></td>
    <td colspan="3" align="center">Yang menerima :</td>
    <td></td>
    <td colspan="3" align="center">Dibuat Oleh :</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Project Manager</td>
    <td></td>
    <td colspan="3" align="center">SPLEM</td>
    <td></td>
    <td colspan="3" align="center" >Penerima SPPM</td>
  </tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">{{$pm->nama}}</td>
    <td></td>
    <td colspan="3" align="center">{{$splem->nama}}</td>
    <td></td>
    <td></td>
    <td colspan="3" align="center">{{Auth::user()->nama}}</td>
  </tr>
</table>
  