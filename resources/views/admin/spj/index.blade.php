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
						<h2>Daftar Pengajuan SPJ Pegawai</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li style="display: none;"><a href="{{url('admin/spj/create')}}"><button class="btn btn-primary"> <i class="fa fa-plus"></i>  Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Tanggal Berangkat</th>
									<th>Tanggal Pulang</th>
									<th>Keperluan</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($spjs as $spj)
									<tr>
										<td>{{$spj->nip}}</td>
										<td>{{$spj->pegawai->nama}}</td>
										<td>{{konversi_tanggal($spj->tanggal_berangkat)}}</td>
										<td>{{konversi_tanggal($spj->tanggal_pulang)}}</td>
										<td>{{$spj->keperluan}}</td>
										@if(($spj->is_verif_sdm == 1) && ($spj->is_verif_admin == 1))
											<td style="text-align: center;">
												<span class="label label-success">Approved By Admin</span>
												<span class="label label-primary">Approved By SDM</span>
											</td>
											<td style="text-align: left;">
												<a class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</a > 
												<a class="btn btn-success btn-xs" href="{{url('admin/spj/unduh/'.$spj->id.'')}}"><i class="fa fa-download"></i>  Unduh</a>
											</td>
										@elseif(($spj->is_verif_sdm == 0) && ($spj->is_verif_admin == 1))
											<td style="text-align: center;"><span class="label label-success">Approved By Admin</span></td>
											<td style="text-align: left;">
												<a class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</a > 
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											</td>
										@else
											<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
											<td style="text-align: left;">
												<a class="btn btn-success btn-xs" href="{{url('admin/spj/approve/'.$spj->id.'')}}"><i class="fa fa-check"></i>  Approve</a > 
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											</td>
										@endif

										
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