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
						<h2>Data Pengajuan Resign</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('user/pegawai/resign/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tanggal Terakhir Kerja</th>
									<th>Status Resign</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  SPK</button></td>
								</tr>
								<tr>
									<td>2011/07/25</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Manager SDM</span></td>
									<td style="text-align: center;"></td>
								</tr>
								<tr>
									<td>2009/01/12</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Manager SDM</span></td>
									<td style="text-align: center;"></td>
								</tr>
								<tr>
									<td>2012/03/29</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"></td>
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