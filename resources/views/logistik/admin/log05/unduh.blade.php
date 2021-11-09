<table>
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th colspan="5"></th>
      <td style="border: 1px solid #000000;font-weight: bold;" colspan="3" align="center">FORMULIR LOGINV-04</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th colspan="5"></th>
      <td colspan="2" style="border: 1px solid #000000;font-size: 10;">Edisi : Mei 2020 </b></td>
      <td style="border: 1px solid #000000;font-size: 10;">Revisi : 01 </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th colspan="3"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th colspan="3"><b style="font-weight: 3; font-size:16px; ">INDUSTRI KONSTRUKSI</b></th>
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
      <td>:</td>
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
      <td colspan="2" style="font-weight: bold;"> ID Proyek</td>
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
        <td>Bulan</td>
        @php
          $date = explode('-',$tanggal_mulai);
        @endphp
        <td>: {{bulan($date[1])}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Tahun</td>
        <td>: {{$date[2]}}</td>
        <td></td>
        <td></td>
    </tr>
  </table>
  <table class="table table-striped">
    <tr class="thead-light" >
      <td></td>
      <td></td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" align="center">No</td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" align="center"> Tanggal </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" align="center"> Batch </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" align="center"> Nomor /Nama Material </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" colspan="2" align="center"> Volume Masuk </td>
      <td style="border: 1px double #000000; font-weight: bold; font-size: 10;" colspan="2" align="center"> Volume Keluar </td>
    </tr>
    @foreach ($data as $key => $value)
    <tr class="thead-light" style="text-align: center;">
        @foreach ($value['data'] as $key1 => $val)
          @if ($val['material'] != '')
            @if($key1 == 0)
                <td></td>
                <td></td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center">{{ $key }}</td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center">{{ konversi_tanggal($value['tanggal']) }}</td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center"></td>
                <td style="border: 1px solid #000000; font-size: 10;" align="left">{{ $val['material'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;">{{ $val['jml_terima'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;">{{ $val['satuan'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;">{{ $val['jml_keluar'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;">{{ $val['satuan'] }}</td>
            @else
              <tr>
                <td></td>
                <td></td>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000;"></td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center"></td>
                <td style="border: 1px solid #000000; font-size: 10;" align="left">{{ $val['material'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center">{{ $val['jml_terima'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center">{{ $val['satuan'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center">{{ $val['jml_keluar'] }}</td>
                <td style="border: 1px solid #000000; font-size: 10;" align="center">{{ $val['satuan'] }}</td>
              </tr>    
            @endif              
          @else
            <td></td>
            <td></td>
            <td style="border: 1px solid #000000;">{{ $key }}</td>
            <td style="border: 1px solid #000000;" align="center">{{ konversi_tanggal($value ['tanggal']) }}</td>
            <td style="border: 1px solid #000000;">{{ $val['material'] }}</td>
            <td style="border: 1px solid #000000;" align="center">{{ $val['jml_terima'] }}</td>
            <td style="border: 1px solid #000000;" align="center">{{ $val['satuan'] }}</td>
            <td style="border: 1px solid #000000;" align="center">{{ $val['jml_keluar'] }}</td>
            <td style="border: 1px solid #000000;" align="center">{{ $val['satuan'] }}</td>
            <td style="border: 1px solid #000000;"> </td>
          @endif
        @endforeach
    </tr>
    @endforeach
    <tr></tr>
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
        <td colspan="2" style="text-align: center;"> Bekasi, {{$tanggal_selesai}} </td>
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
        <td colspan="2" style="text-align: center;"> Dibuat Oleh, </td>
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
        <td colspan="2" style="text-align: center;"> SPLEM </td>
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
        <td colspan="2" style="text-align: center;" height="35"> {{ $splem->nama }} </td>
        <td></td>
        <td></td>
    </tr>
  </table>
    