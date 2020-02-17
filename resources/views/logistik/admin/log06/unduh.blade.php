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
    <th colspan="4"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;  " colspan="2" align="center">Formulir Log-06</td>
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
    <td style="border: 1px solid #000000;">Edisi : </b></td>
    <td style="border: 1px solid #000000;">Revisi : </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <td style="font-style: 14px;">Periode</td>
    <td>: {{$dt['tanggal_mulai']}} s.d {{$dt['tanggal_selesai']}}</td>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td></td>
  </tr>
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
    <td colspan="3">: Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
    <td></td>
    <td></td>
    <td colspan="3" style="font-weight: bold;"> No. AB</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="9" style="text-align: center;border: 1px solid #000000"><h4><b>LAPORAN EVALUASI PEMAKAIAN BAHAN</b></h4></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center">No.</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 13;" rowspan="2" align="center">Asal Bahan *)</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 27;" rowspan="2" align="center">JENIS BAHAN</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" colspan="3" align="center">VOLUME BAHAN</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" colspan="3" align="center">SISA STOCK (FIFO)</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="border: 1px double #000000;font-weight: bold; font-size: 10;">KEBUTUHAN</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">MASUK</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">TERPAKAI</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">JUMLAH</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" >HRG_SAT</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" >JML_HRG</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td style="border: 1px double #000000;font-weight: bold; font-size: 10;"></td>
    <td style="border: 1px double #000000;font-weight: bold; font-size: 10;">1</td>
    <td style="border: 1px double #000000;font-weight: bold; font-size: 10;">2</td>
    <td style="border: 1px double #000000;font-weight: bold; font-size: 10;">3</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">4</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">5</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">6 = 4-5</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" >7</td>
    <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" >8 = 6x7</td>
  </tr>
  <?php $i =1; ?>
  @foreach($materials as $key=> $data)
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;"  align="center">{{$i}}</td>
      <td style="border: 1px solid #000000;"  align="left" ></td>
      <td style="border: 1px solid #000000;"  align="left" >{{$data['nama']}}</td>
      <td style="border: 1px solid #000000;"  align="left">{{$data['kebutuhan']}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data['masuk']}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data['terpakai']}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data['masuk'] - $data['terpakai']}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{$data['harga']}}</td>
      <td style="border: 1px solid #000000;"  align="right">{{($data['masuk'] - $data['terpakai'])*$data['harga']}}</td>
    </tr>
    <?php $i++; ?>
  @endforeach
  @if(count($materials) < 14)
    <?php
      for($i=count($materials);$i<=40;$i++){
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
  </tr>
  <tr>
    <td></td>
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
    <td></td>
    <td colspan="2">2 - Disub-kontraktorkan</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center" >SPLEM</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">3 - Diadakan oleh Pemberi Tugas<br> 4 - Material Impor<br>5 - Material Pendukung</td>
    <td></td>
    <td></td>
    <td></td>
    <td>
      @if(file_exists('upload/pegawai/'.$splem->nip.'/'.$splem->ttd))
        <img src="{{url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd}}" width="100" align="center">
      @endif
    </td>
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
    <td></td>
    <td align="center" colspan="2" height="40">{{$splem->nama}}</td>
  </tr>
</table>
  