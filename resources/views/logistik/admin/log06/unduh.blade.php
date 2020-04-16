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
    <th colspan="4"></th>
    <td></td>
    <td style="border: 1px solid #000000; font-weight: bold;" colspan="2" align="center">Formulir Log-06</td>
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
    <td style="border: 1px solid #000000;">Edisi : Mei 2019</b></td>
    <td style="border: 1px solid #000000;">Revisi : 0 </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <th></th>
    <th colspan="4"><b style="font-weight: bold; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="padding-left: 10px; font-weight: bold;">Business Unit </td>
    <td style="font-weight: bold;">:</td>
  </tr>
  <tr>
    <td style="height: 5;"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>    
    <td style="font-weight: bold;">Proyek   </td>
    <td colspan="4"><div style="font-weight: bold;">:</div> Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
    <td colspan="3" style="font-weight: bold;"> No. AB</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="8" style="text-align: center;border: 2px solid #000000; height: 18;"><b>LAPORAN EVALUASI PEMAKAIAN BAHAN</b></td>
  </tr>
</table>
<table class="table table-striped">
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">Halaman : ...dari...</td>
  </tr>
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="font-weight: bold; font-size: 10; width: 8;" rowspan="2" align="center">Asal Bahan *)</td>
    <td style="font-weight: bold; font-size: 10; width: 22;" rowspan="2" align="center">JENIS BAHAN</td>
    <td style="font-weight: bold; font-size: 10; width: 12; height: 20;" colspan="3" align="center">VOLUME BAHAN</td>
    <td style="font-weight: bold; font-size: 10; width: 12;" colspan="3" align="center">SISA STOCK (FIFO)</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="font-weight: bold; font-size: 10;">KEBUTUHAN</td>
    <td style="font-weight: bold; font-size: 10; width: 10;">MASUK</td>
    <td style="font-weight: bold; font-size: 10;">TERPAKAI</td>
    <td style="font-weight: bold; font-size: 10;">JUMLAH</td>
    <td style="font-weight: bold; font-size: 10;width: 14;" >HRG_SAT</td>
    <td style="font-weight: bold; font-size: 10;" >JML_HRG</td>
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
  @if(count($materials) < 14)
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
    <td colspan="2">3 - Diadakan oleh Pemberi Tugas<br> 4 - Material Impor<br>5 - Material Pendukung</td>
    <td></td>
    <td></td>
    <td></td>
    <td rowspan="3">
      @if(file_exists('upload/pegawai/'.$splem->nip.'/'.$splem->ttd))
        <img src="{{'upload/pegawai/'.$splem->nip.'/'.$splem->ttd}}" width="100" align="center">
      @endif
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">4 - Material Impor</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">5 - Material Pendukung</td>
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
  