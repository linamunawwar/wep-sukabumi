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
      <td style="border: 1px solid #000000;  " colspan="2" align="center">Formulir Log-05</td>
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
      <td style="border: 1px solid #000000;">Edisi : Mei 2019 </b></td>
      <td style="border: 1px solid #000000;">Revisi : 0 </td>
    
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
      <td></td>
      <td colspan="2" style="font-weight: bold;"> No. AB</td>
    </tr>
  </table>
  
  <table class="table table-striped" style="text-align: center;">
    <tr>
      <td></td>
      <td></td>
      <td colspan="8" style="text-align: center;border: 1px solid #000000"><h4><b>BUKU HARIAN GUDANG</b></h4></td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="3">Halaman :
        </td>
    </tr>
  </table>
  <table class="table table-striped">
    <tr class="thead-light" >
      <td></td>
      <td></td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 7; height:20;" align="center">No</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12; height:20;" align="center"> Tanggal </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 15; height:20;" align="center"> Nama Bahan </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" colspan="2" align="center"> Volume Masuk </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" colspan="2" align="center"> Volume Keluar </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12; height:20;" align="center"> Keterangan </td>
    </tr>
    @foreach ($data as $key => $value)
    <tr class="thead-light" style="text-align: center;">
        @foreach ($value['data'] as $key1 => $val)
          @if ($val['material'] != '')
            @if($key1 == 0)
                <td></td>
                <td></td>
                <td style="border: 1px double #000000;" align="center">{{ $key }}</td>
                <td style="border: 1px double #000000;" align="center">{{ $value  ['tanggal'] }}</td>
                <td style="border: 1px double #000000;" align="left">{{ $val['material'] }}</td>
                <td style="border: 1px double #000000;">{{ $val['jml_terima'] }}</td>
                <td style="border: 1px double #000000;">{{ $val['satuan'] }}</td>
                <td style="border: 1px double #000000;">{{ $val['jml_keluar'] }}</td>
                <td style="border: 1px double #000000;">{{ $val['satuan'] }}</td>
                <td style="border: 1px double #000000;"> </td>
            @else
              <tr>
                <td></td>
                <td></td>
                <td style="border: 1px double #000000;"></td>
                <td style="border: 1px double #000000;"></td>
                <td style="border: 1px double #000000;" align="left">{{ $val['material'] }}</td>
                <td style="border: 1px double #000000;" align="center">{{ $val['jml_terima'] }}</td>
                <td style="border: 1px double #000000;" align="center">{{ $val['satuan'] }}</td>
                <td style="border: 1px double #000000;" align="center">{{ $val['jml_keluar'] }}</td>
                <td style="border: 1px double #000000;" align="center">{{ $val['satuan'] }}</td>
                <td style="border: 1px double #000000;"> </td>
              </tr>    
            @endif              
          @else
            <td></td>
            <td></td>
            <td style="border: 1px double #000000;">{{ $key }}</td>
            <td style="border: 1px double #000000;" align="center">{{ $value ['tanggal'] }}</td>
            <td style="border: 1px double #000000;">{{ $val['material'] }}</td>
            <td style="border: 1px double #000000;" align="center">{{ $val['jml_terima'] }}</td>
            <td style="border: 1px double #000000;" align="center">{{ $val['satuan'] }}</td>
            <td style="border: 1px double #000000;" align="center">{{ $val['jml_keluar'] }}</td>
            <td style="border: 1px double #000000;" align="center">{{ $val['satuan'] }}</td>
            <td style="border: 1px double #000000;"> </td>
          @endif
        @endforeach
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
        <td></td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;"> Petugas Gudang </td>
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
        <td colspan="2" style="height:70;"> 
            @if(file_exists('upload/pegawai/'.$splem->nip.'/'.$splem->ttd))
              <img src="{{'upload/pegawai/'.$splem->nip.'/'.$splem->ttd}}" width="100" align="center">
            @endif 
        </td>
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
        <td colspan="2" style="text-align: center;"> {{ $splem->nama }} </td>
        <td></td>
        <td></td>
    </tr>
  </table>
    