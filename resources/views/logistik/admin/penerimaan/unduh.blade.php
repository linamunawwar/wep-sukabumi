<?php
 $hari   = date('l', microtime($penerimaan->tanggal));
 $hari_indonesia = array('Monday'  => 'Senin',
    'Tuesday'  => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu');
 $nama_hari = $hari_indonesia[$hari];
?>
<table>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="10"></td>
    <td style="border: 1px solid #000000;font-size: 9; " colspan="3" align="center">Formulir Log-01</td>
  </tr>
  <tr>
    <td colspan="10"></td>
    <td style="border: 1px solid #000000; font-size: 9;" colspan="2">Edisi : {{bulan(date("m",strtotime($penerimaan->updated_at)))}} {{date("Y",strtotime($penerimaan->updated_at))}}</b></td>
    <td style="border: 1px solid #000000; font-size: 9;">Revisi : 01</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"><b style="font-weight: 3; font-size:16px; ">INDUSTRI KONSTRUKSI</b></th>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="11" style="text-align: center;"><h3><b>BERITA ACARA PENERIMAAN BAHAN</b></h3></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4" style="text-align: right;"><b>Nomor :</b></td>
    <td colspan="4" align="left"><b>.................</b></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4" style="text-align: right;"><b>Nomor GR : </b></td>
    <td colspan="4" align="left"><b>.................</b></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    @php
      $exploded = explode('-',$penerimaan->tanggal);
    @endphp
    <td colspan="11" style="font-size: 10.5;">Pada hari ini '{{$nama_hari}}', tanggal '{{terbilang($exploded[2])}}'  Bulan '{{bulan($exploded[1])}}' Tahun '{{terbilang($exploded[0])}} ( {{konversi_tanggal($penerimaan->tanggal)}} ) ' telah diadakan serah terima bahan sesuai SPM No. ……………...… tanggal ……………………… kepada PT. Waskita Karya Infrastructure 2 Division untuk Proyek Pembangunan Jalan Tol CIAWI SUKABUMI SEKSI 3, No. AB :  D32C19009, Sebagai berikut :</td>
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
  <?php $i =1;$j1=0;$j2=0; ?>
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
    @php
      $j1 = (int)$j1+ (int)$jumlah_saat_ini;
      $j2 = (int)$j2+ (int)$jumlah;
    @endphp
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
    <td style="border: 1px solid #000000; font-size: 10;" colspan="9" align="right" ><b>Jumlah  =  </b></td>
    <td style="border: : 1px solid #000;">{{$j1}}</td>
    <td style="border: : 1px solid #000;">{{$j2}}</td>
  </tr>
  @php
    $ppn1 = $j1/10;
    $ppn2 = $j2/10;
    $tot1 = $j1+$ppn1;
    $tot2 = $j2+$ppn2;
    if($j1 != 0) {
      $p_dgn_ini = $j2/$j1;
      $p_lalu = 0/$j1;
      $p_saat_ini = $j1/$j1;
    }else{
      $p_dgn_ini = 0;
      $p_lalu = 0;
      $p_saat_ini = 0;
    }

  @endphp
  <tr>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; font-size: 10" colspan="9" align="right" >PPN 10%  =  </td>
    <td style="border: : 1px solid #000;">{{$ppn1}}</td>
    <td style="border: : 1px solid #000;">{{$ppn2}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; font-size: 10" colspan="9" align="right" ><b>Total  =  <b></td>
    <td style="border: : 1px solid #000;">{{$tot1}}</td>
    <td style="border: : 1px solid #000;">{{$tot2}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="11"><b><i>Terbilang : ==  {{terbilang($tot1)}} rupiah ==</i></b></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Progress s.d saat ini</td>
    <td></td>
    <td></td>
    <td colspan="2" align="right">Rp. {{$j2}}</td>
    <td colspan="2"> x 100% = </td>
    <td>{{$p_dgn_ini * 100}}%</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2"></td>
    <td></td>
    <td></td>
    <td colspan="2" align="right">Rp. {{$j1}}</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Progress yang lalu</td>
    <td></td>
    <td></td>
    <td colspan="2" align="right">Rp. 0</td>
    <td colspan="2"> x 100% = </td>
    <td>{{$p_lalu * 100}} %</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2"></td>
    <td></td>
    <td></td>
    <td colspan="2" align="right">Rp. {{$j1}}</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2">Progress saat ini</td>
    <td></td>
    <td></td>
    <td colspan="2" align="right">Rp. {{$j1}}</td>
    <td colspan="2"> x 100% = </td>
    <td>{{$p_saat_ini * 100}}%</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2"></td>
    <td></td>
    <td></td>
    <td colspan="2" align="right">Rp. {{$j1}}</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="11">Demikian Berita Acara Penerimaan Material ini dibuat agar dapat dipergunakan sebagaimana mestinya.
    </td>
  </tr>
  <tr>
    <td></td>
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
  