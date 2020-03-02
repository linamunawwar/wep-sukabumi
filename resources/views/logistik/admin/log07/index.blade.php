@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
	<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}

	#datatable tbody tr td {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}
</style>

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Buku Harian Pengeluaran Bahan (Log-07) </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Mulai :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class='input-group date' id='datepicker1' class="datepicker">
												<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
								                @if(isset($data) && $data['tanggal_mulai'])
								                	<input type='text' value="{{konversi_tanggal($data['tanggal_mulai'])}}" name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
								                @else
								                	<input type='text' value='' name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
								                @endif
								            </div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Selesai :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class='input-group date' id='datepicker2' class="datepicker">
												<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
								                @if(isset($data) && $data['tanggal_selesai'])
								                	<input type='text' value="{{konversi_tanggal($data['tanggal_selesai'])}}" name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
								               	@else
								               		<input type='text' value='' name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
								               	@endif
								            </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Lokasi <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if(isset($data) && $data['lokasi'])
												<select class="form-control col-md-7 col-xs-12 lokasi" id="lokasi" name="lokasi" required="required">
													<option value="">Pilih Lokasi</option>
													@foreach($lokasis as $lokasi)
														<?php $selected = ($lokasi->id == $data['lokasi']->id)? 'selected' : '';?>
														<option value="{{$lokasi->id}}" {{$selected}}>{{$lokasi->nama}}</option>
													@endforeach
												</select>
											@else
												<select class="form-control col-md-7 col-xs-12 lokasi" id="lokasi" name="lokasi" required="required">
													<option value="">Pilih Lokasi</option>
													@foreach($lokasis as $lokasi)
														<option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>
													@endforeach
												</select>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Jenis Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if(isset($data) && $data['jenis'])
												<select class="form-control col-md-7 col-xs-12 jenis" id="jenis" name="jenis" required="required">
													<option value="">Pilih Jenis Pekerjaan</option>
													@foreach($jeniss as $jenis)
														<?php $selected = ($jenis->id == $data['jenis']->id)? 'selected' : ''; ?>
														<option value="{{$jenis->id}}" {{$selected}}>{{$jenis->nama}}</option>
													@endforeach
												</select>
											@else
												<select class="form-control col-md-7 col-xs-12 jenis" id="jenis" name="jenis" required="required">
													<option value="">Pilih Jenis Pekerjaan</option>
													@foreach($jeniss as $jenis)
														<option value="{{$jenis->id}}">{{$jenis->nama}}</option>
													@endforeach
												</select>
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Volume Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if(isset($data) && $data['volume'])
												<input type="text" class="form-control col-md-7 col-xs-12 volume" id="volume" name="volume" value="{{$data['volume']}}">
											@else
												<input type="text" class="form-control col-md-7 col-xs-12 volume" id="volume" name="volume">
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">SOM/ Superintendent Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if(isset($data) && $data['som'])
												<input type="text" class="form-control col-md-7 col-xs-12 som" id="som" name="som" value="{{$data['som']}}">
											@else
												<input type="text" class="form-control col-md-7 col-xs-12 som" id="som" name="som">
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if(isset($data) && $data['nomor_pekerjaan'])
												<input type="text" class="form-control col-md-7 col-xs-12 nomor_pekerjaan" id="nomor_pekerjaan" name="nomor_pekerjaan" value="{{$data['nomor_pekerjaan']}}">
											@else
												<input type="text" class="form-control col-md-7 col-xs-12 nomor_pekerjaan" id="nomor_pekerjaan" name="nomor_pekerjaan">
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">No. Buku <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if(isset($data) && $data['no_buku'])
												<input type="text" class="form-control col-md-7 col-xs-12 no_buku" id="no_buku" name="no_buku" value="{{$data['no_buku']}}">
											@else
												<input type="text" class="form-control col-md-7 col-xs-12 no_buku" id="no_buku" name="no_buku">
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 pull-right">
									<button type="submit" class="btn btn-success pull-right" style="margin-right: 80px;" name="proses" value="1">Proses</button>
								</div>
							</div>
							<br><br>
							@if($show == 1)
								@if(count($materials) == 0)
									<br>
									<br>
									<div class="alert alert-danger">
									  <div class="isi">Data tidak ditemukan!
									  </div>
									</div>
								@else
									<button type="submit" name="unduh" value="1" class="btn btn-primary pull-right">Download</button>
									<div class="Laporan">
										<table class="table" cellspacing="0" style="font-size: 12;">
										  <tr>
										    <?php 
										      $loop = ceil(count($materials)/3);

										      for($i=0; $i<$loop;$i++){
										    ?>
										    <th style="width: 6;">
										      <img src="{{url('public/img/Waskita.png')}}" width="35" align="center">
										    </th>
										    <th colspan="6"><b style="font-weight: 3; font-size:12px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
										    <th></th>
										    <th></th>
										    <th></th>
										    <td style="border: 1px solid #000000;  " colspan="2" align="center">Formulir Log-07</td>
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
										    <th></th>
										    <th></th>
										    <th></th>
										    <th></th>
										    <th></th>
										    <td style="border: 1px solid #000000;">Edisi : </b></td>
										    <td style="border: 1px solid #000000;">Revisi : </td>
										  <?php
										      }
										    ?>
										  </tr>
										  <tr>
										    <?php
										    for($i=0; $i<$loop;$i++){
										    ?>
										    <td style="padding-left: 10px;">Business Unit</td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
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
										    <td >Proyek</td>
										    <td colspan="4">: Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
										    <td colspan="2" style="font-weight: bold;"> No. AB</td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <?php
										      }
										    ?>
										  </tr>
										</table>

										<table class="table table-striped" style="font-size: 12px;">
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
										    <td>Jenis Pekerjaan </td>
										    <td>:{{$data['jenis']->nama}}</td>
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
										    <td>Volume Pekerjaan </td>
										    <td>:{{$data['volume']}}</td>
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
										    <td>Lokasi Pekerjaan</td>
										    <td>:{{$data['lokasi']->nama}}</td>
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
										    <td>SOM/Superintendent Pekerjaan </td>
										    <td>:{{$data['som']}}</td>
										    <td></td>
										    <td>Nomor Pekerjaan </td>
										    <td>:{{$data['nomor_pekerjaan']}}</td>
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
										    <td>Periode</td>
										    <td>: {{konversi_tanggal($data['tanggal_mulai'])}} s.d {{konversi_tanggal($data['tanggal_selesai'])}}</td>
										    <td></td>
										    <td align="left">No. Buku</td>
										    <td >: {{$data['no_buku']}}</td>
										    <td></td>
										    <td></td>
										    <?php
										      }
										    ?>
										  </tr>
										</table>
										<table class="table table-striped" style="font-size: 12px;">
										  <tr class="thead-light" >
										    @foreach($materials as $key=>$material)
										      @if($key % 3 == 0)
										          <td style="border: 1px double #000000; font-weight: bold; " colspan="2" rowspan="2"  align="center" width="10">Tanggal</td>
										        @endif
										      <td style="border: 1px double #000000; font-weight: bold;" align="center" colspan="2">Bahan: {{$material['nama']}}</td>
										    @endforeach
										    @if((count($materials)%3) !== 0)
										        <?php
										          for ($z=1; $z < (count($materials)%3) ; $z++) { 
										            echo '<td style="border: 1px double #000000; font-weight: bold;" align="center" colspan="2">Bahan:</td>';
										          }

										        ?>
										      @endif
										  </tr>
										  <tr>
										    @foreach($materials as $key=> $material)
										      <?php $jumlah[$material['material_id']] = 0; ?>
										      @if($key % 3 == 0)
										        @endif
										        <td style="border: 1px double #000000; font-weight: bold;" align="center">Jumlah</td>
										        <td style="border: 1px double #000000; font-weight: bold;" align="center">Jumlah Terusan</td>
										    
										    @endforeach
										    @if((count($materials)%3) !== 0)
										        <?php
										          for ($z=1; $z < (count($materials)%3) ; $z++) { 
										            echo '<td style="border: 1px double #000000; font-weight: bold;" align="center">Jumlah</td>
										        <td style="border: 1px double #000000; font-weight: bold;" align="center">Jumlah Terusan</td>';
										          }

										        ?>
										      @endif
										  </tr>
										  <tr>
										    @foreach($materials as $key=>$material)
										      @if($key % 3 == 0)
										        <td style="border: 1px double #000000;" colspan="2">Jumlah s.d Bulan Lalu</td>
										      @endif
										      <td style="border: 1px double #000000;"></td>
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
										          <td style="border: 1px solid #000000; " colspan="2">{{konversi_tanggal($tanggal[$j])}}</td>
										        @endif
										        <td style="border: 1px solid #000000;">{{$material['jumlah'][$tanggal[$j]]}}</td>
										        <td style="border: 1px solid #000000;">{{$jumlah[$material['material_id']] = $jumlah[$material['material_id']] + $material['jumlah'][$tanggal[$j]]}}</td>
										        
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
										      @endif
										      <td style="border: 1px double #000000;"></td>
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
										      @endif
										      <td style="border: 1px double #000000;"></td>
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
										    <td></td>
										    <td>Bekasi,</td>
										    <td>{{date('d-m-Y')}}</td>
										    <?php
										      }
										    ?>
										  </tr>
										  <tr>
										    <?php
										    for($i=0; $i<$loop;$i++){
										    ?>
										    <td></td>
										    <td>Mengetahui</td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td>Diisi oleh,</td>
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
										    <td align="center">SPLEM</td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td colspan="2" >Petugas Gudang</td>
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
										      @if(file_exists('upload/pegawai/'.$splem->nip.'/'.$splem->ttd))
										        <img src="{{url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd}}" width="100" align="center">
										      @endif
										    </td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td>
										      <?php $nip = \Auth::user()->pegawai_id;
										            $ttd= \Auth::user()->pegawai->ttd;
										            $nama = \Auth::user()->name;
										      ?>
										      @if(file_exists('upload/pegawai/'.$nip.'/'.$ttd))
										        <img src="{{url('upload/pegawai').'/'.$nip.'/'.$ttd}}" width="100" align="center">
										      @endif
										    </td>
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
										    <td colspan="2" >{{$splem->nama}}</td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td colspan="2">{{$nama}}</td>
										    <?php
										      }
										    ?>
										  </tr>
										</table>
	  
									</div>
								@endif
							@endif
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
	<!-- /page content -->
@endsection
@push('scripts')
  <script type="text/javascript">
  	$('#datepicker1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});

	$('#datepicker2').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});
	$('#lokasi').select2();
	$('#jenis').select2();
  </script>
 @endpush