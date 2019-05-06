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
						<h2>Daftar Gaji Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Gaji</th>
									<th>Uang Makan</th>
									<th  style="width: 5%;">Tunjangan Telekomunikasi</th>
									<th   style="width: 5%;">Tunjangan Transportasi</th>
									<th>Bank</th>
									<th>No.Rekening</th>
								</tr>
							</thead>
							<tbody>
								@foreach($gajis as $gaji)
									<tr>
										<td>{{$gaji->nip}}</td>
										<td>{{$gaji->pegawai->nama}}</td>
										<td>{{$gaji->gaji_pokok}}</td>
										<td>{{$gaji->uang_makan}}</td>
										<td>{{$gaji->tunj_komunikasi}}</td>
										<td>{{$gaji->tunj_transportasi}}</td>
										<td>{{$gaji->pegawai->bank->nama_bank}}</td>
										<td>{{$gaji->pegawai->bank->no_rekening}}</td>
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