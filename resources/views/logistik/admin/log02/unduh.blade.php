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
      <th colspan="4"><b style="font-weight: 3;">PT. WASKITA KARYA (Persero) Tbk</b></th>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="3" align="center">FORMULIR LOGINV-02</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="2">Edisi : Mei 2020</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Revisi : 01 </td>
    
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td colspan="2" style="padding-left: 10px;">Business Unit</td>
      <td>:</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>    
      <td colspan="2">Proyek</td>
      <td colspan="2">: </td>
      <td colspan="3" style="font-weight: bold;"> ID Project</td>
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
        <td>: {{ $tahun }}</td>
        <td></td>
        <td></td>
        <td colspan="3">No.material :</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2">Tahun </td>
        <td>: {{ $bulan }}</td>
        <td></td>
        <td></td>
        <td colspan="3">Nama Bahan :{{ $material->nama }}</td>
    </tr>
  </table>
  <table class="table table-striped">
    <tr class="thead-light" >
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="4" align="center">PENERIMAAN</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" colspan="2" align="center"> PENGELUARAN </td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center"> Sisa </td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" rowspan="2" align="center"> Keterangan </td>
    </tr>
    <tr class="thead-light" style="text-align: center;">
      <td></td>
      <td></td>
      <td colspan="2" style="border: 1px solid #000000;font-weight: bold; font-size: 10;" align="center">Tanggal</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Jumlah</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Jumlah Terusan</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;">Jumlah</td>
      <td style="border: 1px solid #000000; font-weight: bold; font-size: 10;" >Jumlah Terusan</td>
    </tr>
    @foreach ($data as $key => $val)
    <tr class="thead-light" style="text-align: center;">
        <td></td>
        <td></td>
        <td colspan="2" style="border: 1px solid #000000; font-size: 9" align="center">{{ $key }}</td>
        <td style="border: 1px solid #000000; font-size: 9">{{ $val['jml_terima'] }}</td>
        <td style="border: 1px solid #000000; font-size: 9">{{ $val['trs_terima'] }}</td>
        <td style="border: 1px solid #000000; font-size: 9">{{ $val['jml_keluar'] }}</td>
        <td style="border: 1px solid #000000; font-size: 9">{{ $val['trs_keluar'] }}</td>
        <td style="border: 1px solid #000000; font-size: 9">{{ $val['sisa'] }}</td>
        <td style="border: 1px solid #000000; font-size: 9"></td>
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
        <td colspan="2" style="text-align: center;"> Tanggal </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;">Mengetahui</td>
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
      <td></td>
      <td> <b><u> Catatan : </u></b> </td>
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
    