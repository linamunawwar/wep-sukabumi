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
    <td></td>
    <td colspan="2" style="border: 1px solid #000000;" align="center">Formulir Log-04</td>
  </tr>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th>INFRASTRUCTURE 2</th>
    <th></th>
    <th></th>
    <th></th>
    <td style="border: 1px solid #000000;">Edisi : </b></td>
    <td style="border: 1px solid #000000;">Revisi : </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>   
    <td colspan="3">Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
  
<table class="table table-striped" style="text-align: center;">
    <tr>
      <td></td>
      <td></td>
      <td colspan="7" style="text-align: center;border: 1px solid #000000"><h4><b>BON PERMINTAAN MATERIAL / BARANG</b></h4></td>
    </tr>
    <tr>
      <td></td>
      <td></td>       
      <td colspan="7" style="text-align:center;">
        @php
          $year = substr($details[0]->created_at, 2,2);
        @endphp
        Nomor : {{$permintaan->nomor}}/BPM/WK/INF2/BCKY-2AU/{{$year}}
      </td>
      <td></td>
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
      <td>Tanggal : {{ konversi_tanggal($permintaan->tanggal) }} </td>
    </tr>
    <tr class="thead-light" >
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;" rowspan="2" align="center">No.</th>
      <td style="border: 1px solid #000000; width: 40;" rowspan="2" align="center"> Jenis Material/Bahan </td>
      <td style="border: 1px solid #000000; width: 27;" rowspan="2" align="center"> No.Part/Type </td>
      <td style="border: 1px solid #000000; width: 15;" rowspan="2" align="center"> Volume </td>
      <td style="border: 1px solid #000000; width: 14;" rowspan="2" align="center"> Satuan </td>
      <td style="border: 1px solid #000000; width: 14;" rowspan="2" align="center"> Tanggal Pakai </td>
      <td style="border: 1px solid #000000; width: 23;" rowspan="2" align="center"> Untuk Keperluan </td>
    </tr>  
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;" align="center"></td>
      <td style="border: 1px solid #000000;" align="center"></td>
      <td style="border: 1px solid #000000;"  align="center" ></td>
      <td style="border: 1px solid #000000;"  align="center"></td>
      <td style="border: 1px solid #000000;"  align="center"></td>
      <td style="border: 1px solid #000000;"  align="center"></td>
      <td style="border: 1px solid #000000;"  align="center"></td>
    </tr>  
      <?php $no=1; ?>
      @foreach ($detailPermintaan as $detail)
      <tr>
        <td></td>
        <td></td>
        <td style="border: 1px solid #000000;" align="center">{{ $no++ }}</td>
        <td style="border: 1px solid #000000;" align="center">{{ $detail->detailPermintaanMaterial->nama }}</td>
        <td style="border: 1px solid #000000;"  align="center" >{{ $detail->no_part }}</td>
        <td style="border: 1px solid #000000;"  align="center">{{ $detail->volume }}</td>
        <td style="border: 1px solid #000000;"  align="center">{{ $detail->satuan }}</td>
        <td style="border: 1px solid #000000;"  align="center">{{ konversi_tanggal($detail->tgl_pakai) }}</td>
        <td style="border: 1px solid #000000;"  align="center">{{ $detail->keperluan }}</td>
      </tr>      
      @endforeach
      @if(count($detailPermintaan) < 18)
        @for ($i=count($detailPermintaan);$i<=18;$i++)
        <tr>
          <td></td>
          <td></td>
          <td style="border: 1px solid #000000;" align="center"></td>
          <td style="border: 1px solid #000000;" align="center"></td>
          <td style="border: 1px solid #000000;" align="center"></td>
          <td style="border: 1px solid #000000;" align="center"></td>
          <td style="border: 1px solid #000000;" align="center"></td>
          <td style="border: 1px solid #000000;" align="center"></td>
          <td style="border: 1px solid #000000;" align="center"></td>
        </tr>     
        @endfor
    @endif
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td align="center">Menyetujui</td>
      <td align="center">Diperiksa</td>
      <td colspan="2" align="center">Yang Melaksanakan</td>
      <td align="center">Yang Meminta</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td align="center">Project Manager</td>
      <td align="center">SCARM</td>
      <td colspan="2" align="center">SPLEM</td>
      <td align="center"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td align="center" style="height: 50;">
        @if(file_exists("upload/pegawai/$pm->nip/$pm->ttd"))
            <img src="upload/pegawai/{{$pm->nip}}/{{$pm->ttd}}" width="100" align="center">
        @endif
      </td>
      <td align="center" style="height: 50;">
        @if(file_exists("upload/pegawai/$scarm->nip/$scarm->ttd"))
            <img src="upload/pegawai/{{$scarm->nip}}/{{$scarm->ttd}}" width="100" align="center">
        @endif
      </td>
      <td colspan="2" align="center" style="height: 50;">
        @if(file_exists("upload/pegawai/$splem->nip/$splem->ttd"))
            <img src="upload/pegawai/{{$splem->nip}}/{{$splem->ttd}}" width="100" align="center">
        @endif
      </td>
      <td align="center" style="height: 55;">
       @if(file_exists("upload/pegawai/$peminta->nip/$peminta->ttd"))
            <img src="upload/pegawai/{{$peminta->nip}}/{{$peminta->ttd}}" width="100" align="center">
        @endif
      </td>
    </tr>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td align="center" style="width:25;">{{$pm->nama}}</td>
      <td align="center">{{$scarm->nama}}</td>
      <td colspan="2" align="center">{{$splem->nama}}</td>
      <td align="center">{{$peminta->nama}}</td>
    </tr>
  </table>