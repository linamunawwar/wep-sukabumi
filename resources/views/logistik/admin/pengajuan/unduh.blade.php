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
      <td colspan="2" style="border: 1px solid #000000;" align="center">Formulir Log-04</td>
    </tr>
    <tr>
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
      <td></td>   
      <td colspan="2">Bussiness Unit :</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>   
        <td colspan="2">Proyek :</td>
        <td></td>
        <td></td>
        <td colspan="2">No. AB :</td>
    </tr>
  </table>
    
  <table class="table table-striped" style="text-align: center;">
      <tr>
        <td></td>
        <td></td>
        <td colspan="7" style="text-align: center;border: 1px solid #000000"><h4><b>BON PERMINTAAN / PENYERAHAN BAHAN DARI GUDANG</b></h4></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Nomor : </td>
        <td>Tgl Permintaan :</td>        
        <td colspan="2">Tgl Penyerahan :</td>        
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
      </tr>
  </table>
  
    <table class="table table-striped">
      <tr class="thead-light" >
        <td></td>
        <td></td>
        <td style="border: 1px solid #000000;" rowspan="2" align="center"><b>No.</b></th>
        <td style="border: 1px solid #000000; width: 27;" rowspan="2" align="center"><b> Element Activity </b></th>
        <td style="border: 1px solid #000000; width: 27;" rowspan="2" align="center"><b> Material </b></th>
        <td style="border: 1px solid #000000; width: 15;" colspan="2" align="center"><b> Permintaan </b></th>
        <td style="border: 1px solid #000000; width: 14;" colspan="2" align="center"><b> Penyerahan </b></th>
      </tr>  
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="border: 1px solid #000000;" align="center"><b>Satuan</b></td>
        <td style="border: 1px solid #000000;" align="center"><b>Jumlah</b></td>
        <td style="border: 1px solid #000000;" align="center"><b>Satuan</b></td>
        <td style="border: 1px solid #000000;" align="center"><b>Jumlah</b></td>
      </tr>  
        <?php $no=1; ?>
        @foreach ($detailPengajuan as $detail)
        <tr>
          <td></td>
          <td></td>
          <td style="border: 1px solid #000000;" align="center"> {{ $no++ }} </td>
          <td style="border: 1px solid #000000;" align="center"> {{ $detail->element_activity }} </td>
          <td style="border: 1px solid #000000;" align="center"> {{ $detail->detailPengajuanMaterial->nama }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->permintaan_satuan }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->permintaan_jumlah }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->penyerahan_satuan }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->pemyerahan_jumlah }} </td>
        </tr>      
        @endforeach
          @if(count($detailPengajuan) < 3)
          @for ($i=count($detailPengajuan);$i<=4;$i++)
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
      <tr>
        <td></td>
        <td></td>
        <td colspan="7" align="left"><b> Peruntukan : </b></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td colspan="7">Jenis Pekerjaan : {{ $pengajuan->pengajuanJenisPekerjaan->nama }}</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td colspan="7">Volume Pekerjaan : {{ $pengajuan->volume }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="7">Lokasi Pekerjaan : {{ $pengajuan->pengajuanLokasiPekerjaan->nama }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="4">SOM / Superintenden : </td>
        <td colspan="3">Nomor WBS : </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="7">No. Buku Harian Pemakaian Bahan (Form Log 07) : </td>
    </tr>
    @for ($i=0;$i<=1;$i++)*/
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endfor
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" align="center"><b> Permintaan </b></td>
        <td colspan="4" align="center"><b> Penyerahan </b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td align="center"> Diminta </td>
        <td align="center"> Disetujui </td>
        <td colspan="2" align="center"> Diserahkan </td>
        <td colspan="2" align="center"> Diterima </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="height:70;" align="center">
          @if(file_exists("upload/pegawai/$superintendent->nip/$superintendent->ttd"))
            <img src="upload/pegawai/{{$superintendent->nip}}/{{$superintendent->ttd}}" width="100" align="center">
          @endif
        </td>
        <td style="height:70;" align="center">
          @if(file_exists("upload/pegawai/$som->nip/$som->ttd"))
            <img src="upload/pegawai/{{$som->nip}}/{{$som->ttd}}" width="100" align="center">
          @endif
        </td>
        <td colspan="2" style="height:70;" align="center">
          @if(file_exists("upload/pegawai/$splem->nip/$splem->ttd"))
            <img src="upload/pegawai/{{$splem->nip}}/{{$splem->ttd}}" width="100" align="center">
          @endif
        </td>
        <td colspan="2" style="height:70;" align="center">
          @if(file_exists("upload/pegawai/$superintendent->nip/$superintendent->ttd"))
            <img src="upload/pegawai/{{$superintendent->nip}}/{{$superintendent->ttd}}" width="100" align="center">
          @endif
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td align="center"><b>( {{$superintendent->nama}} )</b></td>
        <td align="center"><b>( {{$som->nama}} )</b></td>
        <td colspan="2" align="center"><b> ( {{$splem->nama}} )</b> </td>
        <td colspan="2" align="center"><b> ( {{$superintendent->nama}} )</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td align="center">
          @if($user->role_id != 2)
            Logistik
          @else
            Superintendent
          @endif
        </td>
        <td align="center">SOM</td>
        <td colspan="2" align="center"> SPLEM </td>
        <td colspan="2" align="center">
          @if($user->role_id != 2)
            Logistik
          @else
            Superintendent
          @endif
        </td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td> Note : </td> 
        <td colspan="2"> Dibuat rangkap 3 </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2">1. Untuk Gudang</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2">2. Untuk Manager Engineering/SEM/Staf </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2">3. Arsip</td>
    </tr>
</table>