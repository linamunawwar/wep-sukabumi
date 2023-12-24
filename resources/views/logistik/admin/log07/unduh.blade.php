<table>
  <tr>
    <?php 
      $loop = ceil(count($materials)/3);

      for($i=0; $i<$loop;$i++){
    ?>
    <th style="width: 6;">
      <img src="{{public_path('img/Waskita.png')}}" width="45" align="center">
    </th>
    <th colspan="4"><b style="font-weight: 3; font-size:14px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
    <th></th>
    <th></th>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <th></th>
    <th colspan="4"></th>
    <td style="border: 1px solid #000000;font-weight: bold;" colspan="2" align="center">Formulir Log-07</td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <td style="border: 1px solid #000000; text-align: center;">Edisi : Mei 2019</b></td>
    <td style="border: 1px solid #000000; text-align: center; width: 16;">Revisi : 0</td>
  <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td style="border: 1px solid #000000; width: 6;"></td>
    <td style="padding-left: 10px;font-weight: bold; height: 15;">Business Unit</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td></td>
    <td></td>
    <td></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td style="border: 1px solid #000000; width: 6;"></td>    
    <td style="width: 17;font-weight: bold;">Proyek</td>
    <td colspan="3">: Proyek Jalan Tol CIAWI SUKABUMI SEKSI 3</td>
    <td colspan="2" style="font-weight: bold;"> No. AB</td>
    <?php
      }
    ?>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td colspan="7" style="text-align: center;border: 1px solid #000000"><b>BUKU HARIAN PENGELUARAN BAHAN</b></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td></td>
    <td></td>
    <td></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td colspan="2">Jenis Pekerjaan :</td>
    <td colspan="2">{{$data['jenis']->nama}}</td>
    <td></td>
    <td></td>
    <td></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td colspan="2">Volume Pekerjaan :</td>
    <td colspan="2">{{$data['volume']}}</td>
    <td></td>
    <td></td>
    <td></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td colspan="2">Lokasi Pekerjaan :</td>
    <td colspan="2">{{$data['lokasi']->nama}}</td>
    <td></td>
    <td></td>
    <td></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td colspan="3">SOM/Superintendent Pekerjaan :</td>
    <td style="text-align: left;">{{$data['som']}}</td>
    <td colspan="2">Nomor Pekerjaan :{{$data['nomor_pekerjaan']}}</td>
    <td></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td colspan="2">Bulan:</td>
    <td colspan="2">{{periodeTanggal($data['tanggal_mulai'])}}</td>
    <td colspan="2" align="left">No. Buku</td>
    <td >{{$data['no_buku']}}</td>
    <?php
      }
    ?>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    @foreach($materials as $key=>$material)
      @if($key % 3 == 0)
          <td style="border: 1px double #000000; font-weight: bold; font-size: 8;" rowspan="2"  align="center">Tgl</td>
        @endif
      <td style="border: 1px double #000000; font-weight: bold; font-size: 9; width: 20;" align="center" colspan="2">Bahan: {{$material['nama']}}</td>
    @endforeach
    @if((count($materials)%3) !== 0)
        <?php
          for ($z=1; $z < (count($materials)%3) ; $z++) { 
            echo '<td style="border: 1px double #000000; font-weight: bold; font-size: 9; width: 13;" align="center" colspan="2">Bahan:</td>';
          }

        ?>
      @endif
  </tr>
  <tr>
    @foreach($materials as $key=> $material)
      <?php $jumlah[$material['material_id']] = 0; ?>
      @if($key % 3 == 0)
          <td></td>
        @endif
        <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 15;" align="center">Jumlah</td>
        <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 15;" align="center">Jumlah Terusan</td>
    
    @endforeach
    @if((count($materials)%3) !== 0)
        <?php
          for ($z=1; $z < (count($materials)%3) ; $z++) { 
            echo '<td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" align="center">Jumlah</td>
        <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" align="center">Jumlah Terusan</td>';
          }

        ?>
      @endif
  </tr>
  <tr>
    @foreach($materials as $key=>$material)
      @if($key % 3 == 0)
        <td style="border: 1px double #000000; font-size: 10;" colspan="2">Jumlah s.d Bulan Lalu</td>
      @else
        <td style="border: 1px double #000000;"></td>
      @endif
      <td style="border: 1px double #000000;">{{$material['jumlah_lalu']}}</td>
    @endforeach
    @if((count($materials)%3) !== 0)
        <?php
          for ($z=1; $z < (count($materials)%3) ; $z++) { 
            echo '<td style="border: 1px double #000000;"></td>
        <td style="border: 1px double #000000;"></td>';
          }

        ?>
      @endif
  </tr>
  <?php $i =1; ?>
  <?php
    for ($j=0; $j < count($tanggal) ; $j++) { 
  ?>
    <tr>
      @foreach($materials as $key=> $material)
        @if($key % 3 == 0)
          <td style="border: 1px solid #000000; font-size: 10; ">
          @php
              $tgl = explode('-',$tanggal[$j]);
              if(substr($tgl[2],0,1) == '0'){
              $tgl[2]=substr($tgl[2],1,2);
            }
            @endphp
          {{$tgl[2]}}</td>
        @endif
        <td style="border: 1px solid #000000;font-size: 10;">{{$material['jumlah'][$tanggal[$j]]}}</td>
        <td style="border: 1px solid #000000;font-size: 10;">{{$jumlah[$material['material_id']] = $jumlah[$material['material_id']] + $material['jumlah'][$tanggal[$j]]}}</td>
        
      @endforeach
      @if((count($materials)%3) !== 0)
        <?php
          for ($z=1; $z < (count($materials)%3) ; $z++) { 
            echo '<td style="border: 1px solid #000000;"></td>';
            echo '<td style="border: 1px solid #000000;"></td>';
          }

        ?>
      @endif

    </tr>
  <?php 
    }
  ?>

  @if(count($tanggal) < 31)
    <?php
      for($i=count($tanggal);$i<=31;$i++){?>
        <tr>
        @foreach($materials as $key=> $material)
          @if($key % 3 == 0)
            <td style="border: 1px solid #000000;" colspan="2"></td>
          @endif
          <td style="border: 1px solid #000000;"  align="center"></td>
          <td style="border: 1px solid #000000;"  align="center"></td>
        @endforeach
        @if((count($materials)%3) !== 0)
        <?php
          for ($z=1; $z < (count($materials)%3) ; $z++) { 
            echo '<td style="border: 1px solid #000000;"></td>';
            echo '<td style="border: 1px solid #000000;"></td>';
          }

        ?>
      @endif
        </tr>
    <?php  } ?>
    ?>
  @endif
  <tr>
    @foreach($materials as $key=>$material)
      @if($key % 3 == 0)
        <td style="border: 1px double #000000; font-size: 10;" colspan="2">Jumlah Bulan Ini</td>
      @else
        <td style="border: 1px double #000000;"></td>
      @endif
      <td style="border: 1px double #000000;">{{$jumlah[$material['material_id']]}}</td>
    @endforeach
    @if((count($materials)%3) !== 0)
        <?php
          for ($z=1; $z < (count($materials)%3) ; $z++) { 
            echo '<td style="border: 1px double #000000;"></td>
        <td style="border: 1px double #000000;"></td>';
          }

        ?>
      @endif
  </tr>
  <tr>
    @foreach($materials as $key=>$material)
      @if($key % 3 == 0)
        <td style="border: 1px double #000000; font-size: 10;" colspan="2">Jumlah s.d Bulan Ini</td>
      @else
        <td style="border: 1px double #000000;"></td>
      @endif
      <td style="border: 1px double #000000;">{{$jumlah[$material['material_id']] + $material['jumlah_lalu']}}</td>
    @endforeach
    @if((count($materials)%3) !== 0)
        <?php
          for ($z=1; $z < (count($materials)%3) ; $z++) { 
            echo '<td style="border: 1px double #000000;"></td>
        <td style="border: 1px double #000000;"></td>';
          }

        ?>
      @endif
  </tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <?php
    $loop = ceil(count($materials)/3);
    for($l=0; $l<$loop;$l++){
    ?>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;">Bekasi, {{date('d-m-Y')}}</td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td></td>
    <td colspan="2" style="text-align: center;">Mengetahui</td>
    <td></td>
    <td></td>
    <td  colspan="2" style="text-align: center;">Diisi oleh,</td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td></td>
    <td colspan="2" align="center" style="text-align: center;">SPLEM</td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;">Petugas Gudang</td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td></td>
    <td>
      @if(file_exists(url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd))
          <img src="url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd)" width="100" align="center">
      @endif
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">
      <?php $nip = \Auth::user()->pegawai_id;
            $ttd= \Auth::user()->pegawai->ttd;
            $nama = \Auth::user()->name;
      ?>
      @if(file_exists(url('upload/pegawai').'/'.$nip.'/'.$ttd))
          <img src="url('upload/pegawai').'/'.$nip.'/'.$ttd)" width="100" align="center">
      @endif
    </td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <?php
    for($i=0; $i<$loop;$i++){
    ?>
    <td></td>
    <td colspan="2" style="text-align: center;" >{{$splem->nama}}</td>
    <td></td>
    <td></td>
    <td colspan="2" style="text-align: center;">{{$nama}}</td>
    <?php
      }
    ?>
  </tr>
</table>
  