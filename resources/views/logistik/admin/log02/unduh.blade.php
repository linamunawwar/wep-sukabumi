<table>
    <tr>
      <td></td>
      <td></td>
      <th></th>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th colspan="5"></th>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="2" align="center">FORMULIR LOGINV-02</td>
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
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 8;">Edisi : Mei 2020</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 8;">Revisi : 01 </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th></th>
      <th colspan="4"><b style="font-weight: 3;">PT. WASKITA KARYA (Persero) Tbk</b></th>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th></th>
      <th colspan="4"><b style="font-weight: 3;">INDUSTRI KONSTRUKSI</b></th>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td colspan="2" style="padding-left: 10px; font-weight: bold;">   Business Unit</td>
      <td>:</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>    
      <td colspan="2" style="font-weight: bold;">   Proyek</td>
      <td colspan="2">: </td>
      <td style="font-weight: bold;"> ID Project</td>
      <td style="font-weight: bold;">:</td>
    </tr>
  </table>
  
  <table class="table table-striped" style="text-align: center;">
    <tr>
      <td></td>
      <td></td>
      <td colspan="8" style="text-align: center;border: 1px solid #000000"><h4><b>KARTU GUDANG / STOCK CARD</b></h4></td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2">Bulan </td>
        <td align="left">: {{ $bulan }}</td>
        <td></td>
        <td></td>
        <td align="left">No.material</td>
        <td colspan="2">:</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2">Tahun </td>
        <td align="left">: {{ $data2['tahun'] }}</td>
        <td></td>
        <td></td>
        <td align="left">Nama Bahan </td>
        <td colspan="2">: {{ $material->nama }}</td>
    </tr>
  </table>
  <table class="table table-striped">
    <tr class="thead-light" >
      <td></td>
      <td></td>
      <td colspan="2" style="font-weight: bold; font-size: 10;" align="center">Tanggal</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="2" align="center">PENERIMAAN (GR)</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="2" align="center"> PENGELUARAN (GI) </td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center"> Sisa </td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center"> Keterangan </td>
    </tr>
    <tr class="thead-light" style="text-align: center;">
      <td></td>
      <td></td>
      <td colspan="2"></td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Jumlah</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Jumlah Terusan</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Jumlah</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" >Jumlah Terusan</td>
    </tr>
    @foreach ($data as $key => $val)
    <tr class="thead-light" style="text-align: center;">
        <td></td>
        <td></td>
        <td colspan="2" style="border: 1px solid #000000; font-size: 8" align="center">{{ $key }}</td>
        <td style="border: 1px solid #000000; font-size: 8">{{ $val['jml_terima'] }}</td>
        <td style="border: 1px solid #000000; font-size: 8">{{ $val['trs_terima'] }}</td>
        <td style="border: 1px solid #000000; font-size: 8">{{ $val['jml_keluar'] }}</td>
        <td style="border: 1px solid #000000; font-size: 8">{{ $val['trs_keluar'] }}</td>
        <td style="border: 1px solid #000000; font-size: 8">{{ $val['sisa'] }}</td>
        <td style="border: 1px solid #000000; font-size: 8"></td>
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
        <td></td>
        <td colspan="2" style="text-align: center;"> Bekasi, {{$data2['tgl_terakhir'].'-'.$data2['bulan'].'-'.$data2['tahun']}} </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;">Mengetahui</td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;"> Diisi Oleh, </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;" align="center">SPLEM</td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;"> Petugas Gudang </td>
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
        <td colspan="2" style="text-align: center;"> {{ $splem->nama }} </td>
        <td></td>
        <td colspan="2" style="text-align: center;">  </td>
        <td></td>
        <td></td>
    </tr>
    <tr></tr>
    <tr>
      <td></td>
      <td></td>
      <td colspan="2"> <b><u> Catatan : </u></b> </td>
      <td colspan="3" >Dibuat Rangkap 2</td>
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
      <td colspan="3">1 - Untuk Gudang</td>
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
      <td colspan="3">2 - SPLEM</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
    