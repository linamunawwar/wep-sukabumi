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
						<h2>Daftar Pengajuan SPJ </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('user/spj/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Nominal</th>
									<th>Keperluan</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Penggantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin SDM</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td>870.000</td>
									<td>Penggantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin SDM</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Penggantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td>500.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin SDM</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td>200.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin SDM</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td>500.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
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