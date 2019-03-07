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
									<th>Tanggal Izin</th>
									<th>Lama Izin</th>
									<th>Status Izin</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2011/04/25</td>
									<td>5 hari</td>
									<td>
										<span class="label label-primary">Approved By Manager</span>
									</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button>
									</td>
								</tr>
								<tr>
									<td>2011/07/25</td>
									<td>5 hari</td>
									<td>
										<span class="label label-primary">Approved By Manager</span>
									</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button>
									</td>
								</tr>
								<tr>
									<td>2009/01/12</td>
									<td>7 hari</td>
									<td>
										<span class="label label-default">Not Approved</span>
									</td>
									<td style="text-align: left;">
										<button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
									</td>
								</tr>
								<tr>
									<td>2009/01/12</td>
									<td>7 hari</td>
									<td>
										<span class="label label-default">Not Approved</span>
									</td>
									<td style="text-align: left;">
										<button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection