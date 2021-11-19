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
</table>
<table class="table table-striped" style="text-align: center;">
    <tr>
        <td></td>
        <td></td>
        <td colspan="6" style="text-align: center;border: 1px solid #000000"><h4><b>LAPORAN MATERIAL MASUK & KELUAR</b></h4></td>
    </tr> 
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Kode Material :</td>
        <td>{{ $material->material->kode_material }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Nama Material :</td>
        <td>{{ $material->material->nama }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Jumlah Stok Tersisa :</td>
        <td style="text-align:left;">{{ $material->sisa_stok }}</td>
        <td></td>
        <td></td>
        <td></td>
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
    </tr>
    <tr class="thead-light" >
        <td></td>
        <td></td>
        <td style="border: 1px solid #000000;" align="center">No.</th>
        <td style="border: 1px solid #000000; width: 15;" align="center"> Tanggal Masuk </td>
        <td style="border: 1px solid #000000; width: 15;" align="center"> Tanggal Keluar </td>
        <td style="border: 1px solid #000000; width: 45;" align="center"> Keterangan </td>
        <td style="border: 1px solid #000000; width: 14;" align="center"> Jumlah </td>
        <td style="border: 1px solid #000000; width: 14;" align="center"> Penerima </td>
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