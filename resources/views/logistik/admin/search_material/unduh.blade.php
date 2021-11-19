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
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
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
  </table>
    
  <table class="table table-striped" style="text-align: center;">
      <tr>
        <td></td>
        <td></td>
        <td colspan="7" style="text-align: center;border: 1px solid #000000"><h4><b>LAPORAN PENGGUNAAN MATERIAL</b></h4></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td colspan="7" style="text-align: left; font-weight: bold;">Detail Laporan Material</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td style="text-align: left;" width="15%">Kode Material</td>
        <td>:</td>        
        <td style="text-align: left;">{{ $material->material->kode_material }}</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td style="text-align: left;" width="15%">Nama Material</td>
        <td>:</td>        
        <td style="text-align: left;">{{ $material->material->nama }}</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td style="text-align: left;" width="15%">Sisa Stok</td>
        <td>:</td>        
        <td style="text-align: left;">{{ $material->sisa_stok }}</td>
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
        <td style="border: 1px solid #000000; width: 5%;" align="center"><b>No.</b></th>
        <td style="border: 1px solid #000000; width: 12%;" align="center"><b> Tanggal Masuk </b></th>
        <td style="border: 1px solid #000000; width: 12%;" align="center"><b> Tanggal Keluar </b></th>
        <td style="border: 1px solid #000000; width: 40%;" align="center"><b> Keterangan </b></th>
        <td style="border: 1px solid #000000; width: 10%;" align="center"><b> Jumlah </b></th>
        <td style="border: 1px solid #000000; width: 25%;" align="center"><b> Penerima </b></th>
      </tr>   
        <tr>
          <td></td>
          <td></td>
          <td style="border: 1px solid #000000;" align="center">  </td>
          <td style="border: 1px solid #000000;" align="center">  </td>
          <td style="border: 1px solid #000000;" align="center">   </td>
          <td style="border: 1px solid #000000;"  align="center">  </td>
          <td style="border: 1px solid #000000;"  align="center">  </td>
          <td style="border: 1px solid #000000;"  align="center">  </td>        
        </tr>  
      <?php $no = 0; ?>
      @for ($i = 0; $i < count($details); $i++)
      <?php $no++; ?>    
        <tr>
          <td></td>
          <td></td>            
          <td style="border: 1px solid #000000;" align="center">{{ $no }}</td>
          <td style="border: 1px solid #000000;" align="center">
            @if (isset($details[$i]['penerimaan_id']))
              <span style="color: #27ae60">{{ date("d M Y", strtotime($details[$i]['tanggal_terima'])) }}</span>
            @else
              -
            @endif
          </td>
          <td style="border: 1px solid #000000;" align="center">
            @if (isset($details[$i]['pengajuan_id']))
              <span style="color: #e74c3c">{{ date("d M Y", strtotime($details[$i]['tanggal_keluar'])) }}</span>
            @else
              -
            @endif
          </td>
          <td style="border: 1px solid #000000;" align="center">
            @if (isset($details[$i]['penerimaan_id']))
              {{ $details[$i]['keterangan']!=''?$details[$i]['keterangan']:'-' }}
            @else
              -
            @endif
          </td>
          <td style="border: 1px solid #000000;" align="center">
            @if (isset($details[$i]['penerimaan_id']))
              {{ $details[$i]['vol_saat_ini'] }}
            @elseif(isset($details[$i]['pengajuan_id']))
              {{ $details[$i]['pemyerahan_jumlah'] }}
            @endif
          </td>
          <td style="border: 1px solid #000000;" align="center">
            @if (isset($details[$i]['penerimaan_id']))
              {{ $details[$i]['penerimaMasuk'] }}
            @elseif(isset($details[$i]['pengajuan_id']))
              {{ $details[$i]['penerimaKeluar'] }}
            @endif
          </td>
        </tr>    
      @endfor
</table>