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
    <th colspan="7"><b style="font-weight: 3;">PT. WASKITA KARYA (Persero) Tbk</b></th>
    <th></th>
    <th></th>
    <th style="border: 1px solid #000000" colspan="3">Formulir Prod 05</th>
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
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th style="border: 1px solid #000000" colspan="2"><b>Edisi : {{$periode}}</b></th>
    <th style="border: 1px solid #000000"><b>Rev : 0</b></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>DIVISI</td>
    <td>: DIVISI INFRASTRUKTUR 2</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>PROYEK</td>    
    <td>: PROYEK JALAN TOL BECAKAYU SEKSI 2A UJUNG</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>LOKASI</td>
    <td>: BEKASI</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>NO. AB</td>
    <td>:</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>PERIODE</td>
    <td>: {{strtoupper($periode)}}</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="14" style="text-align: center;"><h4><b>LAPORAN PELAKSANAAN</b></h4></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="14" style="text-align: center;"><h4><b>PEGAWAI DI PROYEK</b></h4></td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;" rowspan="2" align="center">No.</th>
    <td style="border: 1px solid #000000; width: 27;" rowspan="2" align="center">Nama Pegawai</th>
    <td style="border: 1px solid #000000; width: 27;" rowspan="2" align="center">Jabatan</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="2" align="center">Tanggal Lahir</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="2" align="center">Pendidikan</th>
    <td style="border: 1px solid #000000; width: 15;" rowspan="2" align="center">Status Kepegawaian</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="2" align="center">Kelas Jabatan</th>
    <td style="border: 1px solid #000000; width: 12" rowspan="2" align="center">Mulai Tugas Di Proyek</th>
    <td style="border: 1px solid #000000; width: 20;" rowspan="2" align="center">Gaji</th>
    <td style="border: 1px solid #000000;" colspan="3" align="center">Fasilitas</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="2" align="center">Kode Jabatan</th>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td ></td>
    <th ></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <td style="border: 1px solid #000000;" >Lembur</td>
    <td style="border: 1px solid #000000;" >Komunikasi</td>
    <td style="border: 1px solid #000000;" >Makan</td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;">1</td>
    <td style="border: 1px solid #000000;">2</td>
    <td style="border: 1px solid #000000;">3</td>
    <td style="border: 1px solid #000000;">4</td>
    <td style="border: 1px solid #000000;">5</td>
    <td style="border: 1px solid #000000;">6</td>
    <td style="border: 1px solid #000000;">7</td>
    <td style="border: 1px solid #000000;">8</td>
    <td style="border: 1px solid #000000;">9</td>
    <td style="border: 1px solid #000000;">10</td>
    <td style="border: 1px solid #000000;">11</td>
    <td style="border: 1px solid #000000;">12</td>
    <td style="border: 1px solid #000000;">13</td>
  </tr>
  <tr class="thead-light">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" colspan="4" align="left" ><b>PEGAWAI (PT, PTT, OJT)</b></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;"></td>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <td style="border: 1px solid #000000; background: #D3D3D3;" ></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" ></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" ></td>
  </tr>
  <?php $i =1; ?>
  @foreach($pegawais as $pegawai)
    <tr>
      <td></td>
    <td></td>
      <td style="border: 1px solid #000000;">{{$i++}}</td>
      <td style="border: 1px solid #000000;" >{{$pegawai->nama}}</td>
      <td style="border: 1px solid #000000;">{{$pegawai->posisi->posisi}}</td>
      <td style="border: 1px solid #000000;">{{konversi_tanggal($pegawai->tanggal_lahir)}}</td>
      <td style="border: 1px solid #000000;">{{$pegawai->pendidikan_terakhir}}</td>
      <td style="border: 1px solid #000000;">{{$pegawai->status_pegawai}}</td>
      <td style="border: 1px solid #000000;"></td>
      <td style="border: 1px solid #000000;">{{konversi_tanggal($pegawai->tanggal_masuk)}}</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($pegawai->gaji->gaji_pokok)}}</td>
      <td style="border: 1px solid #000000;">-</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($pegawai->gaji->tunj_komunikasi)}}</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($pegawai->gaji->uang_makan)}}</td>
      <td style="border: 1px solid #000000;"></td>
    </tr>
  @endforeach
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
  </tr>
  <tr class="thead-light">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" colspan="4" align="left" ><b>OUTSOURCING</b></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;"></td>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <td style="border: 1px solid #000000; background: #D3D3D3;" ></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" ></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" ></td>
  </tr>
  <?php $i =1; ?>
  @foreach($oss as $os)
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;">{{$i++}}</td>
      <td style="border: 1px solid #000000;">{{$os->nama}}</td>
      <td style="border: 1px solid #000000;">{{$os->posisi->posisi}}</td>
      <td style="border: 1px solid #000000;">{{konversi_tanggal($os->tanggal_lahir)}}</td>
      <td style="border: 1px solid #000000;">{{$os->pendidikan_terakhir}}</td>
      <td style="border: 1px solid #000000;">{{$os->status_pegawai}}</td>
      <td style="border: 1px solid #000000;"></td>
      <td style="border: 1px solid #000000;">{{konversi_tanggal($os->tanggal_masuk)}}</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($os->gaji->gaji_pokok)}}</td>
      <td style="border: 1px solid #000000;">-</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($os->gaji->tunj_komunikasi)}}</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($os->gaji->uang_makan)}}</td>
      <td style="border: 1px solid #000000;"></td>
    </tr>
  @endforeach
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
  </tr>
  <tr class="thead-light">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" colspan="4" align="left" ><b>HARIAN TERDAFTAR (BUA PROYEK)</b></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;"></td>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
    <td style="border: 1px solid #000000; background: #D3D3D3;" ></td>
  </tr>
  <?php $i =1; ?>
  @foreach($harians as $harian)
    <tr>
      <td></td>
      <td></td> 
      <td style="border: 1px solid #000000;">{{$i++}}</td>
      <td style="border: 1px solid #000000;" >{{$harian->nama}}</td>
      <td style="border: 1px solid #000000;">{{$harian->posisi->posisi}}</td>
      <td style="border: 1px solid #000000;">{{konversi_tanggal($harian->tanggal_lahir)}}</td>
      <td style="border: 1px solid #000000;">{{$harian->pendidikan_terakhir}}</td>
      <td style="border: 1px solid #000000;">{{$harian->status_pegawai}}</td>
      <td style="border: 1px solid #000000;"></td>
      <td style="border: 1px solid #000000;">{{konversi_tanggal($harian->tanggal_masuk)}}</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($harian->gaji->gaji_pokok)}}</td>
      <td style="border: 1px solid #000000;">-</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($harian->gaji->tunj_komunikasi)}}</td>
      <td style="border: 1px solid #000000;" align="right">{{number_format($harian->gaji->uang_makan)}}</td>
      <td style="border: 1px solid #000000;"></td>
    </tr>
  @endforeach
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
    <td style="border: 1px solid #000000;"></td>
  </tr>
  <tr class="thead-light">
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;" colspan="9" align="right" ><b>{{number_format($total)}}</b></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;"></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;"></td>
    <td style="border: 1px solid #000000; background: #D3D3D3;"></td>
    <th style="border: 1px solid #000000; background: #D3D3D3;"></th>
  </tr>
</table>
  