<table>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"></th>
    <td></td>
    <td style="border: 1px solid #000000; font-weight: bold;" colspan="2" align="center">FORMULIR LOGINV-05</td>
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
    <td style="border: 1px solid #000000; font-size: 10;">Edisi : Mei 2020</b></td>
    <td style="border: 1px solid #000000; font-size: 10;">Revisi : 01 </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"><b style="font-weight: bold; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"><b style="font-weight: bold; font-size:16px; ">INDUSTRI KONSTRUKSI</b></th>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="padding-left: 10px; font-weight: bold; font-size: 10">Business Unit :</td>
  </tr>
  <tr>
    <td style="height: 5;"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>    
    <td colspan="5" style="font-weight: bold; font-size: 10;"> Proyek : Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
    <td colspan="3" style="font-weight: bold;"> ID Proyek :</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="8" style="text-align: center;border: 2px solid #000000; height: 18;"><b>LAPORAN EVALUASI PEMAKAIAN MATERIAL</b></td>
  </tr>
</table>
<table class="table table-striped">
  <tr>
      <td></td>
      <td></td>
      <td></td>
      @php
        $date = explode('-',$dt['tanggal_mulai']);
      @endphp
      <td>Bulan : {{bulan($date[1])}}</td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Tahun: {{$date[2]}}</td>
  </tr>
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="font-weight: bold; font-size: 10;" rowspan="2" align="center">Asal Material *)</td>
    <td style="font-weight: bold; font-size: 10;" rowspan="2" align="center">Nomor / Nama Material</td>
    <td style="font-weight: bold; font-size: 10;" colspan="3" align="center">Volume Material</td>
    <td style="font-weight: bold; font-size: 10;" colspan="3" align="center">Sisa Stock dalam SAP
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="font-weight: bold; font-size: 10;">Volume Koreksi</td>
    <td style="font-weight: bold; font-size: 10;">Masuk</td>
    <td style="font-weight: bold; font-size: 10;">Terpakai</td>
    <td style="font-weight: bold; font-size: 10;">Jumlah Sisa</td>
    <td style="font-weight: bold; font-size: 10;" >Harga Satuan (Rupiah)</td>
    <td style="font-weight: bold; font-size: 10;" >Jumlah Harga (Rupiah)</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td style="font-size: 10;">1</td>
    <td style="font-size: 10;">2</td>
    <td style="font-size: 10;">3</td>
    <td style="font-size: 10;">4</td>
    <td style="font-size: 10;">5</td>
    <td style="font-size: 10;">6 = 4-5</td>
    <td style="font-size: 10;" >7</td>
    <td style="font-size: 10;" >8 = 6x7</td>
  </tr>
  <?php $i =1; ?>
  @foreach($materials as $key=> $data)
    <tr>
      <td></td>
      <td></td>
      <td align="left" ></td>
      <td align="left" >{{$data['nama']}}</td>
      <td align="left">{{$data['kebutuhan']}}</td>
      <td align="right">{{$data['masuk']}}</td>
      <td align="right">{{$data['terpakai']}}</td>
      <td align="right">{{$data['masuk'] - $data['terpakai']}}</td>
      <td align="right">{{$data['harga']}}</td>
      <td align="right">{{($data['masuk'] - $data['terpakai'])*$data['harga']}}</td>
    </tr>
    <?php $i++; ?>
  @endforeach
  @if(count($materials) < 33)
    <?php
      for($i=count($materials);$i<=33;$i++){
        echo '<tr>
              <td></td>
              <td></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
              <td align="center"></td>
            </tr>';
      }
    ?>
  @endif
  <tr>
    <td></td>
    <td></td>
    <td colspan="2" style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2" style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
  </tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td>*) Diisi :</td>
    <td colspan="2" >1 - Dikerjakan Sendiri</td>
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
    <td colspan="2">2 - Disub-kontraktorkan</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center" colspan="2" style="text-align: center;" >SPLEM</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">3 - Diadakan oleh Pemberi Tugas<br></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">4 - Material Impor<br></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">5 - Material Pendukung<br></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
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
    <td></td>
    <td align="center" colspan="2" style="font-size: 10; text-align: center;">{{$splem->nama}}</td>
  </tr>
</table>
  