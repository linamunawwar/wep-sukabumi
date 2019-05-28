@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>PROD 05 </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/pegawai/prod05/unduh')}}"><button class="btn btn-success"> Download</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th rowspan="2">NIP</th>
									<th rowspan="2">Nama</th>
									<th rowspan="2" style="width: 15%;">Jabatan</th>
									<th rowspan="2" style="width: 15%;">Tanggal Lahir</th>
									<th rowspan="2" style="width: 15%;">Status Kepegawaian</th>
									<th rowspan="2" style="width: 35%;">Mulai Tugas Di Proyek</th>
									<th rowspan="2">Gaji</th>
									<th colspan="3" style="text-align: center;">Status</th>
									<th rowspan="2">Keterangan</th>
								</tr>
								<tr>
									<th>Lembur</th>
									<th>Komunikasi</th>
									<th style="border-right-width: 1;">Makan</th>
								</tr>
							</thead>
							<tbody>

								@foreach($pegawais as $pegawai)
									<tr>
										<td>{{$pegawai->nip}}</td>
										<td>{{$pegawai->nama}}</td>
										<td>{{$pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($pegawai->tanggal_lahir)}}</td>
										<td>{{$pegawai->status_pegawai}}</td>
										<td>{{konversi_tanggal($pegawai->tanggal_masuk)}}</td>
										<td>{{$pegawai->gaji->gaji_pokok}}</td>
										<td></td>
										<td>{{$pegawai->gaji->tunj_komunikasi}}</td>
										<td>{{$pegawai->gaji->uang_makan}}</td>
										<td>-</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection