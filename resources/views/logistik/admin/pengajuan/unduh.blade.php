<table>
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th colspan="3"></th>
      <th></th>
      <td colspan="2" style="border: 1px solid #000000; font-size: 10;" align="center">FORMULIR LOGINV-03</td>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <td style="border: 1px solid #000000; font-size: 8;">Edisi : Mei 2020</b></td>
      <td style="border: 1px solid #000000; font-size: 8;">Revisi : 01</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th colspan="3"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
      <th></th>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <th></th>
      <th colspan="3"><b style="font-weight: 3; font-size:16px; ">INDUSTRI KONSTRUKSI</b></th>
      <th></th>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>   
      <td colspan="2" style="font-weight: bold;">Bussiness Unit :</td>
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
        <td colspan="2" style="font-weight: bold;">Proyek :</td>
        <td></td>
        <td></td>
        <td colspan="2" style="font-weight: bold;">ID Proyek :</td>
    </tr>
  </table>
    
  <table class="table table-striped" style="text-align: center;">
      <tr>
        <td></td>
        <td></td>
        <td colspan="7" style="text-align: center;border: 1px solid #000000"><h4><b>BON PERMINTAAN / PENYERAHAN BAHAN DARI GUDANG /</b></h4></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td colspan="2">Nomor : BCKY2AU/{{date("Y", strtotime($pengajuan->created_at))}}/{{$pengajuan->id}} </td>
        <td colspan="2">Tgl Permintaan : {{date('d-m-Y',strtotime($pengajuan->created_at))}}</td>      
        <td colspan="3">Tgl Penyerahan : {{date('d-m-Y',strtotime($pengajuan->updated_at))}}</td>        
        <td></td>        
        <td></td> 
      </tr>
  </table>
  
    <table class="table table-striped">
      <tr class="thead-light" >
        <td></td>
        <td></td>
        <td style="border: 1px solid #000000;" rowspan="2" align="center"><b>No.</b></th>
        <td style="border: 1px solid #000000;" rowspan="2" align="center"><b> WBS Element </b></th>
        <td style="border: 1px solid #000000;" rowspan="2" align="center"><b> Material </b></th>
        <td style="border: 1px solid #000000;" colspan="2" align="center"><b> Permintaan </b></th>
        <td style="border: 1px solid #000000;" colspan="2" align="center"><b> Penyerahan </b></th>
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
          <td style="border: 1px solid #000000;" align="left"> {{ $detail->element_activity }} </td>
          <td style="border: 1px solid #000000;" align="left"> {{ $detail->detailPengajuanMaterial->nama }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->permintaan_satuan }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->permintaan_jumlah }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->penyerahan_satuan }} </td>
          <td style="border: 1px solid #000000;"  align="center"> {{ $detail->pemyerahan_jumlah }} </td>
        </tr>      
        @endforeach
          @if(count($detailPengajuan) < 18)
          @for ($i=count($detailPengajuan);$i<=18;$i++)
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
        <td colspan="2" align="center"> Diminta </td>
        <td align="center"> Disetujui </td>
        <td colspan="2" align="center"> Diserahkan </td>
        <td colspan="2" align="center"> Diterima </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" align="center" style="font-size: 11;font-weight: bold;">( {{$superintendent->nama}} )<</td>
        <td align="center" style="font-size: 11;font-weight: bold;">( {{$som->nama}} )</td>
        <td colspan="2" align="center" style="font-size: 11; font-weight: bold;"> ( {{$splem->nama}} ) </td>
        <td colspan="2" align="center" style="font-size: 11; font-weight: bold;"> ( {{$superintendent->nama}} )</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" align="center">
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