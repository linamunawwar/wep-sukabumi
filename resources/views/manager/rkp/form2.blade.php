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
    <th colspan="8"><b style="font-weight: 3;">PT. WASKITA KARYA (Persero) Tbk</b></th>
    <th></th>
    <th style="border: 1px solid #000000 width:30;" colspan="2">Form. WK-SDM-03-02</th>
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
    <th style="border: 1px solid #000000 width:30;" colspan="2"><b>Edisi : 3</b></th>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>PUSAT</td>
  </tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><b>V</b></td>    
    <td>Unit Kerja/Bisnis/Proyek</td>
    <td>: Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
  </tr>
</table>

<table class="table table-striped" style="text-align: center;">
  <tr>
    <td></td>
    <td></td>
    <td colspan="13" style="text-align: center;"><h4><b>RENCANA KEBUTUHAN PEGAWAI BERDASARKAN KUALIFIKASI & SPESIFIKASI JABATAN</b></h4></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="13" style="text-align: center;"><h4><b>BERDASARKAN KUALIFIKASI & SPESIFIKASI JABATAN</b></h4></td>
  </tr>
</table>
<table class="table table-striped">
  <tr class="thead-light" >
    <td></td>
    <td></td>
    <td style="border: 1px solid #000000;" rowspan="3" align="center">No.</th>
    <td  colspan="2" align="center"></th>
    <td rowspan="3" align="center" style="border: 1px solid #000000; width: 27;">Uraian Tugas Pokok</th>
    <td style="border: 1px solid #000000; width: 27;" colspan="5" align="center">Persyaratan Jabatan</th>
    <td style="border: 1px solid #000000; width: 15;" rowspan="3" align="center">Jumlah Kekurangan</th>
    <td style="border: 1px solid #000000; width: 14;" rowspan="3" align="center">Waktu Penempatan</th>
    <td style="border: 1px solid #000000; width: 15; text-align: center;" align="center" rowspan="3" >Rencana Penempatan P/M/R</th>
    <td style="border: 1px solid #000000; width: 12;" rowspan="3" align="center">Evaluasi</th>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <th></th>
    <td colspan="2" align="center">Formasi Jabatan Yang</td>
    <th></th>
    <td rowspan="2" style="border: 1px solid #000000;" align="center">Peringkat Pendidikan</td>
    <td colspan="2" style="border: 1px solid #000000;" align="center">Pengalaman Kerja</td>
    <td colspan="2" style="border: 1px solid #000000;" align="center">Potensi</td>
    <td></td>
    <td ></td>
    <td ></td>
    <td ></td>
  </tr>
  <tr class="thead-light" style="text-align: center;">
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" align="center">dibutuhkan</td>
    <td ></td>
    <td ></td>
    <td style="border: 1px solid #000000;">Tahun</td>
    <td style="border: 1px solid #000000;">Jenis Pek.</td>
    <td style="border: 1px solid #000000; width: 6">TPA</td>
    <td style="border: 1px solid #000000; width: 6">EPT</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td style="border: 1px double #000000;" align="center">1</td>
      <td style="border: 1px double #000000; text-align: center;" colspan="2" align="center"  >2</td>
      <td style="border: 1px double #000000;"  align="center">3</td>
      <td style="border: 1px double #000000;"  align="center">4</td>
      <td style="border: 1px double #000000;"  align="center">5</td>
      <td style="border: 1px double #000000;"  align="center">6</td>
      <td style="border: 1px double #000000;"  align="center">7</td>
      <td style="border: 1px double #000000;"  align="center">8</td>
      <td style="border: 1px double #000000;"  align="center">9</td>
      <td style="border: 1px double #000000;"  align="center">10</td>
      <td style="border: 1px double #000000;"  align="center">11</td>
      <td style="border: 1px double #000000;"  align="center">12</td>
    </tr>
  <?php $i =1; ?>
  @foreach($dt_rkp as $data)
    <tr>
      <td></td>
      <td></td>
      <td style="border: 1px solid #000000;" align="center">{{$i++}}</td>
      <td style="border: 1px solid #000000;"  align="center" colspan="2" >{{$data->posisi->posisi}}</td>
      <td style="border: 1px solid #000000;"  align="center" >{{$data->tugas}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->pendidikan}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->tahun_kerja}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->jenis_kerja}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->TPA}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->EPT}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->jumlah_kurang}}</td>
      <td style="border: 1px solid #000000;"  align="center">{{$data->waktu_penempatan}}</td>
      <td style="border: 1px solid #000000;"  align="center"></td>
      <td style="border: 1px solid #000000;"  align="center"></td>
    </tr>
  @endforeach
  @if(count($dt_rkp) < 12)
    <?php
      for($i=count($dt_rkp);$i<=12;$i++){
        echo '<tr>
              <td></td>
              <td></td>
              <td style="border: 1px solid #000000;" align="center"></td>
              <td style="border: 1px solid #000000;"  align="center" colspan="2" ></td>
              <td style="border: 1px solid #000000;"  align="center" ></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
              <td style="border: 1px solid #000000;"  align="center"></td>
            </tr>';
      }
    ?>
  @endif
  <tr></tr>
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
    <td align="center">Menyetujui,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Yang Mengusulkan,</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center;">
      <img src="upload/pegawai/{{$pm->nip}}/{{$pm->ttd}}" width="150" align="center">
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center;">
      <img src="upload/pegawai/{{$manager->nip}}/{{$manager->ttd}}" width="150" align="center">
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">{{$pm->nama}}</td>
    <td></td>
    <td><</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">{{$manager->nama}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center">Project Manager</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="center" colspan="2">{{$manager->posisi->posisi}}</td>
  </tr>
</table>
  