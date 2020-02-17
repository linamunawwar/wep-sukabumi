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
      <td style="border: 1px solid #000000;  " colspan="2" align="center">Formulir Log-02</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
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
      <td colspan="3" style="font-weight: bold;"> No. AB</td>
    </tr>
  </table>
  
  <table class="table table-striped" style="text-align: center;">
    <tr>
      <td></td>
      <td></td>
      <td colspan="7" style="text-align: center;border: 1px solid #000000"><h4><b>KARTU GUDANG</b></h4></td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="3">Bulan : {{ $bulan }}</td>
        <td></td>
        <td colspan="3">Nama Bahan :{{ $material->nama }}</td>
    </tr>
  </table>
  <table class="table table-striped">
    <tr class="thead-light" >
      <td></td>
      <td></td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 13;" colspan="3" align="center">PENERIMAAN</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 13;" colspan="2" align="center"> PENGELUARAN </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center"> Sisa </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center"> Keterangan </td>
    </tr>
    <tr class="thead-light" style="text-align: center;">
      <td></td>
      <td></td>
      <td style="border: 1px double #000000;font-weight: bold; font-size: 10;">Tanggal</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">Jumlah</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">Jumlah Terusan</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;">Jumlah</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" >Jumlah Terusan</td>
    </tr>
    @foreach ($data as $key => $val)
    <tr class="thead-light" style="text-align: center;">
        <td></td>
        <td></td>
        <td style="border: 1px double #000000;">{{ $key }}</td>
        <td style="border: 1px double #000000;">{{ $val['jml_terima'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['trs_terima'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['jml_keluar'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['trs_keluar'] }}</td>
        <td style="border: 1px double #000000;">{{ $val['sisa'] }}</td>
        <td style="border: 1px double #000000;"></td>
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
        <td colspan="2" style="text-align: center;">SPLEM</td>
        <td></td>
        <td colspan="2" style="text-align: center;"> Petugas Gudang </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="height:70;">
            @if(file_exists("upload/pegawai/$splem->nip/$splem->ttd"))
                <img src="upload/pegawai/{{$splem->nip}}/{{$splem->ttd}}" width="100" align="center">
            @endif
        </td>
        <td></td>
        <td colspan="2" style="height:70;">  </td>
        <td></td>
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
    