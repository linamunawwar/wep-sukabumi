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
						<h2>Daftar Pengajuan Slip Gaji </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP - Nama</th>
									<th>Periode</th>
									<th>Keperluan</th>
									<th>Status </th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($slip_gajis as $slip_gaji)
									<tr>
										<td>{{$slip_gaji->nip}} - {{$slip_gaji->pegawai->nama}}</td>
										<td>{{bulan($slip_gaji->bulan)}} {{$slip_gaji->tahun}}</td>
										<td>{{$slip_gaji->keperluan}}</td>
										<td>
											@if($slip_gaji->is_verif_sdm == 1)
												<span class="label label-primary">Approved By Manager SDM</span>
											@else
												<span class="label label-default">Not Approved</span>
											@endif
										</td>
										<td style="text-align: left;">
											@if($slip_gaji->is_verif_sdm == 1)
												<a class="btn btn-dark btn-xs">Approve</a>
												<a class="btn btn-success btn-xs" href="{{'slip_gaji/unduh/'.$slip_gaji->id.''}}"><i class="fa fa-download"></i>  Unduh</a>
											@else
												<a class="btn btn-success btn-xs" href="{{'slip_gaji/approve/'.$slip_gaji->id.''}}">Approve</a>
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											@endif
										</td>
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