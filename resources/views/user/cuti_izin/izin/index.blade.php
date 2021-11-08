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
						<h2>Daftar izin Pegawai </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('user/izin/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Mulai Izin</th>
									<th>Selesai Izin</th>
									<th>Status Izin</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($izins as $izin)
									<tr>
										<td>{{konversi_tanggal($izin->tanggal_mulai)}}</td>
										<td>{{konversi_tanggal($izin->tanggal_selesai)}}</td>
										<td>
											@if(($izin->is_verif_admin == 1) && ($izin->is_verif_mngr == 1) && ($izin->is_verif_sdm == 1))
												<span class="label label-warning">Approved By Admin</span>
												<span class="label label-primary">Approved By Manager</span>
												<span class="label label-success">Approved By SDM</span>
											@elseif(($izin->is_verif_admin == 1) && ($izin->is_verif_mngr == 1) && ($izin->is_verif_sdm == 0))
												<span class="label label-warning">Approved By Admin</span>
												<span class="label label-primary">Approved By Manager</span>
											@elseif(($izin->is_verif_admin == 1) && ($izin->is_verif_mngr == 0) && ($izin->is_verif_sdm == 0))
												<span class="label label-warning">Approved By Admin</span>
											@else
												<span class="label label-default">Not Approved</span>
											@endif
										</td>
										<td style="text-align: left;">
											@if($izin->is_verif_mngr == 1)
												<a class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											@else
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